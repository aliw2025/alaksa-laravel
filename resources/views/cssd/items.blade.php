@extends('template.header')
@section('section')

    <div class="content-wrapper">

        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-12 ">
                        <h3 class="my-1">Items</h3>
                        <table id="items-table" class="table">
                            <thead class="thead-dark">
                                <tr style="background-color:red !important;">
                                    <th scope="col">Item Id</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tbodya" id="tbodya">

                            </tbody>

                        </table>

                        <table class="table">
                            <th scope="row"></th>
                            <td style="width:33%"> <input id="enterName" name="name" type="text" class="form-control"
                                    id="exampleInputEmail1" placeholder="Item name"></td>
                            <td style="width:33%"> <button id="btnSave" type="submit"
                                    class="btn btn-primary">Save</button></td>
                        </table>

                    </div>
                    <div class="container d-flex justify-content-center mt-1 mb-1">
                        {{-- {{ $items->onEachSide(5)->links() }} --}}
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
    
<script src="{{ url('/resources/js/scripts/pages/add-item.js') }}"></script>


@endsection
