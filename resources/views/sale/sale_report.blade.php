<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purchase Report</title>

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
                <p style="text-align:center;margin-top:0;margin-bottom:0">Purchase Reports</p>
            </td>
        </tr>

    </table>
    
    <br />


    
    <table  class="invoice_tab">
            
                <tr style="background-color:#e4e6eb;">
                    <th style="width: 2px !important">#</th>
                    <th scope="col">sale No</th>
                    <th>Total</th>
                    <th>status</th>
                    <th scope="col">Date</th>
                   
                </tr>
    
        <tbody class="inventory-iems-body" id="inventory-iems-body">
            @php
                $count = 1
            @endphp
            @foreach ($sales as $pur)

            <tr>
                <td>{{$count}}</td>
                <td>{{$pur->invoice_no}}</td>
                <td>{{ number_format( $pur->total)}}</td>
                <td>{{$pur->transaction_status->desc}}</td>
                <td>{{date('d-m-Y', strtotime($pur->sale_date))}}</td>
                <td><a style="text-decoration: none;color:black" href="{{route('purchase.show',$pur->id)}}"><i data-feather='eye'></i></a></td>
            </tr>
            @php
                $count = $count+1
            @endphp

            @endforeach
            <tr>
                <td colspan="2"></td>
                <td> <span style="font-weight: bold;">Total  :</span>  {{number_format( $sum)}}</td>

            </tr>
            
    
        </tbody>
</table>

</body>

</html>
