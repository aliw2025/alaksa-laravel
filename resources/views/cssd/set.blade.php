@extends('template.header')
@section('section')

    <div class="content-wrapper">

        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-12 ">
                        <h3 class="my-1">Items</h3>
                        <table id="sets-table" class="table">
                            <thead class="thead-dark">
                                <tr style="background-color:red !important;">
                                    <th scope="col">Item Id</th>
                                    <th scope="col">name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="SetTbody" id="SetTbody">

                            </tbody>

                        </table>

                        <table class="table">
                            <th scope="row"></th>
                            <td style="width:33%"> <input id="enterSetName" name="Setname" type="text" class="form-control"
                                    id="exampleInputEmail1" placeholder="set name"></td>
                            <td style="width:33%"> <button id="btnSaveSet" type="submit"
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
    
<script src="{{ url('/resources/js/scripts/pages/set.js') }}"></script>


@endsection
