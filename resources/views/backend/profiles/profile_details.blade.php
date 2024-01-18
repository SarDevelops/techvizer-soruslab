<div class="card-body pt-9 pb-0">
    <!--begin::Details-->
    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
        <!--begin: Pic-->
        <div class="me-7 mb-4">
            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                <img src="{{ asset('uploads/user_profile') . '/' . $admin->profile }}" alt="Admin Profile"
                    onerror="this.onerror=null;this.src='{{ asset('theme/dist/assets/media/avatars/default_user.png') }}';" />
            </div>
        </div>
        <!--end::Pic-->
        <!--begin::Info-->
        <div class="flex-grow-1">
            <!--begin::Title-->
            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                <!--begin::User-->
                <div class="d-flex flex-column">
                    <!--begin::Name-->
                    <div class="d-flex align-items-center mb-2">
                        <p class="text-gray-900 fs-2 fw-bolder me-1">
                            {{ @$admin->first_name . ' ' . @$admin->last_name }}
                        </p>
                    </div>
                    <!--end::Name-->
                    <!--begin::Info-->
                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                        <p class="d-flex align-items-center text-gray-400 me-5 mb-2">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                            <span class="svg-icon svg-icon-4 me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                        fill="black" />
                                    <path
                                        d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->{{ @$admin->role_detail->role_name }}
                        </p>
                        <a href="mailTo:{{ @$admin->email }}" title="Email"
                            class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                            <span class="svg-icon svg-icon-4 me-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path opacity="0.3"
                                        d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                        fill="black" />
                                    <path
                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                        fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->{{ @$admin->email }}
                        </a>

                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->
                <!--begin::Actions-->

                <!--end::Actions-->
            </div>
            <!--end::Title-->
            <!--begin::Stats-->

            <!--end::Stats-->
        </div>
        <!--end::Info-->
    </div>
    <!--end::Details-->
</div>
