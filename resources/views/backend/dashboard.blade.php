@extends('layouts.back_layout')
@section('page_title', 'Dashboard')
@section('css')

@section('content')
<div class="toolbar" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="flex-wrap mb-0 page-title d-flex align-items-center me-3 mb-xl-5 mb-lg-0">
            <!--begin::Title-->
            <h1 class="my-1 d-flex align-items-center text-dark fw-bolder fs-3">Dashboard</h1>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
@endsection

@section('script')
<script type="text/javascript">
    KTMenu.createInstances();
</script>
@endsection