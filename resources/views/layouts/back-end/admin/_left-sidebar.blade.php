<nav class="sb-sidenav accordion " id="sidenavAccordion" style="background: #f0ffffde;">
    <div class="sb-sidenav-menu">
        <div class="nav">
        @if(Route::currentRouteName() == 'dashboard')
            <a class="nav-link" href="{{route('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
        @else
            <a class="nav-link text-black" href="{{route('dashboard')}}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
        @endif
{{--        @if(Route::currentRouteName() == 'home.page' )--}}
{{--            <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target="#pages" aria-expanded="true" aria-controls="pages">--}}
{{--                <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>--}}
{{--                Pages--}}
{{--                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--            </a>--}}
{{--            <div class="collapse show" id="pages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">--}}
{{--        @else--}}
{{--            <a class="nav-link collapsed text-black" href="#" data-bs-toggle="collapse" data-bs-target="#pages" aria-expanded="false" aria-controls="pages">--}}
{{--                <div class="sb-nav-link-icon"><i class="fa-solid fa-folder"></i></div>--}}
{{--                Pages--}}
{{--                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>--}}
{{--            </a>--}}
{{--            <div class="collapse" id="pages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">--}}
{{--        @endif--}}
{{--                <nav class="sb-sidenav-menu-nested nav">--}}
{{--                    @if(Route::currentRouteName() == 'home.page')--}}
{{--                        <a class="nav-link" href="{{route('home.page')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div> Home</a>--}}
{{--                    @else--}}
{{--                        <a class="nav-link text-black" href="{{route('home.page')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div> Home</a>--}}
{{--                    @endif--}}
{{--                    @if(Route::currentRouteName() == 'about.page')--}}
{{--                        <a class="nav-link" href="{{route('about.page')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-info"></i></div> About</a>--}}
{{--                    @else--}}
{{--                        <a class="nav-link text-black" href="{{route('about.page')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-info"></i></div> About</a>--}}
{{--                    @endif--}}
{{--                </nav>--}}
{{--            </div>--}}
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
