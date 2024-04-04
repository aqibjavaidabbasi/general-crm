<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>

            <li class="nav-item">
                {{-- <a class="nav-link menu-link" href="widgets.html"> --}}
                <a class="nav-link menu-link {{ request()->is('*/dashboard') ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <i class="ri-home-7-fill"></i> <span data-key="t-dashboard">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->is('*/media/*') ? 'active' : '' }}"
                    href="{{ route('media.create') }}">
                    <i class="ri-video-upload-fill"></i> <span data-key="t-media">Media</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->is('*/blog/*') ? 'active' : '' }}" href="#sidebarApps"
                    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                    <i class="ri-bold"></i> <span data-key="t-apps">Blog</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->is('*/blog/*') ? 'show' : '' }}" id="sidebarApps">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('add-blog.index') }}"
                                class="nav-link {{ Request::is('*/add-blog') ? 'active' : '' }}" data-key="t-calendar">
                                All Blogs </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add-blog.create') }}"
                                class="nav-link {{ Request::is('*/blog/add-blog/*') ? 'active' : '' }}"
                                data-key="t-chat"> Add New Blog </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ Request::is('*/category/*') || Request::is('*/category') ? 'active' : '' }}"
                                data-key="t-chat"> Categories </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tag.index') }}"
                                class="nav-link {{ Request::is('*/tag/*') || Request::is('*/tag') ? 'active' : '' }}"
                                data-key="t-chat"> Tags </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-key="t-chat"> Comments </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-chat.html" class="nav-link" data-key="t-chat"> CSV Import & Export </a>
                        </li>
                        <li class="nav-item">
                            <a href="#sidebarEmail" class="nav-link" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarEmail" data-key="t-email">
                                Settings
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarEmail">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="apps-mailbox.html" class="nav-link" data-key="t-mailbox"> Blog Share
                                            Settings </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="apps-mailbox.html" class="nav-link" data-key="t-mailbox"> Comment
                                            Settings </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </li>
            {{-- Pages --}}
            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->is('*/pages/*') ? 'active' : '' }}" href="#pages"
                    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pages">
                    <i class="ri-pages-line"></i> <span data-key="t-apps">Pages</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->is('*/pages/*') ? 'pages' : '' }}" id="pages">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('pages.index') }}" class="nav-link" data-key="t-calendar"> All Pages </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pages.create') }}" class="nav-link" data-key="t-calendar"> Add New Pages
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

            {{-- users --}}

            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->is('*/users/*') ? 'active' : '' }}" href="#users"
                    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="users">
                    <i data-feather="users"></i> <span data-key="t-apps">Users</span>
                </a>
                <div class="collapse menu-dropdown {{ request()->is('*/users/*') || request()->is('*/users') ? 'show' : '' }}"
                    id="users">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ Request::is('*/users') || request()->is('*/users/*') ? 'active' : '' }}"
                                data-key="t-calendar">Users</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link" data-key="t-calendar">Roles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link" data-key="t-calendar">Permissions
                            </a>
                        </li>
                    </ul>
                </div>


        </ul>
    </div>
    <!-- Sidebar -->
</div>
