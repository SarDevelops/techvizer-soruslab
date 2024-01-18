@php
$setting_section_menu = ['settings', 'email_template', 'activity_logs', 'cms_pages'];
$setting_section_show = is_section_menu($setting_section_menu);
$setting_section_show = $setting_section_show ? 'show' : 'hidden';

$cms_section_menu = [ 'slider', 'test_report', 'health_concern'];
$cms_section_show = is_section_menu($cms_section_menu);
$cms_section_show = $cms_section_show ? 'show' : 'hidden';


$general_setting_section_menu = ['settings', 'email_template', 'activity_logs', 'contact_us'];
$general_setting_section_show = is_section_menu($general_setting_section_menu);
$general_setting_section_show = $general_setting_section_show ? 'show' : 'hidden';
@endphp
<div class="px-3 menu menu-column menu-rounded menu-sub-indention" id="#kt_app_sidebar_menu" data-kt-menu="true"
    data-kt-menu-expand="false">
    <div class="pt-5 menu-item">
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">System Modules</span>
        </div>
    </div>

    <div class="menu-item">
        <a class="menu-link {{ is_active_menu(['admin.dashboard']) }}" href="{{ route('admin.dashboard') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                    </svg>
                </span>
            </span>
            <span class="menu-title">Dashboard</span>
        </a>
    </div>
    {{-- User Module --}}
    @can('user:view')
    <div class="menu-item">
        <a class="menu-link  {{ is_active_menu(['admin.users.index']) }}" href="{{ route('admin.users.index') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <i class="fas fa-user"></i>
                </span>
            </span>
            <span class="menu-title">Manage Users</span>
        </a>
    </div>
    @endcan

    @can('role_permission:view')
    <div class="menu-item">
        <a class="menu-link  {{ is_active_menu(['admin.role_permissions.index']) }}" href="{{ route('admin.role_permissions.index') }}" >
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <i class="fas fa-user-tag"></i>
                </span>
            </span>
            <span class="menu-title">Manage Role Permissions</span>
        </a>
    </div>
    @endcan

    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ is_active_menu(['admin.pages.index', 'admin.tests.index', 'admin.health_concerns.index']) ? 'show' : '' }} "
        {{ $cms_section_show }}>
        <span class="menu-link">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <i class="fa-solid fa-swatchbook"></i>
                </span>
            </span>
            <span class="menu-title">CMS Pages</span>
            <span class="menu-arrow"></span>
        </span>
        @can('slider:view')
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ is_active_menu(['admin.pages.index']) }}"
                    href="{{ route('admin.pages.index') }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-sliders"></i>
                        </span>
                    </span>
                    <span class="menu-title"> Sliders </span>
                </a>
            </div>
        </div>
        @endcan
        @can('test_report:view')
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link {{ is_active_menu(['admin.tests.index']) }}" href="{{ route('admin.tests.index') }}" >
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-notes-medical"></i>
                        </span>
                    </span>
                    <span class="menu-title"> Test Reports </span>
                </a>
            </div>
        </div>
        @endcan
        @can('health_concern:view')
        <div class="menu-sub menu-sub-accordion">
            <div class="menu-item">
                <a class="menu-link  {{ is_active_menu(['admin.health_concerns.index']) }} " href="{{ route('admin.health_concerns.index') }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-laptop-medical"></i>
                        </span>
                    </span>
                    <span class="menu-title"> Health Concerns Reports </span>
                </a>
            </div>
        </div>
    </div>
    @endcan
    @can('package:view')
    <div class="menu-item">
        <a class="menu-link  {{ is_active_menu(['admin.packages.index']) }}" href="{{ route('admin.packages.index') }}">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <i class="fa-solid fa-cubes"></i>
                </span>
            </span>
            <span class="menu-title">Packages</span>
        </a>
    </div>
    @endcan

    <div class="pt-5 menu-item" {{ $setting_section_show }}>
        <div class="menu-content">
            <span class="menu-heading fw-bold text-uppercase fs-7">Settings</span>
        </div>
    </div>
    <div data-kt-menu-trigger="click"
        class="menu-item menu-accordion {{ is_active_menu(['admin.settings', 'admin.activity_logs', 'contact_us',  ]) ? 'show' : '' }}"
        {{ $general_setting_section_show }}>
        <span class="menu-link">
            <span class="menu-icon">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                            d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
                            fill="white" />
                        <path
                            d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
                            fill="white" />
                    </svg>
                </span>
            </span>
            <span class="menu-title">General Setttings</span>
            <span class="menu-arrow"></span>
        </span>

        <div class="menu-sub menu-sub-accordion">
            {{-- Settings --}}
            {{-- @can('settings:view') --}}
            <div class="menu-item">
                <a class="menu-link {{ is_active_menu(['admin.settings']) }}" href="{{ route('admin.settings') }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fas fa-cogs"></i>
                        </span>
                    </span>
                    <span class="menu-title">Manage Site Settings</span>
                </a>
            </div>
            {{-- @endcan --}}

            {{-- Email templates --}}
            @can('email_template:view')
            <div data-kt-menu-trigger="click"
                class="menu-item menu-accordion ">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z"
                                    fill="white" />
                                <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z"
                                    fill="white" />
                                <path opacity="0.3"
                                    d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z"
                                    fill="white" />
                            </svg>
                        </span>
                    </span>
                    <span class="menu-title">Email templates</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion">
                    <div class="menu-item">
                        <a class="menu-link "
                            href="">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </span>
                            <span class="menu-title">Email templates</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link "
                            href="">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i><img src="{{ asset('images/icons/header.svg') }}" alt="" style="height: 15px;">
                                    </i>
                                </span>
                            </span>
                            <span class="menu-title">Email Header</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link "
                            href="">
                            <span class="menu-icon">
                                <span class="svg-icon svg-icon-2">
                                    <i><img src="{{ asset('images/icons/footer.svg') }}" alt=""
                                            style="height: 15px;"></i>
                                </span>
                            </span>
                            <span class="menu-title">Email Footer</span>
                        </a>
                    </div>
                </div>
            </div>
            @endcan
            {{-- Activity log --}}
            {{-- @can('activity_logs:view')
            <div class="menu-item">
                <a class="menu-link {{ is_active_menu(['admin.activity_logs']) }}"
                    href="{{ route('admin.activity_logs') }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fas fa-chart-line"></i>
                        </span>
                    </span>
                    <span class="menu-title">Activity Logs</span>
                </a>
            </div>
            @endcan --}}
        </div>
    </div>
</div>
