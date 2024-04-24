@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (Session::has('message'))
                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>
                @endif
                
                <form action="{{ route('permissions.update', [$permission->id]) }}" method="post">@csrf
                    @method('PUT')
                    <div class="card">

                        <div class="card-header">Permission Update</div>

                        <div class="card-body">
                            <h3>{{ $permission->role->name }}</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Permission</th>
                                        <th scope="col">Can-Add</th>
                                        <th scope="col">Can-Edit</th>
                                        <th scope="col">Can-View</th>
                                        <th scope="col">Can-Delete</th>
                                        <th scope="col">Can-Download</th>
                                        <th scope="col">Can-Comment</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>Faculty</td>
                                        <td><input type="checkbox" name="name[faculty][can-add]" @if($permission['name']['faculty']['can-add'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[faculty][can-edit]" @if($permission['name']['faculty']['can-edit'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[faculty][can-view]" @if($permission['name']['faculty']['can-view'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[faculty][can-delete]" @if($permission['name']['faculty']['can-delete'] ?? null) checked @endif value="1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td><input type="checkbox" name="name[role][can-add]" @if($permission['name']['role']['can-add'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[role][can-edit]" @if($permission['name']['role']['can-edit'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[role][can-view]" @if($permission['name']['role']['can-view'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[role][can-delete]" @if($permission['name']['role']['can-delete'] ?? null) checked @endif value="1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>User</td>
                                        <td><input type="checkbox" name="name[user][can-add]" @if($permission['name']['user']['can-add'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[user][can-edit]" @if($permission['name']['user']['can-edit'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[user][can-view]" @if($permission['name']['user']['can-view'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[user][can-delete]" @if($permission['name']['user']['can-delete'] ?? null) checked @endif value="1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Permisstion</td>
                                        <td><input type="checkbox" name="name[permission][can-add]" @if($permission['name']['permission']['can-add'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[permission][can-edit]" @if($permission['name']['permission']['can-edit'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[permission][can-view]" @if($permission['name']['permission']['can-view'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[permission][can-delete]" @if($permission['name']['permission']['can-delete'] ?? null) checked @endif value="1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Event</td>
                                        <td><input type="checkbox" name="name[event][can-add]" @if($permission['name']['event']['can-add'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[event][can-edit]" @if($permission['name']['event']['can-edit'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[event][can-view]" @if($permission['name']['event']['can-view'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[event][can-delete]" @if($permission['name']['event']['can-delete'] ?? null) checked @endif value="1"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Contribution</td>
                                        <td><input type="checkbox" name="name[contribution][can-add]" @if($permission['name']['contribution']['can-add'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-edit]" @if($permission['name']['contribution']['can-edit'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-view]" @if($permission['name']['contribution']['can-view'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-delete]" @if($permission['name']['contribution']['can-delete'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-download]" @if($permission['name']['contribution']['can-download'] ?? null) checked @endif value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-comment]" @if($permission['name']['contribution']['can-comment'] ?? null) checked @endif value="1"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a class="btn btn-dark" href="{{ route('permissions.index') }}" role="button">Back</a>
                            <button type="submit" class="btn btn-primary .move-right" style="float: right;">Update</button>                
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
