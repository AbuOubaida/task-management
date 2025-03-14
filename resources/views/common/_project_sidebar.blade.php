@if(Request::segment(2) == "project" )
    <a class="nav-link text-capitalize" href="#" data-bs-toggle="collapse" data-bs-target="#projects" aria-expanded="true" aria-controls="projects">
        <div class="sb-nav-link-icon"><i class="fa-solid fa-sign-hanging"></i></div>
        Projects
        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
    </a>
    <div class="collapse show" id="projects" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionprojects">
        @else
            <a class="nav-link collapsed text-black" href="#" data-bs-toggle="collapse" data-bs-target="#projects" aria-expanded="false" aria-controls="projects">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-sign-hanging"></i></div>
                Projects
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="projects" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionprojects">
                @endif
                <nav class="sb-sidenav-menu-nested nav">
                    @if(Route::currentRouteName() == 'add.project')
                        <a class="nav-link text-capitalize" href="{{route('add.project')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div> Add</a>
                    @else
                        <a class="nav-link text-black" href="{{route('add.project')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-plus"></i></div> Add</a>
                    @endif
                    @if(Route::currentRouteName() == 'project.list')
                        <a class="nav-link text-capitalize" href="{{route('project.list')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div> List</a>
                    @else
                        <a class="nav-link text-black" href="{{route('project.list')}}"><div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div> List</a>
                    @endif
                </nav>
            </div>
