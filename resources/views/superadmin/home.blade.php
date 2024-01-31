@extends('superadmin.layouts.default')

@section('title', 'Schools')
@section('content')
<div class="main-content container">
    <!--begin::Card-->
    <div class=" card card-custom mt-6">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Schools Mangement</h3>
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
                                <a href="#" class="navi-link">
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
                <a href="{{route('tenants.create')}}" class="btn btn-primary font-weight-bolder">
                    <i class="icon-xl la la-plus"></i>
                    Add School
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

            <!-- <div class="overlay loading"></div>
            <div class="spinner-border text-primary loading" role="status">
                <span class="sr-only">Loading...</span>
            </div> -->

            <!--begin: Datatable-->
            <table class="table table-bordered table-hover" id="superadmin_tenant_datatable">
                <thead>
                    <tr>
                        <th title="Field #1">School ID</th>
                        <th title="Field #2">School Name</th>
                        <th title="Field #3">Subdomain Link</th>
                        <!-- <th title="Field #5">Billing Plan</th> -->
                        <!-- <th title="Field #6" id="datatable-cell-sort-1">Billing Start</th> -->
                        <th title="Field #8">School Status</th>
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
                        {{-- <td>{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (isset($single_tenant->customer->subscription('default')->items[0], $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product]) ? $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product] : '') : $single_tenant->plan_name }}
                        </td>
                        <td>{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (new \DateTime($single_tenant->customer->subscription('default')->created_at))->format('m/d/Y') : $single_tenant->plan_start_date }}
                        </td> --}}
                        <td>
                            <p id="reverification_sent_{{ $single_tenant->id }}"></p>
                            @if ($single_tenant->is_active)
                            <i class="fa fa-check" style="color:#1bc5bd;cursor:pointer;" ></i>
                            @else
                            <i class="fa fa-check" style="color:grey;cursor:pointer;" ></i>
                            @endif
                        </td>
                        <td>
                            <a href="{{url('admin/tenants-edit/'.$single_tenant->id)}}" class="btn btn-sm btn-clean btn-icon mr-2 changeTenantPlan" id="changeTenantPlan-{{ $single_tenant->id }}" title="Change Subscription Plan" data-tenant-name="{{ $single_tenant->tenant_name }}" data-plan="{{ $stripe_product }}" data-user-id="{{ $single_tenant->id }}" data-subdomain="{{ $single_tenant->tenant_name }}" data-registered-at="{{ \Carbon\Carbon::parse($single_tenant->created_at)->format('m/d/Y') }}" data-active="{{ $single_tenant->is_active }}" data-billing-plan-name="{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (isset($single_tenant->customer->subscription('default')->items[0], $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product]) ? $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product] : '') : $single_tenant->plan_name }}" data-billing-plan-start="{{ $single_tenant->customer && $single_tenant->customer->subscribed('default') ? (new \DateTime($single_tenant->customer->subscription('default')->created_at))->format('m/d/Y') : $single_tenant->plan_start_date }}" data-ip-verification="{{ $single_tenant->ip_verification_enable }}">
                                <i class="icon-xl la la-money-check"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 tenantDetails" id="tenantDetails-{{ $single_tenant->id }}" title="Tenant Details" data-user-id="{{ $single_tenant->id }}" data-subdomain="{{ $single_tenant->tenant_name }}" data-registered-at="{{ \Carbon\Carbon::parse($single_tenant->created_at)->format('m/d/Y') }}" data-active="{{ $single_tenant->is_active }}" data-billing-plan-name="{{ $single_tenant->customer 
                                && $single_tenant->customer->subscribed('default') 
                                ? (isset($single_tenant->customer->subscription('default')->items[0], 
                                $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product])
                                 ? $all_plans[$single_tenant->customer->subscription('default')->items[0]->stripe_product]
                                  : '') : $single_tenant->plan_name }}" data-billing-plan-start="{{ $single_tenant->customer 
                                    && $single_tenant->customer->subscribed('default')
                                     ? (new \DateTime($single_tenant->customer->subscription('default')->created_at))->format('m/d/Y') 
                                     : $single_tenant->plan_start_date }}" data-ip-verification="{{ $single_tenant->ip_verification_enable }}" data-tenant-name="{{ $single_tenant->tenant_name }}" data-billing-plan-price="{{ $single_tenant->plan_price }}" data-tenant-link="{{ $http }}{{ $single_tenant->tenant_name }}.{{ $domainName }}" 
                                     data-tenant-owner="{{ $single_tenant->owner && $single_tenant->owner->first_name 
                                        ? $single_tenant->owner->first_name.' '.$single_tenant->owner->last_name : '' }}" data-tenant-email="{{ $single_tenant->owner && $single_tenant->owner->email 
                                            ? $single_tenant->owner->email : '' }}">
                                <i class="icon-xl la la-eye"></i>
                            </a>

                            {{--@if (!$single_tenant->is_active)
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon" id="delete_tenant" data-url="{{ url('delete_tenant', ['tenant_id' => $single_tenant->id]) }}" title="Delete">
                                <i class="icon-xl la la-trash-o"></i>
                            </a>
                            @endif --}}


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
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModal"
aria-hidden="true">
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
                    <button type="button" class="btn btn-primary" id="confirmChangeStatus" data-tenant-id=""
                        data-status="">Confirm</a>
                    </div>
            </div>
        </div>
    </div>
    <!-- Change status modal. -->


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
                        <h6>Active</h6>
                        <p id="modal-active"></p>
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                    </div>
                    <!-- <div class="col-md-3 col-sm-6 p-0 m-0">
                        <h6>IP Verifications</h6>
                        <p id="modal-ip-verification"></p>
                    </div> -->
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                    </div>
                    <div class="col-md-3 col-sm-6 p-0 m-0">
                    </div>
                </div>
                <div class="row col-sm-12 justify-content-center text-left my-0 p-0 m-0 mt-4">
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

@stop
@section('scripts')

<script>
    $('#superadmin_tenant_datatable').DataTable({
        fixedColumns: true
    });
    $(document).on('click', '.changeStatus', function() {
                $('#updatePlanModal').modal('hide');
                var tenant_id = $(this).attr('data-tenant-id');
                var status = $(this).attr('data-status');
                $('#changeStatusModal').modal('show');
                $('#confirmChangeStatus').attr('data-tenant-id', tenant_id);
                $('#confirmChangeStatus').attr('data-status', status);
            });
            $(document).on('click', '#confirmChangeStatus', function() {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var tenant_id = $(this).attr('data-tenant-id');
                var status = $(this).attr('data-status');
                $('#changeStatusModal').modal('hide');
                // send ajax request
                $.ajax({
                    url: "{{ url('admin/tenant/edit-status') }}" + "/" + tenant_id,
                    type: 'POST',
                    data: {
                        '_token': CSRF_TOKEN,
                        'status': status
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.success) {
                            if (status == 0) {
                                $('i.changeStatus[data-tenant-id=' + tenant_id + ']').attr(
                                    'data-status', '1');
                                $('i.changeStatus[data-tenant-id=' + tenant_id + ']').css(
                                    'color', '#B5B5C3');
                            } else {
                                $('i.changeStatus[data-tenant-id=' + tenant_id + ']').attr(
                                    'data-status', '0');
                                $('i.changeStatus[data-tenant-id=' + tenant_id + ']').css(
                                    'color', '#1bc5bd');
                            }
                            setTimeout(function() {
                                location.reload()
                            }, 1000)
                        }
                    },
                    error: function() {

                    }
                });
            });
    $(document).on('click', '.tenantDetails', function() {
        var user_id = $(this).attr('data-user-id');
        var subdomain = $(this).attr('data-subdomain');
        var registered_at = $(this).attr('data-registered-at');
        var active_status = $(this).attr('data-active');
        var ip_verification = $(this).attr('data-ip-verification');

        $('input[name="change_plan"]').prop('checked', false);
        $('#tenantDetails').modal('show');
        $('#modal-registered-at').text(registered_at);
        $('#modal-tenant-name').text($(this).attr('data-tenant-name'));
        document.getElementById("modal-tenant-link").href = $(this).attr('data-tenant-link');
        $('#modal-tenant-link').text($(this).attr('data-tenant-link'));
        $('#modal-tenant-owner').text($(this).attr('data-tenant-owner'));
        $('#modal-tenant-email').text($(this).attr('data-tenant-email'));

        // add status html to modal
        if (active_status == 1) {
            $('#modal-active').html(
                '<i class="fa fa-check changeStatus" style="color:#1bc5bd;cursor:pointer;" data-tenant-id="' +
                user_id + '" data-status="0"></i>');
        } else {
            $('#modal-active').html(
                '<i class="fa fa-check changeStatus" style="cursor:pointer;" data-tenant-id="' +
                user_id + '" data-status="1"></i>');
        }
        // add ip verifications html
        var ip_html = '<div><label class="ip-verification-switch">';
        ip_html += '<input type="checkbox" onclick="toggleIPVerification(this, ' + user_id + ', ' +
            ip_verification + ')" ' + (ip_verification == 1 ? 'checked' : '') + '>';
        ip_html += '<span class="slider round"></span>';
        ip_html += '</label></div>';
        $('#modal-ip-verification').html(ip_html);
    });
</script>
@endsection