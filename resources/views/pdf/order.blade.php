<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        .text-left {
            text-align: left !important;
            letter-spacing: 0.5px;
        }

        tr .text-left{
            font-size: 20px;
        }

        h3{
            font-size: 20px !important;
        }
        h5{
            font-size: 15px;
        }

        .text-left-padding {
            text-align: left !important;
        }

        .text-top {
            padding-top: 20px !important;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        /* body {
            font-family: Arial, sans-serif;
        } */
        .order-details {
            margin: 20px;
        }

        .center {
            text-align: center;
        }

        body {
            padding: 10px !important;
            margin: 0;
            box-sizing: border-box;
            background-color: lightgray !important;
        }

        .receipt-form {
            background-color: white;
            width: 40% !important;
            text-align: center;
        }

        /* .header-receipt{
            display: grid;
            grid-template-columns: 1fr 1fr;
            text-align: left;
        } */

        .date {
            text-align: end;
        }

        .table {
            text-align: left;
        }

        .table-head {
            text-align: left;
        }

        thead {
            border-top: dashed;
            border-bottom: dashed;
        }

        .table td,
        .table th {
            border-top: 0px !important;
        }

        .table .dotted {
            border-top: dashed black !important;
        }

        .table .dotted-1 {
            border-top: solid black !important;
            border-bottom: solid black !important;
        }

        tbody {
            font-size: 1.15rem !important;
        }

        .thanks {
            font-size: 2rem !important;
        }

        .logo img {
            height: 15vmin;
            margin-bottom: 20px;
        }

        /* @media screen and (max-width:1610px) {
            tbody {
                font-size: 1.10rem !important;
            }

            .total h1 {
                font-size: 2rem !important;
                margin-top: 8px !important;
            }
        }

        @media screen and (max-width:1485px) {
            tbody {
                font-size: 1.0rem !important;
            }

            .total h1 {
                font-size: 1.6rem !important;
                margin-top: 8px !important;
            }

            .header h3 {
                font-size: 1.3rem !important;
            }

            .table-head h3 {
                font-size: 1.3rem !important;
            }
        }

        @media screen and (max-width:1350px) {
            .container {
                width: 55% !important;
            }
        }

        @media screen and (max-width:985px) {
            .container {
                width: 65% !important;
            }

            tbody {
                font-size: 0.8rem !important;
            }

            .total h1 {
                font-size: 1.5rem !important;
                margin-top: 8px !important;
            }

            .header h3 {
                font-size: 1.2rem !important;
            }

            .table-head h3 {
                font-size: 1.2rem !important;
            }

            .totals h1 {
                font-size: 1.4rem !important;
            }

            .thanks {
                font-size: 1.5rem !important;
            }
        }

        @media screen and (max-width:768px) {
            .container {
                width: 75% !important;
            }

            .table-head h3 {
                font-size: 1.1rem !important;
            }

            .total h1 {
                font-size: 1.2rem !important;
            }

            .totals h3 {
                font-size: 1.5rem !important;
            }

            .thanks {
                font-size: 1.4rem !important;
            }
        }

        @media screen and (max-width:619px) {
            .container {
                width: 90% !important;
            }

            .table-head h3 {
                font-size: 1.0rem !important;
            }

            .total h1 {
                font-size: 1.1rem !important;
            }

            .totals h3 {
                font-size: 1.4rem !important;
            }

            .thanks {
                font-size: 1.3rem !important;
            }

            .bill-no h3 {
                font-size: 1.1rem !important;
            }

            .date h3 {
                font-size: 1.1rem !important;
            }
        }

        @media screen and (max-width:619px) {
            .container {
                width: 100% !important;
            }
        }

        @media screen and (max-width:400px) {
            .bill-no h3 {
                font-size: 0.9rem !important;
            }

            .date h3 {
                font-size: 1rem !important;
            }

            .total h1 {
                font-size: 1rem !important;
            }

            .totals h3 {
                font-size: 1.2rem !important;
            }

            .thanks {
                font-size: 1.1rem !important;
            }

        } */
    </style>
    <link rel="stylesheet" href="{{url('Reciept.css')}}">
</head>

<body>
        <section class="container receipt-form" style="padding: 10px !important;">
            <div>
                <div class="bill-no">
                    <h2 class="text-left">
                        <span class="font-weight-light">Student Name:</span> 
                        {{ $orderData !=null ? $orderData['user']->first_name : '' }} {{ $orderData !=null ? $orderData['user']->last_name : '' }}
                    </h2>
                    <h2 class="text-left">
                        <span class="font-weight-light">Student Id:</span> 
                        #{{ $orderData !=null ? $orderData['user']->student_id : '' }}
                    </h2>
                    <h2 class="text-left">
                        <span class="font-weight-light">Date:</span> 
                        {{ $orderData !=null ? $orderData['order']->order_date : '' }}
                    </h2>
                    <h2 class="text-left">
                        <span class="font-weight-light">Pickup Time:</span> 
                        {{ isset($orderData['location']->name) ? $orderData['location']->name : '' }}
                    </h2>
                </div>
            </div>

            <div class="table-head mt-5">
                <h3><span class="font-weight-light">Order :</span> #{{$orderData != null ? $orderData['order']->id : ''}}</h3>
            </div>
            <table class="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th scope="col" class="text-left">Item</th>
                        <th class="text-left" scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($orderData['sandwich']))
                    <tr>
                        <th scope="row" class="text-left text-top">Sandwich</th>
                        <td class="text-left text-top">{{ $orderData['sandwich']->sandwich_name }}</td>
                    </tr>
                    @endif
                    @if (isset($orderData, $orderData['order'],$orderData['order']->sandwich_other_name))
                    <tr>
                        <th scope="row" class="text-left text-top"> Other Sandwich</th>
                        <td class="text-left text-top">{{ $orderData['order']->sandwich_other_name }}</td>
                    </tr>
                    @endif
                    @if(isset($orderData['topping']))
                    @foreach ($orderData['topping'] as $key=>$topping)
                    <tr>
                        <th scope="row" class="text-left ">Toppings</th>
                        <td class="text-left ">{{ $topping->topping_name }}</td>
                    </tr>
                    @endforeach
                    @endif
                    @if (isset($orderData, $orderData['order'],$orderData['order']->topping_other_name))
                    <tr>
                        <th scope="row" class="text-left"> Other Topping</th>
                        <td class="text-left">{{ $orderData['order']->topping_other_name }}</td>
                    </tr>
                    @endif

                </tbody>
            </table>
            <h3 class="text-center font-weight-light thanks mb-4">!!! Thank You !!!</h3>

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

        </section>
</body>

</html>