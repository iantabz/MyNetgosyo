<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Orders Summary</title>
    <style media="screen">
        @page {
            margin: 1cm;
        }

        body {
            font-family: 'Segoe UI', 'Microsoft Sans Serif', sans-serif;
            margin: 0px;
        }

        header {
            text-align: center;
        }
        .title1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .title2 {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .title3 {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #c5c5c5;
            font-size: 13px;
        }

        td, tr, th {
            padding: 5px;
            border: 1px solid #c5c5c5;
        }

        th {
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

<header>
    <div class="title1">
        My NETgosyo
    </div>
    <div class="title2">
        Customer Orders Summary
    </div>
    <div class="title3">
        {{ date('F d, Y', strtotime($dateFrom)) }} to {{ date('F d, Y', strtotime($dateTo)) }}
    </div>
</header>
<br>
<div>
    <table>
        <tr>
            <th rowspan="2" style="width: 40%;">
                Customer
            </th>
            <th colspan="2">
                Salesman App
            </th>
            <th colspan="2">
                Customer App
            </th>
            <th colspan="2">
                Backend
            </th>
            <th colspan="2">
                TOTAL
            </th>
        </tr>
        <tr>
            <th>Order Count</th>
            <th>Amount</th>
            <th>Order Count</th>
            <th>Amount</th>
            <th>Order Count</th>
            <th>Amount</th>
            <th>Total Orders</th>
            <th>Total Amount</th>
        </tr>
        @php
            $salesman_total_order_count = 0;
            $salesman_total_amount = 0;
            $customer_total_order_count = 0;
            $customer_total_amount = 0;
            $backend_total_order_count = 0;
            $backend_total_amount = 0;
        @endphp
        @foreach ($data as $row)
            @php
                $salesman_total_order_count += $row->salesman_order_count;
                $salesman_total_amount += $row->salesman_amount;
                $customer_total_order_count += $row->customer_order_count;
                $customer_total_amount += $row->customer_amount;
                $backend_total_order_count += $row->backend_order_count;
                $backend_total_amount += $row->backend_amount;
            @endphp
            <tr>
                <td>
                    {{ $row->store_name }}
                </td>
                <td>
                    {{ $row->salesman_order_count }}
                </td>
                <td style="text-align: right;">
                    {{ number_format($row->salesman_amount, 2) }}
                </td>
                <td>
                    {{ $row->customer_order_count }}
                </td>
                <td style="text-align: right;">
                    {{ number_format($row->customer_amount, 2) }}
                </td>
                <td>
                    {{ $row->backend_order_count }}
                </td>
                <td style="text-align: right;">
                    {{ number_format($row->backend_amount, 2) }}
                </td>
                <td>
                    {{ $row->salesman_order_count 
                    + $row->customer_order_count
                    + $row->backend_order_count }}
                </td>
                <td style="text-align: right;">
                    {{ number_format($row->salesman_amount 
                    + $row->customer_amount
                    + $row->backend_amount, 2) }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="7">
                &nbsp;
            </td>
        </tr>
        <tr>
            <th>
                Total
            </th>
            <th>
                {{ $salesman_total_order_count }}
            </th>
            <th style="text-align: right;">
                {{ number_format($salesman_total_amount, 2) }}
            </th>
            <th>
                {{ $customer_total_order_count }}
            </th>
            <th style="text-align: right;">
                {{ number_format($customer_total_amount, 2) }}
            </th>
            <th>
                {{ $backend_total_order_count }}
            </th>
            <th style="text-align: right;">
                {{ number_format($backend_total_amount, 2) }}
            </th>
            <th>
                {{ $salesman_total_order_count 
                +  $customer_total_order_count
                +  $backend_total_order_count}}
            </th>
            <th style="text-align: right;">
                {{ number_format($salesman_total_amount 
                    +  $customer_total_amount 
                    +  $backend_total_amount, 2) }}
            </th>
        </tr>
    </table>
</div>
<br>
<div style="font-size: 11px;">
    <em>
        Run Date and Time: {{ date('F d, Y H:i:s', strtotime('now')) }}
    </em>
</div>
</body>

</html>