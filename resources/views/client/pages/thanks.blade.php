<?php
$orderData = session('orderData');
?>
@extends('client.mainLayout.layout')

@section('title', 'Servus cafe - Studen Login Credentials Required')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <section class="container receipt-form">
        <div class="logo">
            <img src="/assets/img/client/logo1.png" alt="">
        </div>
        @if(isset($orderData['user']->first_name))
            <div >
                <div class="bill-no">
                    <!-- <h3><span class="font-weight-light">Bill No:</span> INNV110</h3> -->
                    <h3 class="text-left">
                        <span class="font-weight-light">Student Name:</span>  
                        {{ isset($orderData['user']->first_name) ? $orderData['user']->first_name : '' }} 
                        {{ isset($orderData['user']->last_name) ? $orderData['user']->last_name : '' }}
                    </h3>
                    <h3 class="text-left">
                        <span class="font-weight-light">Student Id:</span> 
                        #{{ isset($orderData['user']->student_id) ? $orderData['user']->student_id : '' }}
                    </h3> 
                    <h3 class="text-left">
                        <span class="font-weight-light">Date:</span> 
                        {{ isset($orderData['order']->order_date) ? $orderData['order']->order_date : '' }}
                    </h3>
                    
                    <h3 class="text-left">
                        <span class="font-weight-light">Pickup Time:</span> 
                        {{ isset($orderData['location']->name) ? $orderData['location']->name : '' }}
                        
                    </h3>
                </div>
            </div>

            <div class="table-head mt-5">
                <h3><span class="font-weight-light">Order :</span> #{{isset($orderData['order']->id) ? $orderData['order']->id : ''}}</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th class="text-right" scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @if (isset($orderData, $orderData['sandwich']))
                    <tr>
                        <th scope="row"> Sandwich</th>
                        <td class="text-right">{{ $orderData['sandwich']->sandwich_name }}</td>
                    </tr>
                    @endif
                    @if (isset($orderData, $orderData['order'],$orderData['order']->sandwich_other_name))
                    <tr>
                        <th scope="row"> Other Sandwich</th>
                        <td class="text-right">{{ $orderData['order']->sandwich_other_name }}</td>
                    </tr>
                    @endif
                    
                    @if(isset($orderData, $orderData['topping']))
                    @foreach ($orderData['topping'] as $key=>$topping)    
                    <tr>
                        <th scope="row">Toppings</th>
                        <td class="text-right">{{ isset($topping->topping_name) ? $topping->topping_name : "" }}</td>
                    </tr>
                    @endforeach
                    @endif
                    @if (isset($orderData, $orderData['order'],$orderData['order']->topping_other_name))
                    <tr>
                        <th scope="row"> Other Topping</th>
                        <td class="text-right">{{ $orderData['order']->topping_other_name }}</td>
                    </tr>
                    @endif

                </tbody>
            </table>
            <h3  class="text-center font-weight-light thanks mb-4">!!! Thank You !!!</h3>

            <div class="date">
                <?php 
                    $utcDateTime = new DateTime($orderData['order']->created_at, new DateTimeZone('UTC'));

                    // Set the timezone to Eastern Standard Time (EST)
                    $estTimeZone = new DateTimeZone('America/New_York');
                    $utcDateTime->setTimezone($estTimeZone);
                    
                    // Format the result as a string
                    $estTime = $utcDateTime->format('Y-m-d H:i:s T');
                ?>
                <h5 class="font-weight-light text-left">Dt: {{ isset($orderData['order']) ? $estTime : '' }}</h5>
                
            </div>
        @endif
        @if(session()->has('error'))
            <div class="alert alert-danger" role="alert"> {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        <a href="{{url('/student/order')}}" class="menu-link btn btn-info mb-4">
            <span class="menu-text">Go to Order!</span>
            <span class="menu-desc"></span>
        </a>
        
    </section>
    @endsection