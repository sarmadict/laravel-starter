<!-- start: USER OPTIONS DROPDOWN -->
<li class="dropdown current-user">
    <a href class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{ $auth->image_link }}" alt="{{ $auth->display_name }}">
        <span class="username">{{ $auth->display_name }} <i class="ti-angle-down"></i></span>
    </a>
    <ul class="dropdown-menu dropdown-dark">
        <li>
            <a href="pages_user_profile.html">
                My Profile
            </a>
        </li>
        <li>
            <a href="pages_calendar.html">
                My Calendar
            </a>
        </li>
        <li>
            <a hef="pages_messages.html">
                My Messages (3)
            </a>
        </li>
        <li>
            <a href="login_lockscreen.html">
                Lock Screen
            </a>
        </li>
        <li>
            <a href="{{ route('accounts.auth.logout') }}">
                @lang('admin.default.elements.logout')
            </a>
        </li>
    </ul>
</li>
<!-- end: USER OPTIONS DROPDOWN -->