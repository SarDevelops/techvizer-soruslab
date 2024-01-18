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
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Image input-->
                    {{-- @php
                    $image_url = $admin->profile ?
                    asset('uploads/user_profile'.'/'.$admin->profile) :'';

                    @endphp --}}

                    <div class="image-input image-input-outline" data-kt-image-input="true"
                        style="background-image: url( {{ (@$health->image == NULL) ? asset('theme/dist/assets/media/avatars/default_user.png') : asset('uploads/health_concern').'/'. @$health->image }})">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-125px h-125px"
                            style="background-image: url({{ (@$health->image == NULL) ? asset('theme/dist/assets/media/avatars/default_user.png') : asset('uploads/health_concern').'/'. @$health->image }})">
                        </div>
                        <label
                            class="shadow btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                            title="Change profile">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="image_remove" />
                        </label>
                    </div>
                    <div class="mb-8 d-flex flex-column fv-row">
                        <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                            <span class="required">Health Name: </span>
                        </label>
                        <input name="name" type="text" class="form-control form-control-solid" data-popup="tooltip" placeholder="Type Health Name"
                            title="Can not change template name" data-placement="top" @isset($health->name) value="{{
                        old('name', $health->name) }}" @endisset />
                    </div>

                </div>

            </div>
            <!--begin::Actions-->
            <div class="text-center pt-15">
                <button type="reset" class="btn btn-danger me-3" data-kt-users-modal-action="cancel"
                    onclick="action_drawer()">Discard</button>
                <button type="submit" class="btn btn-primary submit-btn" data-kt-users-modal-action="submit">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...
                        <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </div>
    </div>

</div>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script> --}}
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
