<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Supplier Payment Invoice</title>

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
                <p style="text-align:center;margin-top:0;margin-bottom:0">Supplier Payment Invoice</p>
            </td>
        </tr>

    </table>
    <h4 style="text-align: center;margin-top: 0;margin-bottom: 0">{{ !is_null($supplierPayment) ? $supplierPayment->transaction_status->desc : '' }}</h4>
    <table width="100%">
        <tr>
            <td><strong>Invoice #:</strong> {{ !is_null($supplierPayment) ? $supplierPayment->payment_no : '' }}</td>
            <td style="text-align: right;"><strong>Invoice Date :</strong> {{ !is_null($supplierPayment) ? $supplierPayment->payment_date : '' }}
            </td>
        </tr>
        <tr>
            <td><strong>Supplier Name:</strong>
                {{ !is_null($supplierPayment) ? $supplierPayment->supplier_val->name : '' }}</td>

        </tr>
        <!-- <tr>
            <td><strong>Payment Type :</strong> </td>
            <td></td>
        </tr> -->
    </table>
    <br />

    <table class="invoice_tab">
        <thead style="width: 100%;">
            <tr style="background-color:#e4e6eb;width: 100%">
                <th >#</th>
                <th></th> 
                <th></th> 
                <th></th>  
                <th></th> 
                <th></th> 
                <th></th>  
                <!-- <th>Desc</th>  -->
                <th>Amount </th>

            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <!-- <td>{{$supplierPayment->note}}</td> -->

                <td> {{ number_format($supplierPayment->amount) }}</td>

            </tr>
            <tr style="margin-bottom:0;margin-top:0">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <p> <span style="font-weight: bold"> Total Amount: </span> {{ number_format($supplierPayment->amount) }}</p>
                </td>
            </tr>
        </tbody>
    </table>
    
</body>

</html>
