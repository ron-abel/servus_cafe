@extends('admin.layouts.default')

@section('title', 'ServusCafe Admin - PrintNode')

@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2 ">
                <!--begin::Page Title-->
                {{-- <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">PrintNode</h5> --}}
                <h4 class="text-dark font-weight-bold mt-2 mb-2 mr-5">ServusCafe Usage PrintNode</h4>
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
                <h3 class="card-label">PrintNode List</h3>
            </div>
            @if(count($printNode) < 1)
            <div class="card-toolbar">
                <a href="{{url('admin/create-print-node')}}" class="btn btn-primary font-weight-bolder">
                    <i class="icon-xl la la-plus"></i>
                    Add PrintNode
                </a>
                <!--end::Button-->
            </div>
            @endif
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
                        <th title="Field #1">PrintNode ID</th>
                        <th title="Field #2">PrintNode API Key</th>
                        <th title="Field #2">PrintNode Printer ID</th>
                        <th title="Field #8">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($printNode as $single_print_node)
                    <tr>
                        <td>{{ $single_print_node->id }}
                        </td>
                        <td>{{ $single_print_node->api_key }}
                        </td>
                        <td>{{ $single_print_node->printer_id }}
                        </td>

                        <td>
                            
                            <a href="{{('print-node-edit/'.$single_print_node->id)}}" class="btn btn-sm btn-clean btn-icon mr-2 changeTenantPlan" id="{{ $single_print_node->id }}" title="Edit PrintNode">
                                <i class="icon-xl la la-money-check"></i>
                            </a>

                            @if (!$single_print_node->is_active)
                            <a href="{{url('admin/print-node-delete/'.$single_print_node->id)}}" class="btn btn-sm btn-clean btn-icon" id="delete_tenant" data-url="#" title="Delete">
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