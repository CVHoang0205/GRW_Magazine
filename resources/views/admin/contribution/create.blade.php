@extends('admin.layouts.master')

@section('content')
    <div class="container mt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    
                </li>
            </ol>
        </nav>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        
        {{-- error finaldate event --}}
        @if (Session::has('error'))
            <div class="alert alert-warning">
                {{ Session::get('error') }}
            </div>
        @endif
        
        <form action="{{ route('contributions.store')}}" method="post" enctype="multipart/form-data">@csrf

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header"> Add Contribution </h1> </div>
                        <div class="card-body">

                            {{-- <div class="form-group">
                                <label>Created By</label>

                                <select class="form-control" name="user_id" required="">

                                    @foreach (App\Models\User as $user)
                                        <option value="{{ $user->id }}">
                                            {{  Auth()->user()->name  }}
                                        </option>
                                    @endforeach

                                </select>

                            </div> --}}

                            <div class="form-group mt-4">
                                <label>Created By</label>
                                <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" required="" value="{{auth()->user()->name}}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        @error('user_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
        
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="validationCustom02" required>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" id="validationCustom02" required>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" name="file[]" class="form-control @error('file.*') is-invalid @enderror" id="validationCustom02" required multiple>
                                @error('file.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class="form-group">
                                <label>File</label>
                                <input type="file" name="file[]" class="form-control @error('file.*') is-invalid @enderror" id="validationCustom02" required multiple>
                                @error('file.*')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> --}}

                            <div class="form-group">
                                <label>Faculty</label>
                                <div class="form-control">{{ auth()->user()->faculty->name }}</div>
                                <input type="hidden" name="faculty_id" value="{{ auth()->user()->faculty_id }}">
                            </div>

                            <div class="form-group">
                                <label>Event</label>
                                <select class="form-control" name="event_id" required="">
                                    @foreach (App\Models\Event::where('faculty_id', auth()->user()->faculty_id)->get() as $event)
                                        <option value="{{ $event->id }}">
                                            {{ $event->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#confirmationModal">Submit</button>
                            </div>
                            {{-- Model Alert --}}
                            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                Contribution Terms and Guidelines for Events !
                                            </div>
                                            <div class="mt-4">
                                                <label for="consentCheckbox1"><input type="checkbox" id="consentCheckbox1">1 - Contribution Commitment: By confirming your contribution to the event, you commit to actively and professionally carry out your contribution, reflecting your dedication and care for the event.</label><br>
                                            </div>
                                            
                                            <div class="mt-4">
                                                <label for="consentCheckbox2"><input type="checkbox" id="consentCheckbox2">2 - Adherence to Instructions: You agree to comply with all instructions and requirements provided by the event organizers, including timing, format, and content of the contribution.</label><br>
                                            </div>
                                            <div class="mt-4">
                                                <label for="consentCheckbox3"><input type="checkbox" id="consentCheckbox3">3 - Quality and Creativity: You agree to provide contributions of the highest possible quality, reflecting your creativity and motivation. You also agree not to copy or reuse content from unauthorized sources.</label><br>
                                            </div>
                                            <div class="mt-4">
                                                <label for="consentCheckbox4"><input type="checkbox" id="consentCheckbox4">4 - Respect and Collaboration: You commit to respecting the viewpoints and opinions of others and participating in activities and discussions with a spirit of cooperation and constructive engagement.</label><br>
                                            </div>
                                            <div class="mt-4">
                                                <label for="consentCheckbox5"><input type="checkbox" id="consentCheckbox5">5 - Compliance with Regulations: You agree to abide by all regulations and guidelines set forth by the event organizers and accept responsibility for the consequences of any violations.</label><br>
                                            </div>
                                            <div class="mt-4">
                                                <label for="consentCheckbox6"><input type="checkbox" id="consentCheckbox6">6 - Consent: By confirming your contribution, you understand and acknowledge that your consent to these terms and guidelines is binding and cannot be changed.</label><br>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Model --}}
                            <script>
                                function submitForm() 
                                {
                                    var consentCheckbox1 = document.getElementById('consentCheckbox1').checked;
                                    var consentCheckbox2 = document.getElementById('consentCheckbox2').checked;
                                    var consentCheckbox3 = document.getElementById('consentCheckbox3').checked;
                                    var consentCheckbox4 = document.getElementById('consentCheckbox4').checked;
                                    var consentCheckbox5 = document.getElementById('consentCheckbox5').checked;
                                    var consentCheckbox6 = document.getElementById('consentCheckbox6').checked;
                                    // Kiểm tra xem tất cả các checkbox đã được chọn hay không
                                    if (consentCheckbox1 && consentCheckbox2 && consentCheckbox3 && consentCheckbox4 && consentCheckbox5 && consentCheckbox6) {
                                        // Nếu tất cả các checkbox đã được chọn, cho phép nộp bài
                                        document.getElementById('submitForm').submit();
                                    } else {
                                        // Nếu một hoặc nhiều checkbox chưa được chọn, hiển thị thông báo lỗi
                                        alert("Please consent to all terms before submitting!");
                                    }
                                }
                            </script>

                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </form>
    </div> 
@endsection

