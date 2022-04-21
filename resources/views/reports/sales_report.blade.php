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
            padding: 3px;
            line-height: 1.42857143;
            border-top: 1px solid rgba(0, 0, 0, 0.227);
            border-top-style: dashed;
            font-size: 10px;
        }

        .body2 td {
            padding: 2px;
            font-size: 10px;
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

    @foreach ($datas as $key => $data)
    <?php 
        $sum_qty = 0;
        $sum_uns_qty = 0;
        $sum_ret_qty = 0; 
        $sum_del_qty = 0;  
        $sum_total_ret_amt = 0;
        $sum_total_gross= 0; 
        $sum_total_discount= 0;
        $sum_total = 0;
    ?>
    <header>
        {{-- <div class="title1">
                E-DISTRIBUTION
            </div> --}}
        <div class="title2">
            Sales Report
        </div>

    </header>

    <table class="head1">

        <tr>
            <th width="17%">Transaction No :</th>
            <td width="50%">{{ $data['tran_no'] }}</td>
            <th width="20%">Transaction Date :</th>
            <td width="25%" style="text-align: right;">{{ $data['date_req'] }}</td>
        </tr>
        <tr>
            <th width="15%">Store Name:</th>
            <td width="50%">{{ $data['store_name'] }}</td>
            <th width="20%">Delivered Date :</th>
            <td width="25%" style="text-align: right;">{{ $data['date_del'] }} </td>
        </tr>
        <tr>
            <td colspan="4">
                <table class="body1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th width="28%">Description</th>
                            <th>AMT</th>
                            <th>UOM</th>
                            <th>QTY</th>
                            <th>UNS QTY</th>
                            <th>RET QTY</th>
                            <th>DEL QTY</th>
                            <th>Total</th>
                            <th>Discount</th>
                            <th>Total w/ Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['datas'] as $item)

                        <tr>
                            <td style="text-align: left;">{{ $item['itm_code'] }}</td>
                            <td style="text-align: left;">{{ $item['item_desc'] }}</td>
                            <td style="text-align: right">P {{ number_format($item['amt'],2) }} </td>
                            <td>{{ $item['uom'] }}</td>
                            <td style="text-align: center;">{{ $item['req_qty'] }}</td>
                            <td style="text-align: center;">{{ $item['unserved'] }}</td>\

                            @if($item['retQty'] == 0)
                            <td style="text-align: center;">0</td>
                            @else
                            <td style="text-align: center;">{{ $item['retQty'] }}</td>
                            @endif

                            <td style="text-align: center;">{{ $item['del_qty'] }}</td>
                            <td style="text-align: right">P
                                {{ number_format($item['total_gross'],2) }}
                            </td>
                            @if($item['discount'] == 0)
                            <td> - </td>
                            @else
                            <td>{{ round($item['discount'], 2) }}%</td>
                            @endif
                            <td style="text-align: right">P {{ number_format($item['totaltotal'],2) }}</td>
                        </tr>
                        <?php 
                                $sum_qty += $item['req_qty'];
                                $sum_uns_qty += $item['unserved'];
                                $sum_ret_qty += $item['retQty'];
                                $sum_del_qty += $item['del_qty'];
                                $sum_total_ret_amt += $item['total_ret_amt'];
                                $sum_total += $item['total_gross'];
                                $sum_total_gross += $item['totaltotal'];
                                $sum_total_discount += $item['total_amt_discount'];
                            ?>
                        @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                {{-- <table class="endt">
                        <tr>
                            <td>***Nothing Follow***</td>
                        </tr>
                    </table> --}}
                <table class="body2">
                    <tr>
                        <td width="15%" style="font-weight: bold; text-align: right;">Total Qty >>></td>
                        <td width="10%" style="text-align: right;">
                            {{ $sum_qty }}
                        </td>
                        <td width="15%" style="font-weight: bold;"></td>
                        <td width="15%" style="font-weight: bold; text-align: right;">
                            Gross Total Amt >>></td>
                        <td width="15%" style="text-align: right; text-align: right;">
                            P
                            {{ number_format($sum_total,2) }}
                        </td>
                        <td width="5%" style="font-weight: bold;"></td>
                        {{-- <td width="20%" style="font-weight: bold; text-align: right"></td> --}}
                    </tr>

                    <tr>
                        <td width="15%" style="font-weight: bold; text-align: right;">Total Returned Qty >>></td>
                        <td width="10%" style="text-align: right;">
                            {{ $sum_ret_qty }}
                        </td>
                        <td width="15%" style="font-weight: bold;"></td>
                        <td width="15%" style="font-weight: bold; text-align: right;">
                            Total Discount >>>
                        </td>
                        <td width="15%" style="font-weight: bold; text-align: right;">
                            P {{ number_format($sum_total_discount,2) }}
                        </td>
                        <td width="5%" style="font-weight: bold;"></td>
                        {{-- <td width="20%" style="text-align: right"></td> --}}
                    </tr>

                    <tr>
                        <td width="15%" style="font-weight: bold; text-align: right;">
                            Total Unserved Qty >>>
                        </td>
                        <td width="10%" style="text-align: right;">
                            {{ $sum_uns_qty }}
                        </td>
                        <td width="15%" style="font-weight: bold;"></td>
                        <td width="15%" style="font-weight: bold; text-align: right;">
                            Net Total Amt >>>
                        </td>
                        <td width="15%" style="font-weight: bold; text-align: right;">
                            P {{ number_format($sum_total_gross,2) }}
                        </td>
                        <td width="5%" style="font-weight: bold;"></td>
                        {{-- <td width="20%" style="text-align: right"></td> --}}
                    </tr>

                    <tr>
                        <td width="15%" style="font-weight: bold; text-align: right;">
                            Total Delivered Qty >>>
                        </td>
                        <td width="10%" style="text-align: right;">
                            {{ $sum_del_qty }}
                        </td>
                        <td width="15%" style="font-weight: bold;"></td>
                        <td width="15%" style="font-weight: bold; text-align: right;"></td>
                        <td width="15%" style="font-weight: bold; text-align: right"></td>
                        <td width="5%" style="font-weight: bold;"></td>
                        {{-- <td width="20%" style="text-align: right"></td> --}}
                    </tr>
                </table>
            </td>
        </tr>


    </table>
    <div class="page-break"></div>
    @endforeach



</body>

</html>