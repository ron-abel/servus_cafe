@extends('superadmin.layouts.default')

@section('title', 'Orders')
@section('content')
<div class="main-content container">
    <div class=" card card-custom mt-6">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="">
                <h3 class="card-label">Orders</h3>
                <div class="form-group">
                    <label for="tenant_filter">Filter by School:</label>
                    <select id="tenant_filter" class="form-control">
                        <option value="">All Schools</option>
                        @foreach ($all_tenants as $tenant)
                        <option value="{{ $tenant->id }}">{{ $tenant->tenant_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-toolbar">
                <!-- <a href="{{route('tenants.create')}}" class="btn btn-primary font-weight-bolder">
                    <i class="icon-xl la la-plus"></i>
                    Add School
                </a> -->
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

            <table class="table table-bordered table-hover  w-100" id="superadmin_tenant_datatable">
                <thead>
                    <tr>
                        <th title="Field #1">Order ID</th>
                        <th title="Field #2">School Name</th>
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
                        <td>{{ $single_order->tenant_name }}
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
        </div>
    </div>
</div>



@stop
@section('scripts')
   
<script>
        var dataTable = $('#superadmin_tenant_datatable').DataTable({
            fixedColumns: true
        });
        $('#tenant_filter').on('change', function () {
            var selectedTenantId = $(this).val();
            if (selectedTenantId) {
                $.ajax({
                    url: 'order',
                    method: 'GET',
                    data: { tenant_id: selectedTenantId },
                    success: function (data) {
                        dataTable.columns(2).search('').draw();
                        dataTable.clear().draw();
                        for (var i = 0; i < data.length; i++) {
                        var toppingsHtml = '';
                        if (data[i].toppings !== null) {
                            for (var j = 0; j < data[i].toppings.length; j++) {
                                toppingsHtml += '<span class="btn btn-sm m-1 text-white btn-info">' + data[i].toppings[j].topping_name + '</span>';
                            }
                        }
                        dataTable.row.add([
                            data[i].id,
                            data[i].tenant_name,
                            data[i].first_name + ' ' + data[i].last_name,
                            data[i].sandwich_name ? 
                                '<span class="btn btn-sm m-1 text-white btn-info">' + data[i].sandwich_name + '</span>' : '',
                            data[i].sandwich_other_name ?
                                '<span class="btn btn-sm m-1 text-white" style="background-color: grey;">' + data[i].sandwich_other_name + '</span>' : '',
                            toppingsHtml, // Add the toppings here
                            data[i].topping_other_name ?
                                '<span class="btn btn-sm m-1 text-white" style="background-color: grey;">' + data[i].topping_other_name + '</span>' : '',
                            data[i].time,
                            data[i].order_date
                        ]).draw(false);
                    }
                    },
                    error: function () {
                        alert('An error occurred while fetching data.');
                    }
                });
            } else {
                dataTable.columns(2).search('').draw();
            }
        });
</script>
@endsection
