<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Location Data</title>
    <style media="screen">
        body {
            font-family: 'Segoe UI', 'Microsoft Sans Serif', sans-serif;
            font-size: 12px;
        }

        /*
            These next two styles are apparently the modern way to clear a float. This allows the logo
            and the word "Invoice" to remain above the From and To sections. Inserting an empty div
            between them with clear:both also works but is bad style.
            Reference:
            http://stackoverflow.com/questions/490184/what-is-the-best-way-to-clear-the-css-style-float
        */
        header:before,
        header:after {
            content: " ";
            display: table;
        }

        header:after {
            clear: both;
        }

        .title1 {
            float: center;
            margin: 0 auto;
            font-size: 18px;
            width: 100%;
            font-weight: bold;
            text-align: center;
        }

        .title2 {
            float: center;
            margin: 0 auto;
            width: 100%;
            margin-top: 30px;
            /* font-size: 19px; */
            font-weight: bold;
            text-align: center;
        }

        .from {
            float: left;
        }

        .to {
            float: right;
        }

        .fromto {
            padding-top: 20px;
            width: 600px;
            font-size: 14px;
        }

        .fromto1 {
            width: 180px;
            padding-top: 20px;
            /* font-size: 14px; */
        }

        .head1 {
            /* padding-top: 20px; */
            width: 100%;
            /* font-size: 11px; */
        }

        .head1 th {
            padding: 3px;
            text-align: right;
            /* font-size: 12px; */
        }

        .endt {
            /* padding-top: 10px; */
            width: 100%;
            font-size: 11px;
            text-align: center;
        }

        .body1 {
            margin-top: 10px;
            width: 100%;
            font-size: 11px;
            text-align: center;
        }

        .body1 th {
            border-bottom: 1px solid #000;
            padding: 5px 0px 5px 0px;
            text-align: center;
        }

        .body1 td {
            padding: 8px;
            line-height: 1.42857143;
            border-bottom: 1px solid rgba(0, 0, 0, 0.227);
            border-bottom-style: dashed;
        }

        .body2 {
            margin-top: 5px;
            width: 100%;
            font-size: 11px;
            text-align: center;
        }

        .body2 th {
            border-bottom: 0px solid #000;
            padding: 5px 0px 5px 0px;
            text-align: center;
        }

        .body2 td {
            padding: 2px;
        }

        .fromtocontent {
            margin: 10px;
            margin-right: 15px;
        }

        .panel {
            background-color: #e8e5e5;
            padding: 7px;
        }

        .items {
            clear: both;
            display: table;
            padding: 20px;
        }

        /* Factor out common styles for all of the "col-" classes.*/
        div[class^='col-'] {
            display: table-cell;
            padding: 7px;
        }

        /*for clarity name column styles by the percentage of width */
        .col-1-10 {
            width: 10%;
        }

        .col-1-52 {
            width: 52%;
        }

        /* 
        .row {
            display: table-row;
            page-break-inside: avoid;
        } */

        .page-break {
            page-break-after: always;
        }

        .page-break:last-child {
            page-break-after: avoid;
            page-break-before: avoid;
        }


        h4 {
            margin: 3px;
        }

        img {
            display: inline-block;
            max-width: 100%;
            height: auto;
            /* vertical-align: middle; */
            /* border: 0; */
        }

        img.img-tabz {
            font-size: 190px;
            z-index: -1;
            position: absolute;
            margin-top: -14px;
        }

        span.span-text {
            position: absolute;
            z-index: 1;
        }
    </style>
</head>

<body>
    {{-- {{dd($data)}} --}}
    @php
    $x = 0;
    @endphp

    <table>
        <thead>
            <tr>
                <th style="text-align: center; font-size: 12px; font-weight: bold;" colspan="3">
                    Customer List
                </th>
            </tr>

            <tr>
                <th style="font-weight: bold;">Salesman: {{ $data['salesman']['first_name'] . ' '.
                    $data['salesman']['last_name'] }}</th>
            </tr>
            <tr>
                <th style="font-weight: bold;">User Code: {{ $data['salesman']['user_code'] }}</th>
            </tr>
        </thead>
    </table>
    {{-- {{dd($data['salesman']['first_name'])}} --}}
    <table class="body1">
        <thead>
            <tr>
                <th style="text-align: center; vertical-align: middle; font-weight: bold;">
                    Customer Name
                </th>
                <th style="text-align: center; vertical-align: middle; font-weight: bold;">
                    Account Code
                </th>
                <th style="text-align: center; vertical-align: middle; font-weight: bold;">
                    Address
                </th>
            </tr>
        </thead>
        @foreach ($data['data'] as $customers => $customer)
        {{-- {{dd($customer)}} --}}
        <tbody>
            @if(!$data['data'])
            <tr>
                <td colspan="3" style="text-align: center">No data available.</td>
            </tr>
            @endif

            <tr>
                <td> {{ $customer['account_name'] }}</td>
                <td>{{ $customer['account_code'] }}</td>
                <td>{{$customer['address3']}}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</body>

</html>