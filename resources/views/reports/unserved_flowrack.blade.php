<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions</title>
    <style media="screen">

        @page { margin: 1cm; }

        body {
            font-family: 'Segoe UI','Microsoft Sans Serif',sans-serif;
            margin: 0px;
        }

        /*
            These next two styles are apparently the modern way to clear a float. This allows the logo
            and the word "Invoice" to remain above the From and To sections. Inserting an empty div
            between them with clear:both also works but is bad style.
            Reference:
            http://stackoverflow.com/questions/490184/what-is-the-best-way-to-clear-the-css-style-float
        */
        header:before, header:after {
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
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

        .title3 {
            float: center;
            margin: 0 auto;
            width: 100%;
            margin-top: 50px;
            font-size: 15px;
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
           font-size: 12px;

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
           font-size: 11px;
           text-align: center;
           border-top: 2px solid #000;
           border-bottom: 2px solid #000;
       }
       .body1 {
           /* padding-top: 10px; */
           width: 100%;
           font-size: 11px;
           text-align: center;
       }

       .body1 th{
           border-top: 1px solid #000;
           border-bottom: 1px solid #000;
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
    @foreach ($datas as $key=> $data)
        <header>
            <div class="title1">
                E-DISTRIBUTION
            </div>
            <div class="title2">
                Return
            </div>
            <div class="title3">
                (FLOWRACK)
            </div>
        </header>
        
        <table class="head1">
            
            <tr>
                <td >Store Name :</td><td>{{ $data['store_name'] }}</td>
                <td>SO No. :</td><td>{{ $data['so_no'] }}</td>
            </tr>
            <tr>
                <td>Customer :</td><td>{{ $data['acct_code'] }} - {{ $data['acct_name'] }}</td>
                <td>SO Date :</td><td>{{ $data['date_req'] }}</td>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="body1" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>UOM</th>
                                <th>Amt</th>
                                <th>Total Amt</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                            @foreach ($data['customer_order'] as $datas1)
                            @if ($data['acct_code'] == $datas1['acct_code'])
                            <tr>
                                <td>{{ $datas1['itemcode'] }}</td>
                                <td>{{ $datas1['product_name'] }}</td>
                                <td>{{ $datas1['qty_for_delivery'] }}</td>
                                <td>{{ $datas1['product_uom'] }}</td>
                                <td><span style="font-family: DejaVu Sans;">&#8369;</span> {{ $datas1['amt'] }}</td>
                                <td><span style="font-family: DejaVu Sans;">&#8369;</span> {{ $datas1['total_amt'] }}</td>
                            </tr>
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
                            <td></td>
                            <td width="20%" style="font-weight: bold; text-align: right;">Quantity(Total in QTY)>>></td>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $data['tot_qty'] }}</td>
                            <td style="font-weight: bold; text-align: left;">Total Amount >>>&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-family: DejaVu Sans;">&#8369;</span> {{ $data['total_amt2'] }}</td>
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
                            <td>Checked By:</td>
                        </tr>
                        <tr>
                            <td>_____________________</td>
                            <td>_____________________</td>
                            <td>_____________________</td>
                        </tr>
                        <tr>
                            <td>Signature over Printed name</td>
                            <td>Signature over Printed name</td>
                            <td>Signature over Printed name</td>
                        </tr>
                        <tr>
                            <td>Date: ____________</td>
                            <td>Date: ____________</td>
                            <td>Date: ____________</td>
                        </tr>
                        <tr>
                            <td>Time: ____________</td>
                            <td>Time: ____________</td>
                            <td>Time: ____________</td>
                        </tr>
                        <tr>
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
                            <td width="30%">Distribution App System - Local</td>
                            <td width="80%">Note: This Document is not valid without complete signatory</td>
                        </tr>
                        <tr>
                            <td>Run Date: {{ $data['date_now'] }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="page-break"></div>
        @endforeach
    

    
</body>
</html>