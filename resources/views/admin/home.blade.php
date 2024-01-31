@extends('admin.layouts.layout')

@section('app-section')

<div class="d-flex flex-column-fluid">
								<!--begin::Container-->
								<div class="container">
									<!--begin::Dashboard-->
								
									<!--begin::Row-->
									<div class="row mt-3">
										<div class="col-xl-6">
											<!--begin::List Widget 10-->
											<div class="card card-custom card-stretch gutter-b">
												<!--begin::Header-->
												<div class="card-header border-0">
													<h3 class="card-title font-weight-bolder text-dark">Notifications</h3>
												</div>
												
											</div>
											<!--end: Card-->
											<!--end: List Widget 10-->
										</div>
										<div class="col-xl-6">
											<!--begin::Base Table Widget 1-->
											<div class="card card-custom card-stretch gutter-b">
												<!--begin::Header-->
												<div class="card-header border-0 pt-5">
													<h3 class="card-title align-items-start flex-column">
														<span class="card-label font-weight-bolder text-dark">Trending Items</span>
														<span class="text-muted mt-3 font-weight-bold font-size-sm">More than 400+ new members</span>
													</h3>
													
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="card-body pt-2 pb-0 mt-n3">
													<div class="tab-content mt-5" id="myTabTables1">
														
														<!--begin::Tap pane-->
														<div class="tab-pane fade" id="kt_tab_pane_1_2" role="tabpanel" aria-labelledby="kt_tab_pane_1_2">
															
															<!--end::Table-->
														</div>
														<!--end::Tap pane-->
														
														<!--end::Tap pane-->
													</div>
												</div>
											</div>
											<!--end::Base Table Widget 1-->
										</div>
									</div>
									<!--end::Row-->
									<!--end::Dashboard-->
								</div>
								<!--end::Container-->
							</div>



@endsection
