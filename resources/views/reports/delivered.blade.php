<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivered</title>
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

@php
    $total = 0.00;
@endphp

<div>
    <table>
        <tr>
            <td colspan="6">
                MyNETgosyo
            </td>
        </tr>
        <tr>
            <td colspan="6">
                Delivered
            </td>
        </tr>
        <tr>
            <td colspan="6">
                {{ $dateFrom }} - {{ $dateTo }}
            </td>
        </tr>
    </table>
</div>

<div>
    <table>
        <tr>
            <td style="widtd: 40%;">
                Transaction #
            </td>
            <td>
                Name
            </td>
            <td>
                Ordered By
            </td>
            <td>
                Date Ordered
            </td>
            <td>
                Date Delivered
            </td>
            <td>
                Amount
            </td>
        </tr>

        @foreach ($data as $row)
        @php
            $total += floatval($row->tot_del_amt);
        @endphp
        <tr>
            <td>{{ $row->tran_no }}</td>
            <td>{{ $row->store_name }}</td>
            <td>{{ $row->order_by }}</td>
            <td>{{ $row->date_req }}</td>
            <td>{{ $row->date_del }}</td>
            <td>{{ $row->tot_del_amt }}</td>
        </tr>
        @endforeach
    </table>
</div>

<div>
    <table>
        <tr>
            <td colspan="5">Total</td>
            <td>
                {{ $total }}
            </td>
        </tr>
    </table>
</div>

</body>

</html>