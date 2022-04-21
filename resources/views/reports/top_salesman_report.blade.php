<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Distribution Customer Masterfile</title>
    <style media="screen">
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
            padding-top: 20px;
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
            padding-bottom: 10px;
        }

        .body1 {
            margin-top: 15px;
            width: 100%;
            font-size: 11px;
            text-align: center;
        }

        .body1 th {
            /* border-top: 1px solid #000; */
            border-bottom: 1px solid #000;
            padding: 5px 0px 5px 0px;
            text-align: center;
            font-size: 11px;
        }

        .body1 td {
            padding: 8px;
            line-height: 1.42857143;
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
    </style>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <header>
        <div class="title1">
            {{-- DISTRIBUTION --}}
        </div>
        <div class="title2">
            {{-- Distribution Customer Masterfile --}}
        </div>

    </header>

    <table class="head1">
        {{-- <?php dd($data)?> --}}

        {{-- <tr>
            <th width="40%" style="text-align: left; font-size: 13px;">{{ $data['first_name']}}
        {{$data['last_name']}}</th>
        <td width="50%"></td>
        <th width="10%"></th>
        </tr>
        <tr>
            <th width="40%" style="text-align: left; font-size: 9px">From {{ $data['date_from'] }} to
                {{ $data['date_to'] }}</th>
            <td width="50%"></td>
            <th width="10%"></th>
        </tr> --}}
        <tr>
            <td colspan="2">
                <table class="body1" cellspacing="0">
                    <thead>
                        <tr style=" border-bottom: 1px solid #000;">
                            <th colspan="2">
                                <h3>Top Salesman</h3> <br>
                                From {{ $data['date-from'] }} To
                                {{ $data['date-to'] }}
                            </th>
                        </tr>

                        <tr>
                            <th>Salesman</th>
                            <th>Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['trans_data'] as $key => $data)
                        <tr>
                            <td style="text-align: left;">{{ $data['name'] }}</td>
                            <td>P {{ number_format($data['tot_del_amt'],2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
    </table>



</body>

</html>