@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-secondary d-flex justify-content-between align-items-center" role="alert">
                    <h4 class="alert-heading">Event List</h4>

                    @if(isset(auth()->user()->role->permission['name']['event']['can-add']))
                        <a href="{{ route('events.create') }}" type="button" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    @endif

                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Faculty</th>
                                <th>Start Date</th>
                                <th>Final Date</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($events as $key => $event)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        @if(isset(auth()->user()->role->permission['name']['contribution']['can-add']))
                                            <a href="{{ route('contributions.create', [$event->id]) }}">
                                                {{ $event->title }}
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ $event->faculty->name ?? '' }}</td>
                                    <td>{{ $event->start_date }}</td>
                                    <td>{{ $event->final_date }}</td>

                                    <td>
                                        @if(isset(auth()->user()->role->permission['name']['event']['can-delete']))
                                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $event->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        @endif
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $event->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('events.destroy', [$event->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this event?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <td>
                                        @if(isset(auth()->user()->role->permission['name']['event']['can-edit']))
                                            <a href="{{ route('events.edit', [$event->id]) }}">
                                                <i class="fa-solid fa-edit"></i>
                                            </a>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No events to display</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
