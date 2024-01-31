@extends('admin.layouts.default')

@section('title', 'ServusCafe Admin - Dashboard')

@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2 ">
                <!--begin::Page Title-->
                {{-- <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5> --}}
                <h4 class="text-dark font-weight-bold mt-2 mb-2 mr-5">ServusCafe Usage Dashboard</h4>
                <!--end::Page Title-->

            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->

  

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
