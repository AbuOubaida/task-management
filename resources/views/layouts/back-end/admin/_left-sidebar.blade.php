<nav class="sb-sidenav accordion " id="sidenavAccordion" style="background: #f0ffffde;">
    <div class="sb-sidenav-menu">
        <div class="nav">
        @if(Route::currentRouteName() == 'dashboard')
            <a class="nav-link text-capitalize" href="{{route('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
        @else
            <a class="nav-link text-black" href="{{route('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->roles->first()->name == 'administrator')
            @if(Request::segment(2) == "user" )
                <a class="nav-link text-capitalize" href="#" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="true" aria-controls="users">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse show" id="users" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionusers">
            @else
                <a class="nav-link collapsed text-black" href="#" data-bs-toggle="collapse" data-bs-target="#users" aria-expanded="false" aria-controls="users">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="users" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionusers">
            @endif
                    <nav class="sb-sidenav-menu-nested nav">
                        @if(Route::currentRouteName() == 'add.user')
                            <a class="nav-link text-capitalize" href="{{route('add.user')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div> Add</a>
                        @else
                            <a class="nav-link text-black" href="{{route('add.user')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i></div> Add</a>
                        @endif
                        @if(Route::currentRouteName() == 'user.list')
                            <a class="nav-link text-capitalize" href="{{route('user.list')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div> List</a>
                        @else
                            <a class="nav-link text-black" href="{{route('user.list')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div> List</a>
                        @endif
                    </nav>
                </div>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->roles->first()->name == 'administrator' || Illuminate\Support\Facades\Auth::user()->roles->first()->name == 'project_manager')
            @include('common._project_sidebar')
        @endif
        </div>
    </div>
    <div class="sb-sidenav-footer text-black">
        <div class="small">
            Welcome Mr./Ms. {{\Illuminate\Support\Facades\Auth::user()->name}}
        </div>
        <div class="small">Logged in
            as: {!! \Illuminate\Support\Facades\Auth::user()->roles->first()->display_name !!}</div>
        <a href="https://github.com/abuoubaida" class="text-decoration-none text-black" title="Abu Oubaida, MIS Dept.">Oubaida
            ❤️
        </a>{{config('app.name')}} {{date('Y')}}
    </div>
</nav>
