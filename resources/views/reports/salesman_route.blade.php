<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Salesman Route</title>
    <style media="screen">
        body {
            font-family: 'Segoe UI','Microsoft Sans Serif',sans-serif;
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
           font-size: 12px;

       }

       .head1 th{
            font-weight: bold;
            font-size: 13px;
            
       }

       .endt {
           /* padding-top: 10px; */
           width: 100%;
           font-size: 11px;
           text-align: center;
           
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
           margin-top: 30px;
           width: 100%;
           text-align: center;
           padding: 8px;
           border-bottom: 1px solid #000;
       }

       .body1 th{
           /* border-top: 1px solid #000; */
           border-bottom: 1px solid #000;
           font-size: 13px;
           padding: 10px;
       }
       .body1 td{
           padding: 12px;
           line-height: 1.42857143;
           border-top: 1px solid rgba(0, 0, 0, 0.378);
           border-top-style: dashed;
           font-size: 12px;
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

        .bord-no {
            border: 0 !important;
        }

        .new-section-sm {
            margin: 25px 0;
            min-height: 1px;
        }

        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border: 0;
            border-top: 1px solid #eee;
            border-color: rgba(0, 0, 0, 0.07);
        }

        .text-bold {
            font-weight: 700;
            color: #7a878e;
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
 
        <header> 
            {{-- <div class="title2">
                Salesman Route
            </div> --}}
        </header>
        
        <table class="head1">
                
                <tr>
                    <th width="15%" style="text-align: right;">Salesman :</th>
                    <td width="50%"> [{{$data['salesman_code']}}] - {{ $data['first_name'] . ' ' .  $data['last_name']}}</td>
                    <th width="15%">Contact No :</th>
                    <td width="10%" style="text-align: right;"> 09123123123</td>
                </tr>
                <tr>
                    <th width="15%" style="text-align: right;">Hepe de Viaje :</th>
                    <td width="50%">[{{$data['hepe_code']}}] - {{ $data['hepe_firstname'] . ' '. $data['hepe_lastname'] }}</td>
                    {{-- <td width="20%">Account Code :</td>
                    <td width="25%" style="text-align: right;">{{ $data['acct_code'] }}</td> --}}
                </tr>
            <tr>
                <td colspan="4">
                    <table class="body1" cellspacing="0">
                        <thead>
                            <tr>
                                <th colspan="4">WEEKLY SCHEDULE OF ROUTE - NEIGHBORING</th>
                            </tr>
                            <tr>
                                <th width="25%">Town</th>
                                <th width="25%">Booking Day Schedule</th>
                                <th width="25%">Batch No</th>
                                <th width="25%">Delivery Day</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['datas'] as $row) 
                           <tr>
                               <td>{{$row}}</td>
                               <td>Monday</td>
                               <td>{{$data['batch_no']}}</td>
                               <td>Wednesday</td>
                           </tr>
                           <tr>
                               <td>0</td>
                               <td>Tuesday</td>
                               <td>0</td>
                               <td>Thursday</td>
                           </tr>
                           <tr>
                               <td>0</td>
                               <td>Wednesday</td>
                               <td>0</td>
                               <td>Friday</td>
                           </tr>
                           <tr>
                               <td>0</td>
                               <td>Thursday</td>
                               <td>0</td>
                               <td>Saturday</td>
                           </tr>
                           <tr>
                               <td>0</td>
                               <td>Friday</td>
                               <td>0</td>
                               <td>Monday</td>
                           </tr>
                           <tr>
                               <td>0</td>
                               <td>Saturday</td>
                               <td>0</td>
                               <td>Tuesday</td>
                           </tr>
                           @endforeach

                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <div class="page-break"></div>
        @endforeach
</body>
</html>