@extends('superadmin.layouts.default')

@section('title', 'Tenants')
@section('content')
<div class="main-content container">
    <!--begin::Card-->
    <div class=" card card-custom mt-6">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Tenant Mangement</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <i class="icon-xl la la-print"></i>
                            <!--end::Svg Icon-->
                        </span>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">
                                Choose an option:</li>
                            <li class="navi-item">
                                <a href="{{ route('tenants_export_csv') }}" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-text-o"></i>
                                    </span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="{{ route('add_tenant') }}" class="btn btn-primary font-weight-bolder">
                    <i class="icon-xl la la-plus"></i>
                    Add Tenant
                </a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            @if (session()->has('success'))
            <div class="alert alert-success" role="alert"> {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger" role="alert"> {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="overlay loading"></div>
            <div class="spinner-border text-primary loading" role="status">
                <span class="sr-only">Loading...</span>
            </div>

            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-responsive" id="superadmin_tenant_datatable">
                <thead>
                    <tr>
                        <th title="Field #1">Tenant ID</th>
                        <th title="Field #2">Tenant Name</th>
                        <th title="Field #3">Subdomain Link</th>
                        <th title="Field #4">Owner</th>
                        <th title="Field #5">Email</th>
                        <!-- <th title="Field #5">Billing Plan</th> -->
                        <!-- <th title="Field #6" id="datatable-cell-sort-1">Billing Start</th> -->
                        <th title="Field #8">Tenant Status</th>
                        <!-- <th title="Field #7">Active</th> -->
                        <!-- <th title="Field #9">Registered At</th> -->
                        <!-- <th title="Field #10">IP Verifications</th> -->
                        <th title="Field #10">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_tenants as $single_tenant)
                    <?php
                    $stripe_product = $single_tenant->customer && $single_tenant->customer->subscribed('default') && isset($single_tenant->customer->subscription('default')->items[0]) ? $single_tenant->customer->subscription('default')->items[0]->stripe_price : '';
                    $subscription_customer_id = $single_tenant->customer && $single_tenant->customer->subscribed('default') ? $single_tenant->customer->id : '';
                    ?>
                    <tr>
                        <td>{{ $single_tenant->id }}</td>
                        <td><a href="javascript:void(0)" data-id="{{ $single_tenant->id }}" class="edit-tenant-name" data-toggle="modal" data-target="#editTenantName" title="Edit Tenant Name">{{ $single_tenant->tenant_name }}</a>
                        </td>
                        <td><a href="{{ $http }}{{ $single_tenant->tenant_name }}.{{ $domainName }}">{{ $http }}{{ $single_tenant->tenant_name }}.{{ $domainName }}</a>
                        </td>
                        <td>{{ $single_tenant->owner && $single_tenant->owner->full_name ? $single_tenant->owner->full_name : '' }}
                        </td>
                        <td>{{ $single_tenant->owner && $single_tenant->owner->email ? $single_tenant->owner->email : '' }}
                        </td>
                        {{-- <td>{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (isset($single_tenant->customer->subscription('default')->items[0], $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product]) ? $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product] : '') : $single_tenant->plan_name }}
                        </td>
                        <td>{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (new \DateTime($single_tenant->customer->subscription('default')->created_at))->format('m/d/Y') : $single_tenant->plan_start_date }}
                        </td> --}}
                        <td>
                            <p id="reverification_sent_{{ $single_tenant->id }}"></p>
                            @if ($single_tenant->status == 'Unverified')
                            {{ $single_tenant->status }}
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm reverify_tenant" data-tenant='{{ $single_tenant->id }}'>
                                Reverify
                            </a>
                            @else
                            {{ $single_tenant->status }}
                            @endif
                        </td>
                        {{-- <td>
                                    @if ($single_tenant->is_active)
                                        <i class="fa fa-check changeStatus" style="color:#1bc5bd;cursor:pointer;"
                                            data-tenant-id="{{ $single_tenant->id }}" data-status="0"></i>
                        @else
                        <i class="fa fa-check changeStatus" style="cursor:pointer;" data-tenant-id="{{ $single_tenant->id }}" data-status="1"></i>
                        @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($single_tenant->created_at)->format('m/d/Y') }}</td>
                        <td>
                            <!-- <div><label class="ip-verification-switch">
                                        <input type="checkbox"
                                            onclick="toggleIPVerification(this, {{ $single_tenant->id }}, {{ $single_tenant->ip_verification_enable }})"
                                            {{ $single_tenant->ip_verification_enable == 1 ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label></div> -->
                        </td> --}}
                        <td>
                            @if (empty($stripe_product) || (!empty($stripe_product) && $stripe_product == $max_price_plan))
                            <a href="javascript:;" data-toggle="modal" data-target="#noPlanModal" class="btn btn-sm btn-clean btn-icon mr-2" style=" cursor: default;" title="Upgrade Subscription Plan">
                                <i class="icon-xl la la-money-check"></i>
                            </a>
                            @else
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 changeTenantPlan" id="changeTenantPlan-{{ $single_tenant->id }}" title="Change Subscription Plan" data-tenant-name="{{ $single_tenant->tenant_name }}" data-plan="{{ $stripe_product }}" data-user-id="{{ $single_tenant->id }}" data-subdomain="{{ $single_tenant->tenant_name }}" data-registered-at="{{ \Carbon\Carbon::parse($single_tenant->created_at)->format('m/d/Y') }}" data-active="{{ $single_tenant->is_active }}" data-billing-plan-name="{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (isset($single_tenant->customer->subscription('default')->items[0], $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product]) ? $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product] : '') : $single_tenant->plan_name }}" data-billing-plan-start="{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (new \DateTime($single_tenant->customer->subscription('default')->created_at))->format('m/d/Y') : $single_tenant->plan_start_date }}" data-ip-verification="{{ $single_tenant->ip_verification_enable }}">
                                <i class="icon-xl la la-money-check"></i>
                            </a>
                            @endif

                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 tenantDetails" id="tenantDetails-{{ $single_tenant->id }}" title="Tenant Details" data-user-id="{{ $single_tenant->id }}" data-subdomain="{{ $single_tenant->tenant_name }}" data-registered-at="{{ \Carbon\Carbon::parse($single_tenant->created_at)->format('m/d/Y') }}" data-active="{{ $single_tenant->is_active }}" data-billing-plan-name="{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (isset($single_tenant->customer->subscription('default')->items[0], $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product]) ? $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product] : '') : $single_tenant->plan_name }}" data-billing-plan-start="{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (new \DateTime($single_tenant->customer->subscription('default')->created_at))->format('m/d/Y') : $single_tenant->plan_start_date }}" data-ip-verification="{{ $single_tenant->ip_verification_enable }}" data-tenant-name="{{ $single_tenant->tenant_name }}" data-billing-plan-price="{{ $single_tenant->plan_price }}" data-tenant-link="{{ $http }}{{ $single_tenant->tenant_name }}.{{ $domainName }}" data-tenant-owner="{{ $single_tenant->owner && $single_tenant->owner->full_name ? $single_tenant->owner->full_name : '' }}" data-tenant-email="{{ $single_tenant->owner && $single_tenant->owner->email ? $single_tenant->owner->email : '' }}">
                                <i class="icon-xl la la-eye"></i>
                            </a>

                            @if (!$single_tenant->is_active)
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" id="delete_tenant" data-url="{{ route('delete_tenant', ['tenant_id' => $single_tenant->id]) }}" title="Delete">
                                <i class="icon-xl la la-trash-o"></i>
                            </a>
                            @endif

                            <!-- <a href="{{ route('edit_tenant', ['tenant_id' => $single_tenant->id]) }}" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
                                                                                                                    <i class="icon-xl la la-pen"></i>
                                                                                                                </a>
                                                                                                                <a class="btn btn-sm btn-clean btn-icon" id="view_tenant" href="{{ route('view_tenant', ['tenant_id' => $single_tenant->id]) }}" title="View">
                                                                                                                    <i class="icon-xl la la-eye"></i>
                                                                                                                </a> -->
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->
</div>

<!-- Change status modal. -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Are you sure to change the Active Status of the selected Tenant?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmChangeStatus" data-tenant-id="" data-status="">Confirm</a>
            </div>
        </div>
    </div>
</div>

<!-- No subscription plan modal. -->
<div class="modal fade" id="noPlanModal" tabindex="-1" role="dialog" aria-labelledby="noPlanModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p>There is not any Subscription Plan to upgrade!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTenantName" tabindex="-1" role="dialog" aria-labelledby="editTenantNameLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('update_tenant_name') }}" name="tenant_name_update_form" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMappingRuleLabel">Update Tenant Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_tenant_id">
                    <div class="form-group">
                        <label> Tenant Name</label>
                        <input type="text" class="form-control form-control-solid" name="edit_tenant_name" required />
                    </div>
                    <div class="alert alert-warning" role="alert"> If you change tenant name, all Filevine
                        subscription will be changed automatically to new tenant name! </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-light-success font-weight-bold">Submit</button>
                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="tenantDetails" tabindex="-1" role="dialog" aria-labelledby="tenantDetails" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="min-width:1000px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tenant Details of <span class="font-weight-bold" id="modal-tenant-name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row col-sm-12 justify-content-center text-left my-0 p-0 m-0">
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>Owner</h6>
                        <p id="modal-tenant-owner"></p>
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>Email</h6>
                        <p id="modal-tenant-email"></p>
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>Registered At</h6>
                        <p id="modal-registered-at"></p>
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>Link</h6>
                        <p><a href="" target="_blank" id="modal-tenant-link"></a></p>
                    </div>
                </div>
                <div class="row col-sm-12 justify-content-center text-left my-0 p-0 m-0 mt-4">
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>Billing Plan</h6>
                        <p id="modal-plan-name"></p>
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>Billing Start</h6>
                        <p id="modal-plan-start"></p>
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>Active</h6>
                        <p id="modal-active"></p>
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>IP Verifications</h6>
                        <p id="modal-ip-verification"></p>
                    </div>
                </div>
                <div class="row col-sm-12 justify-content-center text-left my-0 p-0 m-0 mt-4">
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>Billing Amount</h6>
                        <p id="modal-plan-price"></p>
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection