<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        @if(auth()->guard('admin')->check())
        <a href="{{route('admin.index')}}">
                <h3 class="pb-2 display-5 ">Student System</h3>
            </a>
        @else
        <a href="{{route('student.show',auth()->user()->id)}}">
                <h3 class="pb-2 display-5 ">Student System</h3>
            </a>
        @endif
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
               @if(auth()->guard('admin')->check())

               <li class="active has-sub">
                <a class="js-arrow" href="#">
                    <i class="fa fa-users"></i>Students</a>
                <ul class="list-unstyled navbar__sub-list js-sub-list">

                    <li>
                    <a href="{{route('student.index')}}">Manage Students</a>
                    </li>


                </ul>
            </li>

               <li class="active has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fa fa-book"></i>Courses</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">

                        <li>
                        <a href="{{route('admin.index')}}">My Courses</a>
                        </li>


                    </ul>
                </li>
                @else

                        <li class="active">
                        <a href="{{route('student.show',auth()->user()->id)}}"> <i class="fa fa-home"></i>HomePage</a>
                        </li>


                <li class="active has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fa fa-book"></i>Courses</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">


                                <li>
                                <a href="{{route('courses.index')}}">Avaliable Courses</a>
                              </li>



                        </ul>
                    </li>
                @endif
{{--
                <li>
                    <a href="chart.html">
                        <i class="fas fa-chart-bar"></i>Charts</a>
                </li> --}}


            </ul>
        </nav>
    </div>
</aside>
