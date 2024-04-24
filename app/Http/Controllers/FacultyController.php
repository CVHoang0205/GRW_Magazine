<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $userId = Auth::id();
        $isAdmin = Auth::user()->isAdmin(); 

        if ($isAdmin) {
            $faculty = Faculty::all(); 
        } else {
            $userFaculty = User::findOrFail($userId)->faculty; 
            $faculty = Faculty::where('id', $userFaculty->id)->get(); 
        }

        // $faculty = Faculty::all();
        return view('admin.faculty.view', compact('faculty'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {     
        $this->validate($request, [
            'name' => 'required', 
        ]);

        
        $data = $request->all();
        Faculty::create($data);
        return redirect()->back()->with('success', 'Faculty created successfully!!');
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
        $faculty = Faculty::find($id);
        return view('admin.faculty.edit', compact('faculty'));
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
        $faculty = Faculty::find($id);
        $data = $request->all();
        $faculty->update($data);
        return redirect()->back()->with('success', 'Record update succesffuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::find($id);
        $faculty->delete();
        return redirect()->route('facultys.index')->with('success', 'Record Delete succesffuly!');
    }
}
