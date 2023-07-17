<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sale Invoice</title>

    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
        }
        .detail_row {
            
            border: 1px solid #ddd;
            width:50%;
            text-align: left;
            
        }
        th,
        td {
            padding: 8px;
            /* text-align: center; */
            /* border: 1px solid #ddd; */
            font-size: 12px;
        }

        .invoice_tab td {
            text-align: center;
        }
    </style>

</head>

<body style="margin-bottom: 0;margin-top: 0">
    <h2 style="margin-top: 0; margin-bottom: 0;text-align:center">Alpha Digital</h2>
    <p style="margin-top: 2; margin-bottom: 0;text-align:center">Contact: 03477844223, Email: info@alpha.edu.com</p>
    <p style="margin-top: 2; margin-bottom: 0;text-align:center">Address: Mustafa Plaza , Ring Road Peshawar</p>
    <table style="margin-bottom: 0;margin-top: 10px">
        <tr>
            <td align="left" style="border-top:1px solid;border-bottom:1px solid;">
                <p style="text-align:center;margin-top:0;margin-bottom:0">Sale Invoice</p>
            </td>
        </tr>

    </table>
    <h4 style="text-align: center;margin-top: 0;margin-bottom: 0">{{ !is_null($sale) ? $sale->inv_status : '' }}</h4>
    <table width="100%">
        <tr>
            <td><strong>Invoice #:</strong> {{ !is_null($sale) ? $sale->invoice_no : '' }}</td>
            <td style="text-align: right;"><strong>Invoice Date :</strong> {{ !is_null($sale) ? $sale->sale_date : '' }}
            </td>
        </tr>
        <tr>
            <td><strong>Customer Name:</strong>
                {{ !is_null($sale) ? $sale->customer->customer_name : '' }}</td>

        </tr>
        <tr>
            <td><strong>Payment Type :</strong> {{ $payment_type }}</td>
            <td></td>
        </tr>
    </table>
    <br />

    <table class="invoice_tab">
        <thead>
            <tr style="background-color:#e4e6eb;">
                <th>#</th>
                <th>Item Id</th>
                <th>Item</th>
                <th>Plan (Months)</th>
                <th>Mark Up</th>
                <th>Selling Price</th>

            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            <tr>
                <td>1</td>
                <td> {{ $sale->item->id }}</td>
                <td> {{ $sale->item->name }}</td>
                <td> {{ $plan }}</td>
                <td> {{ $markup }}%</td>
                <td> {{ number_format($sale->selling_price) }}</td>

            </tr>
            <tr style="margin-bottom:0;margin-top:0">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p> <span style="font-weight: bold"> Total Amount: </span> {{ number_format($sale->total) }}</p>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom: 0;margin-top: 10px">
        <tr>
            <td align="left" style="border-top:1px solid;border-bottom:1px solid;">
                <p style="text-align:center;margin-top:0;margin-bottom:0">Item Details</p>
            </td>
        </tr>

    </table>
    <table  class="invoice_tab">
        <tr>
            <td style="text-align: left"  >Name : {{ $sale->item->name }}</td>
            <td style="text-align: left"  >Seriel /IMEA # : {{ $sale->seriel_no }}</td>
            <td  style="text-align: left" >Make : {{ $sale->item->make }}</td>
            <td  style="text-align: left" >Model : {{ $sale->item->make }}</td>
        <tr>
            @foreach ($sale->item->propertyValues as $prop)
            <td style="text-align: left" >{{ $prop->propertyName->property_name }} : {{ $prop->prop_value }}</td>
            @endforeach
            
        </tr>

        </tr>
    </table>
    <table style="margin-bottom: 0;margin-top: 10px">
        <tr>
            <td align="left" style="border-top:1px solid;border-bottom:1px solid;">
                <p style="text-align:center;margin-top:0;margin-bottom:0">Payment details</p>
            </td>
        </tr>

    </table>
    <table  class="invoice_tab">
        <tr style="background-color:#e4e6eb;">
            <th>#</th>
            <th>Instalment no</th>
            <th>instalment id</th>
            <th>payment no</th>
            <th>Amound paid</th>
            <th>date</th>
           
        </tr>

            <tr>
                <td>1</td>
                <td>{{$ins->instalment->instalment_no}}</td>
                <td>{{$ins->instalment->id}}</td>
                <td>{{$ins->id}}</td>
                <td>{{$ins->amount}}</td>
                <td>{{date('d-m-Y', strtotime($ins->payment_date))}}</td>
            </tr>
           

    </table>

</body>

</html>
