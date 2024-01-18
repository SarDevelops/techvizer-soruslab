@extends('layouts.back_layout')
@section('page_title', 'Package  List')
@section('page_heading', 'Package  List')
@section('Breadcrumb')
	<ul class="pt-1 my-0 breadcrumb breadcrumb-separatorless fw-semibold fs-7">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">
			<a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bg-gray-400 bullet w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">Package  List</li>
		<!--end::Item-->
	</ul>
@endsection

@section('css')
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"> --}}
<link href="{{ asset('theme/dist/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<!--begin::Toolbar-->
<div class="toolbar" id="kt_toolbar">
	<!--begin::Container-->
	<div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
		<!--begin::Page title-->

		<!--end::Page title-->
	</div>
	<!--end::Container-->
</div>
<!--end::Toolbar-->
<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
	<!--begin::Container-->
	<div id="kt_content_container" class="container-xxl">
		<!--begin::Card-->
		<div class="card">
			<!--begin::Card header-->
			<div class="pt-6 border-0 card-header">
			<div class="pt-6 border-0 card-header">
				<!--begin::Card title-->
				<div class="card-title">
					<!--begin::Search-->
					<div class="my-1 d-flex align-items-center position-relative">
						<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
						<span class="svg-icon svg-icon-1 position-absoluteseo ms-6">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
								<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->
						<input type="text" data-kt-packages-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Search Test" />
					</div>
					<!--end::Search-->
				</div>
				<!--begin::Card title-->
				<!--begin::Card toolbar-->
				<div class="card-toolbar">
					<!--begin::Toolbar-->
					<div class="d-flex justify-content-end table-action-buttons" data-kt-user-table-toolbar="base">
						<!--begin::Filter-->
						{{-- <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" title="Filter"> --}}
						<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
						{{-- <span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
							</svg>
						</span> --}}


						<button type="button" class="btn btn-success me-3" id="reload-table" title="Reload">
							<span class="svg-icon svg-icon-2">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
									<path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="black"></path>
									<path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="black"></path>
								</svg>
							</span>
							Reload
						</button>

						{{-- @can ('packages:create') --}}
						<button type="button" class="btn btn-primary open-package-form me-3" target-url="{{ route('admin.packages.create') }}" target-header="Add Package " title="Add Package ">
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
						<span class="svg-icon svg-icon-2">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black" />
								<rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon-->Add Package </button>
						{{-- @endcan --}}
						<!--end::Add user-->
					</div>
					<!--end::Toolbar-->
					<!--begin::Group actions-->
					<div class="d-flex justify-content-end align-items-center d-none delete-all-button-div" data-kt-packages-table-toolbar="selected">
						<div class="fw-bolder me-5">
						<span class="me-2" data-kt-packages-table-select="selected_count"></span>Selected</div>
						<button type="button" class="btn btn-danger" data-kt-packages-table-select="delete_selected" target-url="{{ route('admin.packages.destroy',0) }}">Delete Selected</button>
					</div>
					<!--end::Group actions-->
					<!--begin::Modal - Adjust Balance-->
					<div class="modal fade" id="kt_modal_export_packages" tabindex="-1" aria-hidden="true">
						<!--begin::Modal dialog-->
						<div class="modal-dialog modal-dialog-centered mw-650px">
							<!--begin::Modal content-->
							<div class="modal-content">
								<!--begin::Modal header-->
								<div class="modal-header">
									<!--begin::Modal title-->
									<h2 class="fw-bolder">Export Package </h2>
									<!--end::Modal title-->
									<!--begin::Close-->
									<div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-users-modal-action="close">
										<!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
										<span class="svg-icon svg-icon-1">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
												<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
												<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
											</svg>
										</span>
										<!--end::Svg Icon-->
									</div>
									<!--end::Close-->
								</div>

							</div>
							<!--end::Modal content-->
						</div>
						<!--end::Modal dialog-->
					</div>
					<!--end::Modal - New Card-->
				</div>
				<!--end::Card toolbar-->
			</div>
			<!--end::Card header-->
			<!--begin::Card body-->
			<div class="pt-0 card-body">
				<!--begin::Table-->
				<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_packages">
					<!--begin::Table head-->
					<thead>
						<!--begin::Table row-->
						<tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
							<th class="w-10px pe-2"  @if (Gate::allows('packages:delete')) style="display:none"; @endif>
								<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
									<input class="form-check-input" type="checkbox" id="selectAll" data-kt-check="true" data-kt-check-target="#kt_table_packages td:first-child input[type='checkbox']" value="1" />
								</div>
							</th>
							<th class="">Image</th>
							<th class="">Name</th>
                            <th class="">Type</th>
                            <th class="">Categoty</th>
							<th class="">Recommended For</th>
                            <th class="">CBC Test</th>
                            {{-- <th class="">Includes Pack</th> --}}
							<th class="">Created At</th>
							<th class="text-end">Actions</th>
						</tr>
						<!--end::Table row-->
					</thead>
					<!--end::Table head-->
					<!--begin::Table body-->
					<tbody class="text-gray-600 fw-bold">
					</tbody>
					<!--end::Table body-->
				</table>
				<!--end::Table-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::Card-->
	</div>
	<!--end::Container-->
</div>
<!--end::Post-->
@endsection

@section('script')
<script type="text/javascript">
	var packages_listing_route = "{{ route('admin.packages.index') }}";
</script>

<script src="{{ asset('theme/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
{{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> --}}
<script src="{{ asset('backend/js/packages/package.js') }}"></script>
@endsection
