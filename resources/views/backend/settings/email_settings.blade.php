<form action="{{ route('admin.settings.update') }}" method="POST" novalidate="novalidate"
    class="email_settings_form form" id="email_settings_form" enctype="multipart/form-data" data-view="email_settings">
    @csrf
    <input type="hidden" name="view_name" id="email_settings" value="email_settings" />
    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <!--begin::Input group-->
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">SMTP Host</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" name="smtp_host"
                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="SMTP Host"
                    value="{{ config('mail.mailers.smtp.host') }}" />
            </div>
            <!--end::Col-->
        </div>

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">SMTP Port</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" name="smtp_port" class="form-control form-control-lg form-control-solid"
                    placeholder="SMTP Port" value="{{ config('mail.mailers.smtp.port') }}" />
            </div>
            <!--end::Col-->
        </div>

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">SMTP Encryption</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <select name="smtp_encryption" data-control="select2" data-dropdown-parent="#email_settings_form"
                    data-placeholder="Select SMTP Encryption..."
                    class="form-select form-select-solid select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                    <option value="0" selected disabled>Select SMTP Encryption...</option>
                    <option value="ssl" {{ config('mail.mailers.smtp.encryption') == 'ssl' ? ' selected' : '' }}>SSL
                    </option>
                    <option value="tls" {{ config('mail.mailers.smtp.encryption') == 'tls' ? ' selected' : '' }}>TLS
                    </option>
                </select>
                <div id="smtp_encryption-error" class="validation-error-label invalid-feedback"></div>
            </div>
            <!--end::Col-->
        </div>

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">SMTP User</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" name="smtp_user" class="form-control form-control-lg form-control-solid"
                    placeholder="SMTP User" value="{{ config('mail.mailers.smtp.username') }}" />
            </div>
            <!--end::Col-->
        </div>

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">SMTP Password</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="password" name="smtp_password" class="form-control form-control-lg form-control-solid"
                    placeholder="SMTP Password" value="{{ config('mail.mailers.smtp.password') }}" />
            </div>
            <!--end::Col-->
        </div>

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">From Name</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" name="from_name" class="form-control form-control-lg form-control-solid"
                    placeholder="From Name" value="{{ config('mail.form.address') }}" />
            </div>
            <!--end::Col-->
        </div>

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Reply to Email</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" name="reply_to_email" class="form-control form-control-lg form-control-solid"
                    placeholder="Reply to Email" value="{{ config('customConfig.email.reply_to') }}" />
            </div>
            <!--end::Col-->
        </div>

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Email Signature</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" name="email_signature" class="form-control form-control-lg form-control-solid"
                    placeholder="Email Signature" value="{{ config('customConfig.email.signature') }} " />
            </div>
            <!--end::Col-->
        </div>

        {{-- <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Email Header</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <textarea class="form-control form-control-solid" rows="3" name="email_header" placeholder="Email Heder">{{ config('customConfig.email.header') }} </textarea>
            </div>
            <!--end::Col-->
        </div>

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Email Footer</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <textarea class="form-control form-control-solid" rows="3" name="email_footer" placeholder="Email Footer">{{ config('customConfig.email.footer') }} </textarea>
            </div>
            <!--end::Col-->
        </div> --}}

        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end p-0 pt-6">
            <button type="submit" class="btn btn-primary submit-btn" id="kt_account_email_settings_submit">
                <x-button-indicator :label="__('Save Changes')"></x-button-indicator>
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Card body-->
</form>

<form action="{{ route('admin.settings.test_mail') }}" method="POST" novalidate="novalidate"
    class="test_email_form form" id="test_email_form" enctype="multipart/form-data" data-view="test_email">
    @csrf
    <!--begin::Card body-->
    <div class="card-body border-top p-9">
        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label required fw-bold fs-6">Test Email:</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <input type="text" name="email" class="form-control form-control-lg form-control-solid"
                    placeholder="Enter email" />
            </div>
            <!--end::Col-->
        </div>
        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end p-0 pt-6">
            <button type="submit" class="btn btn-primary submit-btn" id="kt_test_email_settings_submit">
                <x-button-indicator :label="__('Send Test Mail')"></x-button-indicator>
            </button>
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Card body-->
</form>
