<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order History</title>
    <style type="text/css">
        body {
            font-family: 'Segoe UI', 'Microsoft Sans Serif', sans-serif;
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

        .invoiceNbr {
            font-size: 40px;
            margin-right: 30px;
            margin-top: 30px;
            float: right;
        }

        .title1 {
            float: center;
            margin: 0 auto;
            font-size: 25px;
            width: 100%;
            font-weight: bold;
            text-align: center;
        }

        .title2 {
            float: center;
            margin: 0 auto;
            width: 100%;
            margin-top: 30px;
            font-size: 19px;
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
            font-size: 14px;
        }

        .head1 {
            /* padding-top: 20px; */
            width: 100%;
            font-size: 11px;
        }

        .head1 th {
            padding: 3px;
            text-align: right;
            font-size: 12px;
        }

        .endt {
            /* padding-top: 10px; */
            width: 100%;
            font-size: 11px;
            text-align: center;
        }

        .body2 {
            margin-top: 10px;
            width: 100%;
            font-size: 11px;
            text-align: center;
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            border-top-style: dashed;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .body1 {
            width: 100%;
            table-layout: fixed;
            overflow-wrap: break-word;
            font-size: 11px;
            /* text-align: center; */
        }

        .body1 th {
            /* border-top: 1px solid #000; */
            border-bottom: 1px solid #000;
            padding: 5px 0px 5px 0px;
            text-align: center;
            font-size: 12px;
            background-color: #d8d8d873;
        }

        .body1 td {
            padding: 4px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.227);
            border-bottom-style: dashed;
        }

        .body2 td {
            padding: 2px;
            font-size: 11px;
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

        .row {
            display: table-row;
            page-break-inside: avoid;
        }

        .page-break {
            page-break-before: always;
            page-break-after: always;
        }

        .table {
            page-break-inside: avoid
        }

        .tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .thead {
            display: table-header-group
        }

        .tfoot {
            display: table-footer-group
        }
    </style>
</head>

<body>
    <header>
        <div class="title2">
            My NETgosyo <br />
            <span style="font-size: 16px;">Order History Report </span><br />
            <span style="font-size: 12px; font-weight: normal;">
                {{ $data['date_from'] }} to
                {{ $data['date_to'] }}</span>
        </div>
    </header>
    <?php
    $sum_del_amt = 0;
    // dd($data);
    ?>
    <table class="head1">
        <tr>
            <th width="190%" style="text-align: left;">
            </th>
            <th width="50%" style="text-align: right;">Run Date :
                <span style="font-weight: normal;">
                    {{ $data['date_now']}}</span>
            </th>
        </tr>
        <tr>
            <th width="190%" style="text-align: left;">
            </th>
            <th width="50%" style="text-align: right; ">Run Time :
                <span style="font-weight: normal;">
                    {{ $data['time_now']}}</span>
            </th>
        </tr>

        <table class="body1">
            <thead>
                <tr>
                    <th>Location</th>
                    <th>SO No.</th>
                    <th>Customer</th>
                    <th>Date Submitted</th>
                    <th>Date Exported</th>
                    <th>Date Transit</th>
                    <th>Date Delivered</th>
                    <th>Salesman</th>
                    <th>Jefe</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>


                @foreach ($data['data'] as $key => $data)
                <tr>
                    <td style="text-align: left;">{{ $data['location'] }}</td>
                    <td style="text-align: left;">{{ $data['tran_no'] }}</td>
                    <td style="text-align: left;">{{ $data['customer'] }}</td>
                    <td style="text-align: left;">{{ $data['date_req'] }}</td>
                    <td style="text-align: left;">{{ $data['export_date'] }}</td>
                    <td style="text-align: left;">{{ $data['date_transit'] }}</td>
                    <td style="text-align: left;">{{ $data['date_delivered'] }}</td>
                    <td style="text-align: left;">{{ $data['salesman'] }}</td>
                    <td style="text-align: left;">{{ $data['jepe'] }}</td>
                    <td style="padding-left: 10px; text-align: right;">P
                        {{ number_format($data['amount'], 2)}}</td>

                    <?php
                        $sum_del_amt += $data['amount'];
                    ?>
                </tr>
                @endforeach
            </tbody>
            <tfoot></tfoot>
            <table class="body2">
                <thead>
                    <tr>
                        <td width="25%"></td>
                        <td width="25%"></td>
                        <td width="35%" style="text-align: right; padding-right: 35px; font-weight: bold;">Grand
                            Total >>></td>
                        <td width="15%" style="font-size: 12px; font-weight: bold;">P
                            {{ number_format($sum_del_amt, 2)}}</td>
                    </tr>
                </thead>
            </table>
        </table>
        {{-- @php dd($count) @endphp --}}
        {{-- <div class="page-break"></div> <!-- Page break --> --}}


    </table>
    {{-- <div class="page-break"></div> --}}



</body>

</html>