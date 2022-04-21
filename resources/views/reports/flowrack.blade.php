<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions</title>
    <style media="screen">
        @page {
            margin: 1cm;
        }

        body {
            font-family: 'Segoe UI', 'Microsoft Sans Serif', sans-serif;
            margin: 0px;
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

        .title3 {
            float: center;
            margin: 0 auto;
            width: 100%;
            margin-top: 50px;
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
            width: 100%;
            font-size: 14px;

        }

        .endt {
            /* padding-top: 10px; */
            width: 100%;
            font-size: 11px;
            text-align: center;

        }

        .tfoot {
            /* padding-top: 10px; */
            width: 100%;
            font-size: 11px;

        }

        .tfoot1 {
            /* padding-top: 10px; */
            width: 100%;
            font-size: 11px;

        }

        .body2 {
            /* padding-top: 10px; */
            width: 100%;
            font-size: 12px;
            text-align: center;
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
        }

        .body1 {
            /* padding-top: 10px; */
            width: 100%;
            font-size: 14px;
            text-align: center;

        }

        .body1 th {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .body1 tr {
            padding-top: 4px;
            border-bottom: 4px;
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
        div[class^="col-"] {
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
    
    @php
        $page = 0;
        $prev_SO_num = '';
    @endphp
    
    @foreach ($datas as $key=> $data)
        @php
            if($prev_SO_num != $data['so_no']) {
                $page = 0;
                $prev_SO_num = $data['so_no'];
            }
            $page++;
        @endphp
        
    <header>
        <div class="title1">
            MY NETGOSYO
        </div>
        <div class="title2">
            SO Picking List
        </div>
        <div class="title3">
            (Flowrack)
        </div>
    </header>

    <table class="head1">

        <tr>
            <td>Store Name :</td>
            <td width="50%">{{ $data['store_name'] }}</td>
            <td width="10%">SO No. :</td>
            <td width="20%" style="text-align: right;">{{ $data['so_no'] }}</td>
        </tr>
        <tr>
            <td>Customer :</td>
            <td width="50%">{{ $data['acct_code'] }} - {{ $data['acct_name'] }}</td>
            <td width="10%">SO Date :</td>
            <td width="20%" style="text-align: right;">{{ $data['date_req'] }}</td>
        </tr>
        <tr>
            <td>Salesman Name :</td>
            <td width="50%">{{ $data['salesman_code'] }} - {{ $data['salesman_name'] }}</td>
            <td>Page :</td>
            <td style="text-align: right;"> {{ $page }} </td>
        </tr>
        <tr>
            <td colspan="4">
                <table class="body1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Description</th>
                            <th>SO Qty</th>
                            <th>UOM</th>
                            <th>Qty Served</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 0;
                        $end = 40;
                        $flag = 0;
                        @endphp

                        @foreach ($data['customer_order'] as $datas1)
                        @if ($data['acct_code'] == $datas1['acct_code'])
                        @php
                        $count++;
                        @endphp
                        <tr>
                            <td>{{ $datas1['itemcode'] }}</td>
                            <td align="left" width="50%">{{ $datas1['product_name'] }}</td>
                            <td style="text-align: center;">{{ $datas1['qty_ordered'] }}</td>
                            <td>{{ $datas1['product_uom'] }}</td>
                            <td>__________</td>
                        </tr>
                        @if($count == $end)
                        @php
                        $page++;
                        @endphp
                    </tbody>
                </table> <!-- Table closed -->
                <div class="page-break"></div> <!-- Page break -->

                <header>
                    <div class="title1">
                        MY NETGOSYO
                    </div>
                    <div class="title2">
                        SO Picking List
                    </div>
                    <div class="title3">
                        (Flowrack)
                    </div>
                </header>

                <table class="head1">
                    <tr>
                        <td>Store Name :</td>
                        <td width="50%">{{ $data['store_name'] }}</td>
                        <td width="10%">SO No. :</td>
                        <td width="20%" style="text-align: right;">{{ $data['so_no'] }}</td>
                    </tr>
                    <tr>
                        <td>Customer :</td>
                        <td width="50%">{{ $data['acct_code'] }} - {{ $data['acct_name'] }}</td>
                        <td width="10%">SO Date :</td>
                        <td width="20%" style="text-align: right;">{{ $data['date_req'] }}</td>
                    </tr>
                    <tr>
                        <td>Salesman Name :</td>
                        <td width="50%">{{ $data['salesman_code'] }} - {{ $data['salesman_name'] }}</td>
                        <td>Page :</td>
                        <td style="text-align: right;"> {{ $page }} </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="body1" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Description</th>
                                        <th>SO Qty</th>
                                        <th>UOM</th>
                                        <th>Qty Served</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $count = 0;
                                    $flag = 40;
                                    @endphp
                                    @endif
                                    @endif

                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="endt">
                                <tr>
                                    <td>***Nothing Follows***</td>
                                </tr>
                            </table>
                            <table class="body2">
                                <tr>
                                    <td width="15%" style="font-weight: bold;">Total Entries>>> </td>
                                    <td style="font-weight: bold;"> &nbsp;&nbsp;&nbsp;{{ $data['total_count'] }}</td>
                                    <td width="35%" style="font-weight: bold; text-align: right;">Total Qty Ordered>>>
                                    </td>
                                    <td style="text-align: center; font-weight: bold;">{{ $data['tot_qty'] }}</td>
                                    <td style="font-weight: bold; text-align: right;">Total Qty Served>>>__________</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="tfoot">
                                <tr>
                                    <td>Encoded By:</td>
                                    <td>Received By:</td>
                                    <td>Picked By:</td>
                                    <td>Checked By:</td>
                                </tr>
                                <tr>
                                    <td>_____________________</td>
                                    <td>_____________________</td>
                                    <td>_____________________</td>
                                    <td>_____________________</td>
                                </tr>
                                <tr>
                                    <td>Signature over Printed name</td>
                                    <td>Signature over Printed name</td>
                                    <td>Signature over Printed name</td>
                                    <td>Signature over Printed name</td>
                                </tr>
                                <tr>
                                    <td>Date: ____________</td>
                                    <td>Date: ____________</td>
                                    <td>Date: ____________</td>
                                    <td>Date: ____________</td>
                                </tr>
                                <tr>
                                    <td>Time: ____________</td>
                                    <td>Time: ____________</td>
                                    <td>Time: ____________</td>
                                    <td>Time: ____________</td>
                                </tr>
                                <tr>
                                    <td>Designation: ____________</td>
                                    <td>Designation: ____________</td>
                                    <td>Designation: ____________</td>
                                    <td>Designation: ____________</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="tfoot1">
                                <tr>
                                    <td width="30%">My NETgosyo App</td>
                                    <td width="80%">Note: This Document is not valid without complete signatory</td>
                                </tr>
                                <tr>
                                    <td width="60%">Run Date & Time: {{ $data['date_now'] }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
                @if($loop->last == false)
                    <div class="page-break"></div>
                @endif
                
                @endforeach



</body>

</html>