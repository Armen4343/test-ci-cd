@extends('layouts.super-admin.master')

@section('super-admin')

<div class="row g-5 g-xl-10 mb-xl-10">

									<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
										<!--begin::Card widget 6-->
										<div class="card card-flush mb-5 mb-xl-10">
											<!--begin::Header-->
											<div class="card-header pt-5">
												<!--begin::Title-->
												<div class="card-title d-flex flex-column">
													<!--begin::Info-->
													<div class="d-flex align-items-center">
														<!--begin::Currency-->
														<span class="fs-4 fw-bold text-gray-400 me-1 align-self-start"><i class="fa fa-user-tie fa-2x"></i></span>
														<!--end::Currency-->
														<!--begin::Amount-->
														<span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ \App\Models\User::where(['role' => 'superadmin'])->count(); }}</span>
														<!--end::Amount-->
														<!--begin::Badge-->
														<span class="badge badge-success fs-base">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														<span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"></rect>
																<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black"></path>
															</svg>
														</span>
														<!--end::Svg Icon-->2.6%</span>
														<!--end::Badge-->
													</div>
													<!--end::Info-->
													<!--begin::Subtitle-->
													<span class="text-gray-400 pt-1 fw-bold fs-6">Total Super Users</span>
													<!--end::Subtitle-->
												</div>
												<!--end::Title-->
											</div>
											<!--end::Header-->
										</div>
										<!--end::Card widget 6-->
									</div>
									<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
										<!--begin::Card widget 6-->
										<div class="card card-flush mb-5 mb-xl-10">
											<!--begin::Header-->
											<div class="card-header pt-5">
												<!--begin::Title-->
												<div class="card-title d-flex flex-column">
													<!--begin::Info-->
													<div class="d-flex align-items-center">
														<!--begin::Currency-->
														<span class="fs-4 fw-bold text-gray-400 me-1 align-self-start"><i class="fa fa-users fa-2x"></i></span>
														<!--end::Currency-->
														<!--begin::Amount-->
														<span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ \App\Models\User::where(['role' => 'vendor'])->count(); }}</span>
														<!--end::Amount-->
														<!--begin::Badge-->
														<span class="badge badge-success fs-base">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														<span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"></rect>
																<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black"></path>
															</svg>
														</span>
														<!--end::Svg Icon-->3.6%</span>
														<!--end::Badge-->
													</div>
													<!--end::Info-->
													<!--begin::Subtitle-->
													<span class="text-gray-400 pt-1 fw-bold fs-6">Total Vendors</span>
													<!--end::Subtitle-->
												</div>
												<!--end::Title-->
											</div>
											<!--end::Header-->
										</div>
										<!--end::Card widget 6-->
									</div>

									<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
										<!--begin::Card widget 6-->
										<div class="card card-flush mb-5 mb-xl-10">
											<!--begin::Header-->
											<div class="card-header pt-5">
												<!--begin::Title-->
												<div class="card-title d-flex flex-column">
													<!--begin::Info-->
													<div class="d-flex align-items-center">
														<!--begin::Currency-->
														<span class="fs-4 fw-bold text-gray-400 me-1 align-self-start"><i class="fa fa-users-line fa-2x"></i></span>
														<!--end::Currency-->
														<!--begin::Amount-->
														<span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ \App\Models\User::where(['role' => 'customer'])->count(); }}</span>
														<!--end::Amount-->
														<!--begin::Badge-->
														<span class="badge badge-warning fs-base">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														<span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
															<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"></rect>
																<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black"></path>
															</svg>
														</span>
														<!--end::Svg Icon-->0.0%</span>
														<!--end::Badge-->
													</div>
													<!--end::Info-->
													<!--begin::Subtitle-->
													<span class="text-gray-400 pt-1 fw-bold fs-6">Total Customers</span>
													<!--end::Subtitle-->
												</div>
												<!--end::Title-->
											</div>
											<!--end::Header-->
										</div>
										<!--end::Card widget 6-->
									</div>
								</div>

@endsection
