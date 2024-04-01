@extends('admin.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            <form action="{{ route('facultys.store') }}" method="post" class="row g-3 needs-validation" novalidate>@csrf
                <div class="card">
                    <div class="card-header">{{ __('Create New Faculty') }}</div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="validationCustom02" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea placeholder="" id="description" class="form-control" name="description" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
