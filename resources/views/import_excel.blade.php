<!DOCTYPE html>
<html>
    <head>
        <meta name="robots" content="noindex" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Import Item Masterfile</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Styles -->       
    </head>
    <body>
        <div class="container">
            <h3 align="center">Upload Item Masterfile</h3>
            <br/>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    Upload Validation Error<br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{ $message }}</strong>
            </div>
            @endif

            <form method="post" enctype="multipart/form-data" action="{{ url('/import_excel/import') }}" >
                {{ csrf_field() }}
                <div class="form-group">
                    <table class="table">
                        <tr>
                            <td width="40%" align="right"><label>Select File for Upload</label></td>
                            <td width="30"><input type="file" name="select_file" /></td>
                            <td width="30%" align="left"><input type="submit" name="upload" class="btn btn-primary" value="Upload" /></td>
                        </tr>
                        <tr>
                            <td width="40%" align="right"></td>
                            <td width="30"><span class="text-muted">.xls, .xslx</span></td>
                            <td width="30%" align="left"></td>
                        </tr>
                    </table>
                </div>
            </form>

            <br/>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Item Masterfile</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Product Name</th>
                                <th>Product Short Name</th>
                                <th>Description</th>
                                <th>Company</th>
                                <th>Item Code</th>
                                <th>Barcode</th>
                                <th>Brand</th>
                                <th>Principal</th>
                                <th>Product Family</th>
                                <th>Keywords</th>
                                <th>UOM</th>
                                <th>List Price w/o Tax</th>
                                <th>List Price w/ Tax</th>
                                <th>Conversion Qty</th>
                                <th>Conversion Uom</th>
                            </tr>
                                @foreach($data as $row)
                            <tr>
                                <td>{{ $row->product_name }}</td>
                                <td>{{ $row->product_shrt_name }}</td>
                                <td>{{ $row->description }}</td>
                                <td>{{ $row->company_code }}</td>
                                <td>{{ $row->itemcode }}</td>
                                <td>{{ $row->barcode }}</td>
                                <td>{{ $row->brand }}</td>
                                <td>{{ $row->principal }}</td>
                                <td>{{ $row->product_family }}</td>
                                <td>{{ $row->keywords }}</td>
                                <td>{{ $row->uom }}</td>
                                <td>{{ $row->list_price_wouttax }}</td>
                                <td>{{ $row->list_price_wtax }}</td>
                                <td>{{ $row->conversion_qty }}</td>
                                <td>{{ $row->conversion_uom }}</td>
                            </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
