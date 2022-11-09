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
                <p style = "text-align:center;margin-top:0;margin-bottom:0">Sale Invoice</p>
            </td>  
        </tr>

    </table>
    <h4 style="text-align: center;margin-top: 0;margin-bottom: 0">{{ !is_null($sale) ? $sale->inv_status : '' }}</h4>
    <table width="100%">
        <tr>
            <td ><strong>Invoice #:</strong> {{ !is_null($sale) ? $sale->invoice_no : '' }}</td>
            <td style="text-align: right;"><strong>Invoice Date :</strong> {{ !is_null($sale) ? $sale->sale_date : '' }}
            </td>
        </tr>
        <tr >
            <td ><strong>Customer Name:</strong>
                {{ !is_null($sale) ? $sale->customer->customer_name : '' }}</td>
            <td  style="text-align: right;"><strong>Investor :</strong> {{ $sale->investor->investor_name }}</td>
        </tr>
        <tr>
            <td ><strong>Payment Type :</strong> {{ $payment_type }}</td>
            <td></td>
        </tr>
    </table>
    <br/>

    <table class="invoice_tab">
        <thead>
            <tr style="background-color:#e4e6eb;">
                <th>#</th>
                <th>Item Id</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Plan</th>
                <th>Mark Up</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            <tr>
                <td >1</td>
                <td> {{ $sale->item->id }}</td>
                <td> {{ $sale->item->name }}</td>
                <td> 1</td>
                <td> {{ $selling_price }}</td>
                <td> {{ $plan }}</td>
                <td> {{ $markup }}%</td>
            </tr>
            <tr style="margin-bottom:0;margin-top:0">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p> <span style="font-weight: bold"> Total Amount: </span>  {{ $sale->total }}</p>
                </td>
            </tr>
        </tbody>
    </table>

</body>
</html>
