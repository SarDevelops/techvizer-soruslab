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
                    <div class="mb-8 d-flex flex-column fv-row">
                        <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                            <span class="required">Test Name: </span>
                        </label>
                        <input name="name" type="text" class="form-control form-control-solid" data-popup="tooltip" placeholder="Type Test Name"
                            title="Can not change template name" data-placement="top" @isset($test->name) value="{{
                        old('name', $test->name) }}" @endisset />
                    </div>
                    <div class="mb-8 d-flex flex-column fv-row">
                        <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                            <span class="required">Test Type: </span>
                        </label>
                        <input name="type" type="text" class="form-control form-control-solid" data-popup="tooltip" placeholder="Enter Test type"
                            title="Can not change template name" data-placement="top" @isset($test->type) value="{{
                        old('type', $test->type) }}" @endisset />
                    </div>
                    @php
                        if(isset($test->recommended_for)){
                            $recommended = json_decode($test->recommended_for);
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
                            id="meta_title">{{ old('meta_title', @$test->meta_title) }}</textarea> --}}
                        <input type="text" name="recommended_for" id="recommended_for"
                            class="form-control form-control-solid" data-popup="tooltip" placeholder="Type and Enter the Recommendation"
                            title="Can not change template slug" data-placement="top" @isset($test->recommended_for)
                        value="{{ old('recommended_for', $recommended) }}" @endisset />
                    </div>
                    <div class="d-flex flex-column fv-row">
                        <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                            <span class="required">Overview: </span>
                        </label>
                        <textarea name="overview" placeholder="Type Overviews and description"
                            class="form-control"> @isset($test->overview) {{ old('overview', $test->overview) }} @endisset</textarea>
                    </div>
                    @php
                    if(isset($test->cbc_test)){
                        $cbc = json_decode($test->cbc_test);
                        $cbc = implode(', ', $cbc);
                    }else{
                        $cbc = " - ";
                    }
                    @endphp
                    <div class="mb-8 d-flex flex-column fv-row">
                        <label class="mb-2 d-flex align-items-center fs-6 fw-bold">
                            <span class="required">CBC Test: </span>
                        </label>
                        <input type="text" name="cbc_test" id="cbc_test" class="form-control form-control-solid" placeholder="Type and Enter the CBC Tests" data-popup="tooltip" title="Can not change template slug" data-placement="top"
                             @isset($test->cbc_test) value="{{ old('cbc_test', $cbc) }}" @endisset
                        />
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
     new Tagify(document.querySelector("#cbc_test"));
    new Tagify(document.querySelector("#recommended_for"));
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
