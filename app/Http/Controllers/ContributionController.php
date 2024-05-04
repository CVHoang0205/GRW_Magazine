<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Event;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                
        $user = Auth::user();

        if ($user->isAdmin()|| $user->isMarketingManager()) {
            $contributions = Contribution::all();
        } elseif ($user->isMarketingCoordination() || $user->isGuest()) {
            $userFaculty = $user->faculty;
            $contributions = Contribution::whereIn('user_id', function($query) use ($userFaculty) {
                $query->select('id')->from('users')->where('faculty_id', $userFaculty->id);
            })->get();
        } elseif ($user->isStudent()) {
            $contributions = Contribution::where('user_id', $user->id)->get();
        }

        foreach ($contributions as $contribution) {
            $contribution->submitted_on = Carbon::parse($contribution->submitted_on);
        }
        
        //succesfully
        // $fileUrls = [];
        // // $files = File::allFiles(('C:\xampp\htdocs\COMP1640\public\storage\uploads'));
        // $files = File::allFiles(public_path('storage/uploads'));
        // foreach ($contributions as $key => $contribution) {
        //     $fileName = $contribution->file;
        //         $checkFile = public_path('storage/uploads/' . $fileName);
        //         if(!empty($checkFile)) {
        //             $contributions[$key]['file_url'] = $checkFile;
        //         }
        // }

        // Separate each file into 1 cell
        $fileUrls = [];
        foreach ($contributions as $contribution) {
            $fileNames = explode(',', $contribution->file);
            foreach ($fileNames as $fileName) {
                $fileUrls[$contribution->id][] = asset('storage/uploads/' . $fileName);
            }
        }
        return view('admin.contribution.view', compact('contributions', 'fileUrls'))->with('success', 'Contribution created successfully');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.contribution.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    //có thể upload nhiều file ở đây
    public function store(Request $request)
    {
        // Validate other fields
        $validatedData = $request->validate([
            'user_id' => 'required',
            'faculty_id' => 'required',
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'file.*' => 'required|mimes:doc,docx,pdf,jpg,jpeg,png', 
            'event_id' => 'required|integer',
        ]);

        // Check if event has expired
        $event = Event::findOrFail($validatedData['event_id']);
        if ($event->hasExpired()) {
            return redirect()->route('contributions.create')->with('error', 'The event is overdue. Cannot submit contribution.');
        }

        $fileNames = []; //Initialize an array to store file names
        
        // Check if any files are uploaded
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            
            foreach ($files as $file) {
                // Create a new file name with timestamp and extension
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Store files in the storage/app/public/uploads directory
                $file->move(public_path('storage/uploads'), $fileName);

                // Add filenames to the fileNames array
                $fileNames[] = $fileName;
            }
        }
        
        // Assigns a string of filenames to the file field in $validatedData
        $validatedData['file'] = implode(',', $fileNames);

        // Set submitted_on field to current time
        $validatedData['submitted_on'] = now();

        // Create a new Contribution and pass in the data
        Contribution::create($validatedData);
        // email
        $email = auth()->user()->email;
        $name = auth()->user()->name;
        // $email = 'hoangcvgch190446@fpt.edu.vn';
        Mail::to('hoangcvgch190446@fpt.edu.vn')->send(new SendMail($email,$name));
        return redirect()->route('contributions.index')->with('success', 'Contribution created successfully');

        return redirect()->route('contributions.create')->with('success', 'Contribution created successfully');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contribution = Contribution::find($id);
        return view('admin.contribution.edit', compact('contribution'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $contribution = Contribution::findOrFail($id);

        // Validate the incoming request data for the fields you want to update
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'file.*' => 'nullable|mimes:doc,docx,pdf,jpg,jpeg,png', 
        ]);

        
        if ($request->hasFile('file')) {
            $fileNames = []; 

            $files = $request->file('file');
            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();

                   
                $file->move(public_path('storage/uploads'), $fileName);

                // Thêm tên file vào mảng fileNames
                $fileNames[] = $fileName;
            }

            // Gán một chuỗi của các tên tệp tin cho trường file trong $validatedData
            $validatedData['file'] = implode(',', $fileNames);
       }

       // Cập nhật chỉ các trường được yêu cầu
       $contribution->fill($validatedData);

       // Lưu thay đổi vào cơ sở dữ liệu
       $contribution->save();

       // Redirect đến trang chỉnh sửa với thông báo thành công
       return redirect()->route('contributions.edit', $id)->with('success', 'Contribution updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        try {
            // Find the Contribution object to delete
            $contribution = Contribution::findOrFail($id);

            // delete contribution
            $contribution->delete();

            // After deleting the Contribution object, also delete the corresponding file from the storage folder
            $filePath = public_path('storage/uploads/' . $contribution->file);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            $filePath = public_path('my-zip-file.zip/' . $contribution->file);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            return redirect()->route('contributions.index')->with('success', 'Delete successfully');
        } 
        catch (\Exception $e) 
        {
            return redirect()->route('contributions.index')->with('error', $e->getMessage());
        }
    }

    //DOWLOAN new UPDATE

    public function download($id)
    {
        try {
            // Find the Contribution object
            $contribution = Contribution::findOrFail($id);
            
            // Create a ZIP file name
            $zipFileName = 'contributions_' . $contribution->user->name . '_' . now()->format('YmdHis') . '.zip';
            $zipFilePath = public_path($zipFileName);
            
            // Initialize the ZipArchive object
            $zip = new ZipArchive();
            if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
                // Add uploaded files to ZIP file
                $fileNames = explode(',', $contribution->file);
                foreach ($fileNames as $fileName) {
                    $filePath = public_path('storage/uploads/' . $fileName);
                    if (File::exists($filePath)) {
                        $zip->addFile($filePath, $fileName);
                    }
                }
                $zip->close();
            }

            // Returns the ZIP file to the user
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    //comment
    public function comment(Contribution $contribution){
        return view('admin.contribution.comment', compact('contribution'));
    }
    
    //comment store
    public function submitComment(Request $request, Contribution $contribution){

        // Check if comment content is provided
        $request->validate([
            'content' => 'required|string'
        ]);
        
        // create new commnet
        $comment = new Comment();
        $comment->contribution_id = $contribution->id;
        $comment->user_id = $request->user()->id;
        
        $comment->content = $request->input('content');
        $comment->commented_at = now();
        $comment->save();
        
        return back()->with('success', 'Comment Succesfully');
    }

    //comment view
    public function viewComment($id){
        // $comments = Comment::find($id);

        $comments = Comment::where('contribution_id', $id)->get();

        return view('admin.contribution.cmview', compact('comments'));
    }

    public function contact(){
        // $email = 'hoangcvgch190446@fpt.edu.vn';
        // Mail::to($email)->send(new SendMail());

        return view('admin.email.contact');
    }

    public function updateStatus(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:approved,rejected',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $contribution = Contribution::findOrFail($id);
        $status = $request->status;

        if ($status === 'approved') {
            $contribution->status = Contribution::STATUS_APPROVED;
        } elseif ($status === 'rejected') {
            $contribution->status = Contribution::STATUS_REJECTED;
        } else {
            // Xử lý trường hợp không hợp lệ
            return redirect()->back()->with('error', 'Invalid action');
        }
        // Lưu thay đổi
        $contribution->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }
}