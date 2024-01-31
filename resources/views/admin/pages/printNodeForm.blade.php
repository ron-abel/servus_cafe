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
                <h3 class="card-label">@if(isset($printNode)) Edit @else Create @endif PrintNode</h3>
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
            <!--begin::Form-->
            <form class="form" method="post" action="{{ url('admin/print-node-update') }}">
                    @csrf

                    @if ( session()->has('error') )
                    <div>{{ session()->get('error') }}</div>
                    @endif

                    <div class="card-body p-0">
                        <div class="form-group">
                            <label>PrintNode API Key:</label>
                            <input type="text" class="form-control form-control-solid" id="api_key" name="api_key" placeholder="Enter Api Key" value="{{ isset($printNode) ? $printNode->api_key : '' }}" />
                            <input type="hidden" class="form-control form-control-solid" id="print_node_id" name="print_node_id" value="{{ isset($printNode) ? $printNode->id : ''}}" />
                            @error('api_key')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label>PrintNode printer ID:</label>
                            <input type="text" class="form-control form-control-solid" id="printer_id" name="printer_id" placeholder="Enter Printer ID" value="{{ isset($printNode) ? $printNode->printer_id : '' }}" />
                            <input type="hidden" class="form-control form-control-solid" id="print_node_id" name="print_node_id" value="{{ isset($printNode) ? $printNode->id : ''}}" />
                            @error('printer_id')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary add_tenant_save mr-2">Submit</button>
                    </div>
                </form>
                <!--end::Form-->
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

@endsection