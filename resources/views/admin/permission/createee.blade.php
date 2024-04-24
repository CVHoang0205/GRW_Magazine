@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(Session::has('message'))

                    <div class="alert alert-success">
                        {{ Session::get('message') }}
                    </div>

                @endif
                
                <form action="{{ route('permissions.store') }}" method="POST">@csrf
                    <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>

                        <div class="card-body">

                            <select class="form-control @error('role_id') is-invalid @enderror" name="role_id">
                                <option value="">Select Role</option> 

                                @foreach(App\Models\Role::all() as $role)
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endforeach

                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                       <strong> {{ $message }} </strong> 
                                    </span>
                                @enderror
                            </select>

                            <table class="table table-striped table-dark mt-5">

                                <thead>
                                    <tr>
                                        <th scope="col">Permission</th>
                                        <th scope="col">Can-add</th>
                                        <th scope="col">Can-edit</th>
                                        <th scope="col">Can-view</th>
                                        <th scope="col">Can-delete</th>
                                        <th scope="col">Can-download</th>
                                        <th scope="col">Can-Comment</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td>Faculty</td>
                                        <td><input type="checkbox" name="name[faculty][can-add]" value="1"></td>
                                        <td><input type="checkbox" name="name[faculty][can-edit]" value="1"></td>
                                        <td><input type="checkbox" name="name[faculty][can-view]" value="1"></td>
                                        <td><input type="checkbox" name="name[faculty][can-delete]" value="1"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Role</td>
                                        <td><input type="checkbox" name="name[role][can-add]" value="1"></td>
                                        <td><input type="checkbox" name="name[role][can-edit]" value="1"></td>
                                        <td><input type="checkbox" name="name[role][can-view]" value="1"></td>
                                        <td><input type="checkbox" name="name[role][can-delete]" value="1"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Permissions</td>
                                        <td><input type="checkbox" name="name[permission][can-add]" value="1"></td>
                                        <td><input type="checkbox" name="name[permission][can-edit]" value="1"></td>
                                        <td><input type="checkbox" name="name[permission][can-view]" value="1"></td>
                                        <td><input type="checkbox" name="name[permission][can-delete]" value="1"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>User</td>
                                        <td><input type="checkbox" name="name[user][can-add]" value="1"></td>
                                        <td><input type="checkbox" name="name[user][can-edit]" value="1"></td>
                                        <td><input type="checkbox" name="name[user][can-view]" value="1"></td>
                                        <td><input type="checkbox" name="name[user][can-delete]" value="1"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Event</td>
                                        <td><input type="checkbox" name="name[event][can-add]" value="1"></td>
                                        <td><input type="checkbox" name="name[event][can-edit]" value="1"></td>
                                        <td><input type="checkbox" name="name[event][can-view]" value="1"></td>
                                        <td><input type="checkbox" name="name[event][can-delete]" value="1"></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Contribution</td>
                                        <td><input type="checkbox" name="name[contribution][can-add]" value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-edit]" value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-view]" value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-delete]" value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-download]" value="1"></td>
                                        <td><input type="checkbox" name="name[contribution][can-comment]" value="1"></td>
                                    </tr>

                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection