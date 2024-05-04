@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-11 ms-5">
                <div class="col-md-12">
                    <div class="alert alert-secondary d-flex justify-content-between align-items-center" role="alert">
                        <h4 class="alert-heading">Contribution List</h4>

                        {{-- @if(isset(auth()->user()->role->permission['name']['contribution']['can-add'])) --}}
                            {{-- <a href="{{ route('contributions.create') }}"  type="button" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-plus"></i>
                            </a> --}}
                        {{-- @endif --}}

                    </div>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Submitted on</th>
                                    <th>Faculty</th>
                                    <th>Event</th>
                                    <th>Status</th>
                                    {{-- <th>Approve/Reject</th>  --}}
                                    @if (auth()->user()->isMarketingCoordination())
                                        <th>Approve/Reject</th>
                                    @endif                              
                                    <th>Delete</th>
                                    <th>Edit</th>
                                    <th>Download</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($contributions) > 0)
                                    @foreach ($contributions as $key => $con)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $con->user->name ?? '' }} </td>
                                            <td>
                                                <a href="{{ route('contributions.viewComments', [$con->id]) }}">{{ $con->title}} </a> 
                                            </td>
                                            <td> {{ $con->description }} </td>
                                            <td>
                                                @foreach ($fileUrls[$con->id] as $url)
                                                    <a href="{{ $url }}" target="_blank">{{ basename($url) }}</a><br>
                                                @endforeach
                                            </td>
                                            <td> {{ $con->submitted_on }} </td>
                                            <td> {{ $con->faculty->name ?? '' }} </td>
                                            <td> {{ $con->event->title ?? '' }} </td>
                                            <td>
                                                @if($con->status == 'approved')
                                                    <span class="text-success">{{ ucfirst($con->status) }}</span>
                                                @else
                                                    <span class="text-danger">{{ ucfirst($con->status) }}</span>
                                                @endif
                                            </td>
                                            @if (auth()->user()->isMarketingCoordination())
                                                <td>
                                                    <form action="{{ route('contributions.updateStatus', $con->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')                                            
                                                        <select name="status" class="form-select">
                                                            <option value="approved" {{ $con->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                            <option value="rejected" {{ $con->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                        </select>
                                                        <div class="mt-4 text-center">
                                                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                        </div>                                                        
                                                    </form>
                                                </td>
                                            @endif
                                            {{-- <td>
                                                @if ($con->status == 0)
                                                    <span class="btn btn-outline-danger">pending</span>
                                                @else
                                                    <span class="btn btn-outline-success">Approved</span>
                                                @endif
                                            </td> --}}
                                            
                                            {{-- Function Delete --}}
                                            <td>
                                                @if(isset(auth()->user()->role->permission['name']['contribution']['can-delete']))
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $con->id }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            {{-- Delete end --}}

                                            {{-- Model alert --}}
                                            <div class="modal fade" id="exampleModal{{ $con->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form action="{{ route('contributions.destroy', [$con->id]) }}"
                                                        method="post">@csrf
                                                        {{ method_field('DELETE') }}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hey Bro</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Do you want to delete?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Delete</button>
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            {{-- fuction update --}}
                                            <td>
                                                @if(isset(auth()->user()->role->permission['name']['contribution']['can-edit']))
                                                    <a href="{{ route('contributions.edit', [$con->id]) }}">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            {{-- Update end --}}

                                            {{-- Function Download --}}
                                            <td>
                                                @if(isset(auth()->user()->role->permission['name']['contribution']['can-download']))
                                                    <a href="{{ route('contributions.download', [$con->id]) }}">
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            {{-- end download --}}

                                            {{-- Comment Function --}}
                                            <td>
                                                @if(isset(auth()->user()->role->permission['name']['contribution']['can-comment']))
                                                    @if ($con->submitted_on->addDays(14) >= now())
                                                        <a href="{{ route('contributions.comment', $con) }}" class="btn btn-primary">Comment</a>
                                                    @else
                                                        <p>Comments have expired</p>
                                                    @endif
                                                @endif
                                            </td>
                                            {{-- End Comment --}}
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="12">No contributions to display</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
