<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Menu</span></li>

            <li class="nav-item">
                <a class="nav-link menu-link {{ request()->is('*/dashboard') ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <i class="ri-home-7-fill"></i> <span data-key="t-dashboard">Dashboard</span>
                </a>
            </li>

            @canany(['create_media', 'edit_media', 'delete_media', 'show_media'])
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*/media/*') ? 'active' : '' }}"
                        href="{{ route('media.create') }}">
                        <i class="ri-video-upload-fill"></i> <span data-key="t-media">Media</span>
                    </a>
                </li>
            @endcanany

            @canany(['create_blog', 'edit_blog', 'delete_blog', 'show_blog', 'show_categories_blog',
                'create_categories_blog', 'edit_categories_blog', 'delete_categories_blog', 'show_tags_blog',
                'create_tags_blog', 'edit_tags_blog', 'delete_tags_blog', 'show_comments_blog', 'create_comments_blog',
                'edit_comments_blog', 'delete_comments_blog'])
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*/blog/*') ? 'active' : '' }}" href="#sidebarApps"
                        data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-bold"></i> <span data-key="t-apps">Blog</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->is('*/blog/*') ? 'show' : '' }}" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            @can('show_blog')
                                <li class="nav-item">
                                    <a href="{{ route('add-blog.index') }}"
                                        class="nav-link {{ Request::is('*/add-blog') ? 'active' : '' }}" data-key="t-calendar">
                                        All Blogs </a>
                                </li>
                            @endcan

                            @can('create_blog')
                                <li class="nav-item">
                                    <a href="{{ route('add-blog.create') }}"
                                        class="nav-link {{ Request::is('*/blog/add-blog/*') ? 'active' : '' }}"
                                        data-key="t-chat"> Add New Blog </a>
                                </li>
                            @endcan

                            @canany(['show_categories_blog', 'create_categories_blog', 'edit_categories_blog',
                                'delete_categories_blog'])
                                <li class="nav-item">
                                    <a href="{{ route('category.index') }}"
                                        class="nav-link {{ Request::is('*/category/*') || Request::is('*/category') ? 'active' : '' }}"
                                        data-key="t-chat"> Categories </a>
                                </li>
                            @endcanany


                            @canany(['show_tags_blog', 'create_tags_blog', 'edit_tags_blog', 'delete_tags_blog'])
                                <li class="nav-item">
                                    <a href="{{ route('tag.index') }}"
                                        class="nav-link {{ Request::is('*/tag/*') || Request::is('*/tag') ? 'active' : '' }}"
                                        data-key="t-chat"> Tags </a>
                                </li>
                            @endcanany


                            @canany(['show_comments_blog', 'create_comments_blog', 'edit_comments_blog',
                                'delete_comments_blog'])
                                <li class="nav-item">
                                    <a class="nav-link" data-key="t-chat"> Comments </a>
                                </li>
                            @endcanany
                            <li class="nav-item">
                                <a href="apps-chat.html" class="nav-link" data-key="t-chat"> CSV Import & Export </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEmail" class="nav-link {{ Request::is('*/comment-setting') || Request::is('*/blog-share-options') ? 'active' : ''}}" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebarEmail" data-key="t-email">
                                    Settings
                                </a>
                                <div class="collapse menu-dropdown {{ Request::is('*/comment-setting') || Request::is('*/blog-share-options') ? 'show' : ''}}" id="sidebarEmail">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="apps-mailbox.html" class="nav-link " data-key="t-mailbox"> Blog Share
                                                Settings </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('comment-setting.index') }}" class="nav-link {{ Request::is('*/comment-setting') ? 'active' : '' }}" data-key="t-mailbox"> Comment
                                                Settings </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </li>
            @endcanany

            {{-- Pages --}}
            @canany(['show_pages', 'create_pages', 'edit_pages', 'delete_pages'])
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
            @endcanany

            {{-- users --}}
            @canany(['show_users', 'create_users', 'edit_users', 'delete_users', 'create_roles', 'show_roles',
                'edit_roles', 'delete_roles', 'create_permissions', 'show_permissions', 'edit_permissions',
                'delete_permissions'])
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('*/users/*') ? 'active' : '' }}" href="#users"
                        data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="users">
                        <i data-feather="users"></i> <span data-key="t-apps">Users</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->is('*/users/*') || request()->is('*/users') || request()->is('*/roles/*') || request()->is('*/roles') || request()->is('*/permissions') ? 'show' : '' }}"
                        id="users">
                        <ul class="nav nav-sm flex-column">
                            @canany(['show_users', 'create_users', 'edit_users', 'delete_users'])
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}"
                                        class="nav-link {{ Request::is('*/users') || request()->is('*/users/*') ? 'active' : '' }}"
                                        data-key="t-calendar">Users</a>
                                </li>
                            @endcanany

                            @canany(['create_roles', 'show_roles', 'edit_roles', 'delete_roles'])
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}"
                                        class="nav-link {{ Request::is('*/roles/*') || Request::is('*/roles') ? 'active' : '' }}"
                                        data-key="t-calendar">Roles
                                    </a>
                                </li>
                            @endcanany

                            @canany(['create_permissions', 'show_permissions', 'edit_permissions', 'delete_permissions'])
                                <li class="nav-item">
                                    <a href="{{ route('permissions.index') }}"
                                        class="nav-link {{ Request::is('*/permissions') ? 'active' : '' }}"
                                        data-key="t-calendar">Permissions
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </div>
                </li>
            @endcanany
        </ul>
    </div>
    <!-- Sidebar -->
</div>
