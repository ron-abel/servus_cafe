@extends('admin.layouts.default')

@section('title', 'ServusCafe Admin - Order')

@section('content')

    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2 ">
                <!--begin::Page Title-->
                {{-- <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Order</h5> --}}
                <h4 class="text-dark font-weight-bold mt-2 mb-2 mr-5">ServusCafe Usage Order</h4>
                <!--end::Page Title-->

            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->

  <!--  -->
  <div class="main-content container">
    <!--begin::Card-->
    <div class=" card card-custom mt-6">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Order List</h3>
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
                        <th title="Field #1">Order ID</th>
                        <th title="Field #2">User Name</th>
                        <th title="Field #3">Sandwich Name</th>
                        <th title="Field #3">Other Sandwich Name</th>
                        <th title="Field #8">Topping Name</th>
                        <th title="Field #8">Other Topping Name</th>
                        <th title="Field #8">Location Name</th>
                        <th title="Field #8">Order Date</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_orders as $single_order)
                    <tr>
                        <td>{{ $single_order->id }}
                        </td>
                        <td>{{ $single_order->first_name }} {{ $single_order->last_name }}
                        </td>
                        @if($single_order->sandwich_name)
                        <td>
                        <span class="btn btn-sm m-1 text-white btn-info"> {{$single_order->sandwich_name}}</span>
                            <p id="reverification_sent_{{ $single_order->id }}"></p>
                        </td>
                        <td></td>
                        @else
                        <td></td>
                        <td>
                        <span class="btn btn-sm m-1 text-white" style="background-color: grey;"> {{ $single_order->sandwich_other_name}}</span>
                            <p id="reverification_sent_{{ $single_order->id }}"></p>
                        </td>
                        @endif
                        <td>
                            @if($single_order->toppings !==null)
                            @forelse($single_order->toppings as $key=>$topping)
                            <span class="btn btn-sm m-1 text-white btn-info">{{$topping->topping_name}}</span>                           
                            @endforeach
                            @endif
                        </td><td>
                            @if($single_order->topping_other_name)
                            <span class="btn btn-sm m-1 text-white" style="background-color: grey;">{{$single_order->topping_other_name}}</span>                           
                            @endif
                        </td>
                        <td>
                        {{$single_order->name}}
                        </td>
                        <td>
                        {{$single_order->order_date}}
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
