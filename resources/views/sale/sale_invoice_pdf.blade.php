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

        th, td {
            padding: 8px;
            /text-align: center;/
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
    </style>

</head>
<body style="margin-bottom: 0;margin-top: 0">

<table style="margin-bottom: 0;margin-top: 0" >
    <tr>
        <td align="left" style="font-size: 20px">
            <h4>Sale Invoice</h4>
        </td>
        <td align="right" style="font-size: 20px">
            <h4 style="margin-top: 0; margin-bottom: 0;">Alpha Digital</h4>
        </td>
    </tr>

</table>
<h4 style="text-align: center;margin-top: 0;margin-bottom: 0">{{ !is_null($sale) ? $sale->inv_status : '' }}</h4>
<table  width="100%">
    <tr>
        <td style="border-bottom:0"><strong>Invoice #:</strong> {{ !is_null($sale) ? $sale->invoice_no : '' }}</td>
        <td style="border-bottom:0"><strong>Invoice Date :</strong> {{ !is_null($sale) ? $sale->sale_date : '' }}</td>
        

    </tr>
    <tr style="border-bottom:0">
        <td style="border-bottom:0"><strong>Customer Name:</strong> {{ !is_null($sale) ? $sale->customer->customer_name : '' }}</td>
       <td style="border-bottom:0"><strong>Investor :</strong> {{$sale->investor->investor_name}}</td>
    </tr>
    <tr>
        <td style="border-bottom:0"><strong>Payment Type :</strong> {{ $payment_type}}</td>
    </tr>


</table>

<br/>

<table>
    <thead>
    <tr style="background-color:#e4e6eb;">
        <th >#</th>
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
        <td>1</td>
        <td> {{$sale->item->name}}</td>
        <td> 1</td>
        <td> {{$selling_price}}</td>
        <td> {{$plan}}</td>
        <td> {{$markup}}%</td>
       
    </tr>
    {{-- @foreach ($sale_detail as $item)
        <tr>
            <td>{{ $counter }}</td>
            <td>{{ $item->item }}</td>
            <td>{{ $item->batch->batch_no }}</td>
            <td style="text-align: center">{{ date('d-m-Y', strtotime($item->batch->date)) }}</td>
            <td style="text-align: center">{{ $item->qty }}</td>
            <td style="text-align: center">{{ $item->price }}</td>
            <td style="text-align: center">{{ $item->qty * $item->price  }}</td>
            <td style="text-align: center">{{ $item->discount }}</td>
            <td style="text-align: center">{{ $item->after_discount }}</td>
            <td style="text-align: center">{{ $item->sales_tax }}</td>
            <td style="text-align: center">{{ $item->adv_tax }}</td>
            <td style="text-align: right">{{ $item->line_total }}</td>
        </tr>
        @php $counter++ @endphp
    @endforeach --}}
    {{-- @php
        $subTotal = 0;
        $totalDiscount = 0;
        $get_order_details = DB::table('sale_invoice_details')
            ->where('sale_invoice_detail_id', $sale->id)
            ->get();
    @endphp
    @foreach ($get_order_details as $row)
        @php
            $subTotal = $subTotal + $row->line_total;
        @endphp
    @endforeach --}}
    <tr style="margin-bottom:0;margin-top:0">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <h4>Total: {{$sale->total}}</h4>
        </td>
        {{-- <td style="text-align: center">
            <h4>...</h4>
        </td>
        <td style="text-align: center">
            <h4>...</h4>
        </td>
        <td></td>
        <td style="text-align: center">
            <h4>...</h4>
        </td>
        <td style="text-align: center">
            <h4>...</h4>
        </td>
        <td style="text-align: center">
            <h4>...</h4>
        </td>
        <td style="text-align: center">
            <h4>...</h4>
        </td>
        <td class="border-0 text-end">
            <h4 style="text-align: right">...</h4>
        </td> --}}
    </tr>
    {{-- <tr style="margin-top: 0;margin-bottom: 0">
        <td colspan="11" style="border-bottom:none">
            <h4 style="text-align: right">Freight</h4>
        </td>
        <td colspan="12" style="border-bottom:none">
            <h4 style="text-align: right">...</h4>
        </td>
    </tr>
    <tr style="margin-top: 0;margin-bottom: 0ho">
        <td colspan="11" style="border-bottom:none">
            <h4 style="text-align: right">Gross Total</h4>
        </td>
        <td colspan="12" style="border-bottom:none">
            <h4 style="text-align: right">...</h4>
        </td>
    </tr> --}}
    </tbody>
</table>
{{-- <div style="display:flex;flex-direction:row;margin-top: 2%">
    <div style="float:left" >
        <div style="text-align: right;margin-bottom:0;margin-top:0;width: 50%">...</div>
        <div style="text-align: center">_______</div>
        <div style="text-align: center">Created By</div>
    </div>
    <div style="float:right">
        <div style="text-align: right;margin-bottom:0;margin-top:0;width: 50%">...</div>
        <div style="text-align: center;margin-bottom:0;margin-top:0;">_______</div>
        <div style="text-align: center;margin-bottom:0;margin-top:0;">Post By</div>
    </div> --}}
</div>

</div>

</body>
</html>