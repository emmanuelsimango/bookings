<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ __('PR') }}</a>
            <a href="#" class="simple-text logo-normal">{{ __('Projector Register') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            @if(Auth::user()->role_id==1)
                <li @if ($pageSlug == 'booking') class="active " @endif>
                    <a href="{{ route('booking') }}">
                        <i class="tim-icons icon-planet"></i>
                        <p>{{ __('Bookings') }}</p>
                    </a>
                </li>
            @endif
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('Users') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit',['id'=>auth()->user()->id])  }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('Profile ') }}</p>
                            </a>
                        </li>
                        @if(Auth::user()->role_id==1)
                            <li @if ($pageSlug == 'users') class="active " @endif>
                                <a href="{{ route('user.index')  }}">
                                    <i class="tim-icons icon-bullet-list-67"></i>
                                    <p>{{ __('User Management') }}</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'projector') class="active " @endif>
                <a href="{{ route('projector') }}">
                    <i class="tim-icons icon-pin"></i>
                    <p>{{ __('Projectors') }}</p>
                </a>
            </li>
            @if(Auth::user()->role_id>1)
                <li @if ($pageSlug == 'myProjectors') class="active " @endif>
                    <a href="/myProjectors">
                        <i class="tim-icons icon-planet"></i>
                        <p>{{ __('My projectors') }}</p>
                    </a>
                </li>
            @endif
            @if(Auth::user()->role_id==1)
                <li @if ($pageSlug == 'department') class="active " @endif>
                    <a href="{{ route('department') }}">
                        <i class="tim-icons icon-atom"></i>
                        <p>{{ __('Departments') }}</p>
                    </a>
                </li>
            @endif

            @if(Auth::user()->role_id==1)
                <li @if ($pageSlug == 'reports') class="active " @endif>
                    <a href="/reports">
                        <i class="tim-icons icon-atom"></i>
                        <p>{{ __('Reports') }}</p>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>
