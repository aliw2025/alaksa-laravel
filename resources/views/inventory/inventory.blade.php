@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Inventory</h4>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row ">
                   
                        <div  id="DataTables_Table_0_wrapper" class="col-12 table-responsive dataTables_wrapper dt-bootstrap5 no-footer">
                            <table class="datatables-basic table dataTable no-footer dtr-column" id="investor-table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">
                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Make</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">quantity</th>
                                        <th scope="col">Worth</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="set-iems-body" id="set-iems-body">

                                    <tr>
                                        <td>1</td>
                                        <td>Infinix hot 10</td>
                                        <td>Mobiles phones</td>
                                        <td>Infinix</td>
                                        <td>hot 10</td>
                                        <td>20</td>
                                        <td>10,000 PKR</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <form class=""  autocomplete="on">
                                                    <button style="border:0ch;background-color:white !important;" id="" type="submit" class=""><i data-feather='trash-2'></i></button>
                                                </form>
                                                <form class=""  autocomplete="on">
                                                    <button style="border:0ch;background-color:white !important;" id="" type="submit" class=""><i data-feather='edit'></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Infinix hot 10</td>
                                        <td>Mobiles phones</td>
                                        <td>samsung</td>
                                        <td>hot 10</td>
                                        <td>20</td>
                                        <td>10,000 PKR</td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <form class=""  autocomplete="on">

                                                    <button style="border:0ch;background-color:white !important;" id="" type="submit" class=""><i data-feather='trash-2'></i></button>
                                                </form>
                                                <form class="" autocomplete="on">

                                                    <button style="border:0ch;background-color:white !important;" id="" type="submit" class=""><i data-feather='edit'></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Infinix hot 10</td>
                                        <td>Mobiles phones</td>
                                        <td>Infinix</td>
                                        <td>hot 10</td>
                                        <td>20</td>
                                        <td>10,000 PKR</td>
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <form class="" autocomplete="on">

                                                    <button style="border:0ch;background-color:white !important;" id="" type="submit" class=""><i data-feather='trash-2'></i></button>
                                                </form>
                                                <form class=""  autocomplete="on">

                                                    <button style="border:0ch;background-color:white !important;" id="" type="submit" class=""><i data-feather='edit'></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $(document).ready(function() {
            $('#investor-table').DataTable();
        });

    });
</script>
@endsection