<div id="layoutSidenav_content">
    <main>
        @php
            $user = Auth::user();
        @endphp
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    <i class="far fa-smile me-1"></i> 
                    <span class="text-primary blink">Welcome {{ Auth::user()->role->name }} to the application</span>
                </li>
            </ol> 

            <div class="row">
                @if($user->isAdmin() || $user->isMarketingManager())
                {{-- folder user --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Users
                            <p><i class="fas fa-user fa-fw" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('users.index') }}" style="font-size:18px;"> 
                                {{App\Models\User::all()->count()}}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>
                {{-- Folder Faculty --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Faculty
                            <p><i class="fas fa-home" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('facultys.index') }}" style="font-size:18px;">
                                {{App\Models\Faculty::all()->count()}}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>
                {{-- Folder Event --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Event
                            <p><i class="fas fa-envelope" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('events.index') }}" style="font-size:18px;">
                                {{App\Models\Event::all()->count()}}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>
                {{-- Folder Contribution --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body"> Contribution
                            <p><i class="fas fa-book" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('contributions.index') }}" style="font-size:18px;">
                                
                                {{App\Models\Contribution::all()->count()}}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>

                @elseif($user->isMarketingCoordination())
                  {{-- Folder Faculty --}}
                  <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Faculty
                            <p><i class="fas fa-home" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('facultys.index') }}" style="font-size:18px;">
                                {{ App\Models\Faculty::where('name', $user->faculty->name)->count() }}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>

                {{-- Folder Event --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Event
                            <p><i class="fas fa-envelope" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('events.index') }}" style="font-size:18px;">
                                {{ App\Models\Event::where('faculty_id', $user->faculty->id)->count() }}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>

                {{-- Folder Contribution --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body"> Contribution
                            <p><i class="fas fa-book" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('contributions.index') }}" style="font-size:18px;">
                                
                                {{ App\Models\Contribution::where('faculty_id', $user->faculty->id)->count() }}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>

                @elseif($user->isStudent() || $user->isGuest())
                {{-- Folder Faculty --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Faculty
                            <p><i class="fas fa-home" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('facultys.index') }}" style="font-size:18px;">
                                {{ App\Models\Faculty::where('name', $user->faculty->name)->count() }}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>

                 {{-- Folder Event --}}
                 <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Event
                            <p><i class="fas fa-envelope" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('events.index') }}" style="font-size:18px;">
                                {{ App\Models\Event::where('faculty_id', $user->faculty->id)->count() }}
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>

                {{-- Folder Contribution --}}
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Contribution
                            <p><i class="fas fa-book" style="font-size:100px;"></i></p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('contributions.index') }}" style="font-size:18px;">
                                {{ App\Models\Contribution::where('faculty_id', $user->faculty->id)->count() }} 
                            </a>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card mb-4">
                        <div class="card-header bg-gradient-primary">Your Details</div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" style="background-color: #FFA500;">
                                    <strong>Email:</strong> {{ Auth::user()->email }}
                                </li>
                                <li class="list-group-item" style="background-color: #FFA500;">
                                    <strong>Address:</strong> {{ Auth::user()->address }}
                                </li>
                                <li class="list-group-item" style="background-color: #FFA500;">
                                    <strong>Mobile Phone number:</strong> {{ Auth::user()->phone_number }}
                                </li>
                                <li class="list-group-item" style="background-color: #FFA500;">
                                    <strong>Designation:</strong> {{ Auth::user()->designation }}
                                </li>
                                <li class="list-group-item" style="background-color: #FFA500;">
                                    <strong>Start date:</strong> {{ Auth::user()->start_from }}
                                </li>
                                <li class="list-group-item" style="background-color: #FFA500;">
                                    <strong>Faculty:</strong> {{ Auth::user()->faculty->name }}
                                </li>
                                <li class="list-group-item" style="background-color: #FFA500;">
                                    <strong>Role:</strong> <span class="badge rounded-pill bg-success">{{ Auth::user()->role->name }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Area Chart Example
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Bar Chart Example
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div>
            {{-- <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                       
                    </table>
                </div>
            </div> --}}
        </div>
    </main>
