<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Report</title>
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
            padding-bottom: 5px;
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
            font-size: 12px;
            background-color: #d8d8d873;
        }

        .body1 td {
            padding: 4px;
            line-height: 1.42857143;
            border-top: 1px solid rgba(0, 0, 0, 0.227);
            border-top-style: dashed;
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
        {{-- <div class="title1">
                E-DISTRIBUTION
            </div> --}}
        <div class="title2">
            Customer Order Count
        </div>

    </header>
    <?php
    $sum_order = 0;
    // dd($data);
    ?>
    <table class="head1">
        <tr>
            {{-- <th style="text-align: left">Jepe : {{ $data['first_name'] . ' '. $data['last_name']}}</th> --}}

            <th width="190%" style="text-align: left;">
            </th>
            <th width="50%" style="text-align: left;">Run Date :
                <span style="font-weight: normal;">
                    {{ $data['date_now']}}</span>
            </th>
        </tr>
        <tr>
            {{-- <th width="40%" style="text-align: left; font-size: 9px">From {{ $data['date_from'] }} to
            {{ $data['date_to'] }}</th>
            <td width="50%"></td>
            <th width="10%"></th> --}}

            <th width="190%" style="text-align: left;">From {{ $data['date_from'] }} to
                {{ $data['date_to'] }}
            </th>
            <th width="50%" style="text-align: left; ">Run Time :
                <span style="font-weight: normal;">
                    {{ $data['time_now']}}</span>
            </th>
        </tr>
        <tr>
            <td colspan="5">
                <table class="body1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th style="text-align: center;">Total Order Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['data'] as $key => $data)

                        <tr>
                            <td style="text-align: left;">{{ $data['customer_name'] }}</td>
                            <td style="text-align: center;">{{ $data['total_order'] }}</td>
                        </tr>
                        <?php
                        $sum_order += $data['total_order'];
                        ?>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <table class="body2">
                    <thead>
                        <tr>
                            <td width="25%"></td>
                            <td width="25%"></td>
                            <td width="35%" style="text-align: right; padding-right: 35px; font-weight: bold;">Grand
                                Total >>></td>
                            <td width="15%"> {{ $sum_order}}</td>
                        </tr>
                    </thead>
                </table>
            </td>
        </tr>
    </table>
    {{-- <div class="page-break"></div> --}}



</body>

</html>