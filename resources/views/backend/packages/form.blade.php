<style type="text/css">
    .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white !important;
        background-color: #0d6efd;
        padding: 0.2rem;
    }

</style>
<div class="mb-8 row">
    <div class="col-md-7 col-sm-6 col-6">
        <div class="card-body">
            <div class="mb-6 row">
                <label class="col-lg-4 col-form-label fw-bold fs-6">Package picture</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <div class="card-body border-top p-9">
                        <!--begin::Image input-->
                        <div class="image-input @if( !isset($user->profile_url)) image-input-empty @else image-input-outline @endif" data-kt-image-input="true"
                            style="background-image:{{ asset('theme/dist/assets/media/avatars/default_user.png')}}">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-125px h-125px"
                                style="background-image: url({{ (@$package->image == NULL) ? asset('theme/dist/assets/media/avatars/default_user.png') :asset('uploads/packages').'/'.@$package->image}})">
                            </div>
                            <label class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="image_remove" />
                            </label>
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text">{{'Allowed file types: png, jpg, jpeg.'}}</div>
                        <!--end::Hint-->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-8 d-flex flex-column fv-row">
                                <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Package Name: </span>
                                </label>
                                <input name="name" type="text" class="form-control form-control-solid"
                                    placeholder="Enter package name" data-popup="tooltip"
                                    title="Can not change template name" data-placement="top" @isset($package->name)
                                value="{{
                                old('name', $package->name) }}" @endisset />
                            </div>
                            <div class="mb-8 d-flex flex-column fv-row">
                                <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Package category: </span>
                                </label>
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="Select an option" name="category">
                                    <option></option>
                                    @foreach ($package_categories as $category)
                                    <option value="{{ $category->id }}" {{ @$category->id == @$package->id ? 'selected' :
                                        '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-8 d-flex flex-column fv-row">
                                <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Package Type: </span>
                                </label>
                                <input name="type" type="text" class="form-control form-control-solid"
                                    placeholder="Enter package type" data-popup="tooltip"
                                    title="Can not change template name" data-placement="top" @isset($package->type)
                                value="{{
                                old('type', $package->type) }}" @endisset />
                            </div>
                            @php
                            if(isset($package->recommended_for)){
                            $recommended = json_decode($package->recommended_for);
                            $recommended = implode(', ', $recommended);
                            }else{
                            $recommended = " - ";
                            }
                            @endphp
                            <div class="mb-8 d-flex flex-column fv-row">
                                <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Recommended For: </span>
                                </label>
                                {{-- <textarea name="meta_title"
                                    id="meta_title">{{ old('meta_title', @$package->meta_title) }}</textarea> --}}
                                <input type="text" name="recommended_for" id="recommended_for"
                                    placeholder="Enter Recommentation" class="form-control form-control-solid"
                                    data-popup="tooltip" title="Can not change template slug" data-placement="top"
                                    @isset($package->recommended_for)
                                value="{{ old('recommended_for', $recommended) }}" @endisset />
                            </div>
                            <div class="d-flex flex-column fv-row">
                                <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">Overview: </span>
                                </label>
                                <textarea name="overview" placeholder="Enert Overview"
                                    class="form-control"> @isset($package->overview) {{ old('overview', $package->overview) }} @endisset</textarea>
                            </div>
                            @php
                            if(isset($package->cbc_test)){
                            $cbc = json_decode($package->cbc_test);
                            $cbc = implode(', ', $cbc);
                            }else{
                            $cbc = " - ";
                            }
                            @endphp
                            <div class="mt-3 mb-8 d-flex flex-column fv-row">
                                <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                                    <span class="required">CBC Package: </span>
                                </label>
                                <input type="text" name="cbc_test" id="cbc_test" class="form-control form-control-solid"
                                    placeholder="Enter CBC Package" data-popup="tooltip"
                                    title="Can not change template slug" data-placement="top" @isset($package->cbc_test)
                                value="{{ old('cbc_test', $cbc) }}"
                                @endisset
                                />
                            </div>
                            <!--begin::test-->
                            <!--begin::Repeater-->

                            <!--begin::Repeater-->
                            <div id="includes_pack">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <h3 class="container px-0 text-gray-400">Include Tests </h3>
                                    <hr>
                                    @if (@$package->includes_pack)
                                        @php
                                        $packs = json_decode($package->includes_pack);
                                        @endphp
                                        @foreach ($packs as $key => $pack)
                                            <div data-repeater-list="includes_pack">
                                                <div data-repeater-item>
                                                    <div class="mb-12 form-group row">
                                                        <div class="col-md-6">
                                                            <div class="col-md-6">
                                                                <label class="form-label">Test Heading:</label>
                                                                <input type="test" name="test_heading"
                                                                    class="mb-2 form-control mb-md-0" value="{{ @$pack->test_heading }}"
                                                                    placeholder="Enter Test Heading" />
                                                            </div>
                                                        </div>
                                                        <div class="mt-3 col-md-8">
                                                            @php
                                                                $test_names = json_decode($pack->test_names);
                                                                $test_names = array_column($test_names, 'value');
                                                                $test_names = implode(', ', $test_names);
                                                            @endphp
                                                            <label class="form-label">Add Tests</label>
                                                            <input class="form-control" value="{{ @$test_names }}" name="test_names"
                                                                placeholder="Type and enter for the tags"
                                                                data-kt-repeater="tagify" />
                                                        </div>
                                                        <div class="col-md-2">
                                                            <a href="javascript:;" data-repeater-delete
                                                                class="mt-3 btn btn-flex btn-sm btn-light-danger mt-md-9">
                                                                <i class="ki-duotone ki-trash fs-3"><span
                                                                        class="path1"></span><span class="path2"></span><span
                                                                        class="path3"></span><span class="path4"></span><span
                                                                        class="path5"></span></i>
                                                                Delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach


                                    @else

                                        <div data-repeater-list="includes_pack">
                                            <div data-repeater-item>
                                                <div class="mb-12 form-group row">
                                                    <div class="col-md-6">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Test Heading:</label>
                                                            <input type="test" name="test_heading"
                                                                class="mb-2 form-control mb-md-0"
                                                                placeholder="Enter Test Heading" />
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 col-md-8">
                                                        <label class="form-label">Add Tests</label>
                                                        <input class="form-control" value="" name="test_names"
                                                            placeholder="Type and enter for the tags"
                                                            data-kt-repeater="tagify" />
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="mt-3 btn btn-flex btn-sm btn-light-danger mt-md-9">
                                                            <i class="ki-duotone ki-trash fs-3"><span
                                                                    class="path1"></span><span class="path2"></span><span
                                                                    class="path3"></span><span class="path4"></span><span
                                                                    class="path5"></span></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->
                                <div class="form-group">
                                    <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary">
                                        <i class="ki-duotone ki-plus fs-3"></i>
                                        Add more test
                                    </a>
                                </div>
                                <!--end::Form group-->
                            </div>
                            <!--end::Repeater-->
                        </div>
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-danger me-3" data-kt-users-modal-action="cancel"
                                onclick="action_drawer()">Discard</button>
                            <button type="submit" class="btn btn-primary submit-btn"
                                data-kt-users-modal-action="submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>
    $(function () {
            $('input')
                .on('change', function (event) {
                var $element = $(event.target);
                var $container = $element.closest('.example');
                if (!$element.data('tagsinput')) return;
                var val = $element.val();
                if (val === null) val = 'null';
                var items = $element.tagsinput('items');
                $('code', $('pre.val', $container)).html(
                    $.isArray(val)
                    ? JSON.stringify(val)
                    : '"' + val.replace('"', '\\"') + '"'
                );
                $('code', $('pre.items', $container)).html(
                    JSON.stringify($element.tagsinput('items'))
                );
                })
                .trigger('change');
            });

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
            const firstErrorField = document.querySelector('.error');
            if (firstErrorField) {
                firstErrorField.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });

</script>
<script type="text/javascript">
    var home_page_route = "{{ route('admin.pages.home_page') }}";
        var submit_action = "{{ route('admin.pages.store_cms') }}"
</script>

<script src="{{ asset('theme/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"
    integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
// <script src="https://cdn.jsdelivr.net/npm/jquery.repeater@1.2.1/jquery.repeater.min.js"></script>
<script type="text/javascript" src="{{ asset('backend/js/pages/repeter_includes.js') }}"></script>

@endsection

<script>
    new Tagify(document.querySelector("#cbc_test"));
    new Tagify(document.querySelector("#recommended_for"));
    $('#includes_pack').repeater({
    initEmpty: false,

    defaultValues: {
        'text-input': 'foo'
    },

    show: function () {
        $(this).slideDown();

        // Re-init select2
        $(this).find('[data-kt-repeater="select2"]').select2();

        // Re-init flatpickr
        $(this).find('[data-kt-repeater="datepicker"]').flatpickr();

        // Re-init tagify
        new Tagify(this.querySelector('[data-kt-repeater="tagify"]'));
    },

    hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
    },

    ready: function(){
        // Init select2
        $('[data-kt-repeater="select2"]').select2();

        // Init flatpickr
        $('[data-kt-repeater="datepicker"]').flatpickr();

        // Init Tagify
        new Tagify(document.querySelector('[data-kt-repeater="tagify"]'));
    }
});
</script>
