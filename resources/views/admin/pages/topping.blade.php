@extends('admin.layouts.default')

@section('title', 'ServusCafe Admin - Topping')

@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2 ">
                <!--begin::Page Title-->
                {{-- <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Topping</h5> --}}
                <h4 class="text-dark font-weight-bold mt-2 mb-2 mr-5">ServusCafe Usage Topping</h4>
                <!--end::Page Title-->

            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->

 
    <div class="main-content container">
    <!--begin::Card-->
    <div class=" card card-custom mt-6">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Topping List</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{url('admin/create-topping')}}" class="btn btn-primary font-weight-bolder">
                    <i class="icon-xl la la-plus"></i>
                    Add Topping
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
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover  w-100" id="superadmin_tenant_datatable">
                <thead>
                    <tr>
                        <th title="Field #1">Topping ID</th>
                        <th title="Field #2">Topping Name</th>
                        <th title="Field #8">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_toppings as $single_topping)
                    <tr>
                        <td>{{ $single_topping->id }}
                        </td>
                        <td>{{ $single_topping->topping_name }}
                        </td>

                        <td>
                            
                            <a href="{{('topping-edit/'.$single_topping->id)}}" class="btn btn-sm btn-clean btn-icon mr-2 changeTenantPlan" id="{{ $single_topping->id }}" title="Edit Topping">
                                <i class="icon-xl la la-money-check"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon mr-2 tenantDetails" id="tenantDetails-{{ $single_topping->id }}" title="Tenant Details" data-user-id="{{ $single_topping->id }}" data-subdomain="{{ $single_topping->tenant_name }}" data-registered-at="{{ \Carbon\Carbon::parse($single_topping->created_at)->format('m/d/Y') }}" data-active="{{ $single_topping->is_active }}" data-billing-plan-name="{{ $single_topping->customer && $single_topping->customer->subscribed('default') ? (isset($single_topping->customer->subscription('default')->items[0], $all_plans[$single_topping->customer->subscription('default')->items[0]->stripe_product]) ? $all_plans[$single_topping->customer->subscription('default')->items[0]->stripe_product] : '') : $single_topping->plan_name }}" data-billing-plan-start="{{ $single_topping->customer && $single_topping->customer->subscribed('default') ? (new \DateTime($single_topping->customer->subscription('default')->created_at))->format('m/d/Y') : $single_topping->plan_start_date }}" data-ip-verification="{{ $single_topping->ip_verification_enable }}" data-tenant-name="{{ $single_topping->tenant_name }}" data-billing-plan-price="{{ $single_topping->plan_price }}" data-tenant-link="{{ $single_topping->tenant_name }}" data-tenant-owner="{{ $single_topping->owner && $single_topping->owner->full_name ? $single_topping->owner->full_name : '' }}" data-tenant-email="{{ $single_topping->owner && $single_topping->owner->email ? $single_topping->owner->email : '' }}">
                                <i class="icon-xl la la-eye"></i>
                            </a>

                            @if (!$single_topping->is_active)
                            <a href="{{url('admin/topping-delete/'.$single_topping->id)}}" class="btn btn-sm btn-clean btn-icon" id="delete_tenant" data-url="#" title="Delete">
                                <i class="icon-xl la la-trash-o"></i>
                            </a>
                            @endif
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
<!--  -->

<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, .7);
        transition: .3s linear;
        z-index: 1000;
    }

    .loading {
        display: none;
    }

    .spinner-border.loading {
        position: fixed;
        top: 48%;
        left: 48%;
        z-index: 1001;
        width: 5rem;
        height: 5rem;
    }
</style>

@stop
@section('scripts')
<script>
    $('#superadmin_tenant_datatable').DataTable({
        fixedColumns: true
    });
</script>

@endsection