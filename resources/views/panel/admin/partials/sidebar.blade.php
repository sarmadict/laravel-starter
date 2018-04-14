<div class="sidebar app-aside" id="sidebar">
    <div class="sidebar-container perfect-scrollbar">
        <nav>
            <!-- start: SEARCH FORM -->
            <div class="search-form">
                <a class="s-open" href="#">
                    <i class="ti-search"></i>
                </a>
                <form class="navbar-form" role="search">
                    <a class="s-remove" href="#" target=".navbar-form">
                        <i class="ti-close"></i>
                    </a>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <button class="btn search-button" type="submit">
                            <i class="ti-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- end: SEARCH FORM -->
            <!-- start: MAIN NAVIGATION MENU -->
            <div class="navbar-title">
                <span>@lang('panel.admin.sidebar_menu')</span>
            </div>
            <ul class="main-navigation-menu">
                @foreach($sidebar_menu as $menuItem)
                    <li class="{{ $menuItem->showActiveClass() }}">
                        <a href="{{ $menuItem->route }}">
                            <div class="item-content">
                                <div class="item-media">
                                    <i class="{{ $menuItem->icon }}"></i>
                                </div>
                                <div class="item-inner">
                                    <span class="title"> {{ $menuItem->title }} </span>
                                    @if($menuItem->hasSubMenu())
                                        <i class="icon-arrow"></i>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @if($menuItem->hasSubMenu())
                            <ul class="sub-menu">
                                @foreach($menuItem->getSubMenu() as $subMenuItem)
                                    <li class="{{ $subMenuItem->showActiveClass() }}">
                                        <a href="{{ $subMenuItem->route() }}">
                                            <span class="title"> {{ $subMenuItem->title }} </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
            <!-- end: MAIN NAVIGATION MENU -->
            <!-- start: CORE FEATURES -->
        {{--<div class="navbar-title">--}}
        {{--<span>Core Features</span>--}}
        {{--</div>--}}
        {{--<ul class="folders">--}}
        {{--<li>--}}
        {{--<a href="pages_calendar.html">--}}
        {{--<div class="item-content">--}}
        {{--<div class="item-media">--}}
        {{--<span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>--}}
        {{--</div>--}}
        {{--<div class="item-inner">--}}
        {{--<span class="title"> Calendar </span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--<li>--}}
        {{--<a href="pages_messages.html">--}}
        {{--<div class="item-content">--}}
        {{--<div class="item-media">--}}
        {{--<span class="fa-stack"> <i class="fa fa-square fa-stack-2x"></i> <i class="fa fa-folder-open-o fa-stack-1x fa-inverse"></i> </span>--}}
        {{--</div>--}}
        {{--<div class="item-inner">--}}
        {{--<span class="title"> Messages </span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        <!-- end: CORE FEATURES -->
            <!-- start: DOCUMENTATION BUTTON -->
        {{--<div class="wrapper">--}}
        {{--<a href="documentation.html" class="button-o">--}}
        {{--<i class="ti-help"></i>--}}
        {{--<span>Documentation</span>--}}
        {{--</a>--}}
        {{--</div>--}}
        <!-- end: DOCUMENTATION BUTTON -->
        </nav>
    </div>
</div>