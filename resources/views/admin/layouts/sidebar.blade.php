<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{ url('/') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    @if (isset(auth()->user()->role->permission['name']['home']['can-view']))
                        <a class="nav-link" href="{{ url('/home') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Blog
                        </a>
                    @endif

                    <div class="sb-sidenav-menu-heading">Interface</div>
                        {{-- navbar Faculty --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Faculty
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                {{-- create permission faculty --}}
                                @if (isset(auth()->user()->role->permission['name']['faculty']['can-add']))
                                    <a class="nav-link" href="{{ route('facultys.create') }}">Create Faculty</a>
                                @endif
                                @if (isset(auth()->user()->role->permission['name']['faculty']['can-view']))
                                    <a class="nav-link" href="{{ route('facultys.index') }}">View Faculty</a>
                                @endif
                            </nav>
                        </div>

                        {{-- class user navbar : role - user - permission --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                            Users
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                {{-- navbar Role --}}
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Role
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">

                                            {{-- Create permission Role --}}
                                            @if (isset(auth()->user()->role->permission['name']['role']['can-add']))
                                                <a class="nav-link" href="{{ route('roles.create') }}">Create Role</a>
                                            @endif

                                            @if (isset(auth()->user()->role->permission['name']['role']['can-view']))
                                                <a class="nav-link" href="{{ route('roles.index') }}">View Role</a>
                                            @endif

                                        </nav>
                                    </div>
                                {{-- navbar user --}}
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    User
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            {{-- Create Permission User --}}
                                            @if (isset(auth()->user()->role->permission['name']['user']['can-add']))
                                                <a class="nav-link" href="{{ route('users.create') }}">Create User</a>
                                            @endif
                                            @if (isset(auth()->user()->role->permission['name']['user']['can-add']))
                                                <a class="nav-link" href="{{ route('users.index') }}">View User</a>
                                            @endif
                                        </nav>
                                    </div>
                                
                                    <a class="nav-link collapsed" href="{{ route('roles.index') }}" data-bs-toggle="collapse"
                                    data-bs-target="#pagesCollapsePermission" aria-expanded="false"
                                    aria-controls="pagesCollapsePermission">
                                    Permission
                                    <div class="sb-sidenav-collapse-arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </a>
                                <div class="collapse" id="pagesCollapsePermission" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        {{-- Create Permission --}}
                                        @if (isset(auth()->user()->role->permission['name']['permission']['can-add']))
                                            <a class="nav-link" href="{{ route('permissions.create') }}">Create
                                                Permission</a>
                                        @endif
                                        {{-- view Permission --}}
                                        @if (isset(auth()->user()->role->permission['name']['permission']['can-view']))
                                            <a class="nav-link" href="{{ route('permissions.index') }}">View Permission</a>
                                        @endif
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        {{-- navbar Event --}}
                        @if (isset(auth()->user()->role->permission['name']['event']['can-view']))
                        <a class="nav-link" href="{{ route('events.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-meteor"></i></div>
                            Event
                        </a>
                        @endif
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEvent" aria-expanded="false" aria-controls="collapseEvent">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-meteor"></i></i></div>
                            Event
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseEvent" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('events.create') }}">Create Event</a>
                                <a class="nav-link" href="{{ route('events.index') }}">View Event</a>
                            </nav>
                        </div> --}}

                        {{-- navbar Contribution --}}
                        @if (isset(auth()->user()->role->permission['name']['contribution']['can-view']))
                        <a class="nav-link" href="{{ route('contributions.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Contribution
                        </a>
                        @endif
                        {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseContribution" aria-expanded="false" aria-controls="collapseContribution">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Contribution
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a> --}}
                        {{-- <div class="collapse" id="collapseContribution" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('contributions.create') }}">Add contribution</a>
                                <a class="nav-link" href="{{ route('contributions.index') }}">View contribution</a>
                            </nav>
                        </div> --}}

                    {{-- <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a> --}}
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{Auth::user()->role->name}}
            </div>
        </nav>
    </div>