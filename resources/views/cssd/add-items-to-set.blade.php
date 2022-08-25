@extends('template.header')
@section('section')
<div class="content-wrapper">

    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-12 ">
                    <h3 class="my-1">{{ $set->name }} set</h3>

                    <table id="items-table" class="table">
                        <thead class="thead-dark">
                            <tr style="background-color:red !important;">

                                <th scope="col">Item name</th>
                                <th scope="col">quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="set-iems-body" id="set-iems-body">
                            @foreach ($set->items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->pivot->quantity }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <form method="POST" action="{{ route('addItemToSet',$set->id) }}">
                        @csrf
                        <table class="table">

                            <td style="width:33%">
                                <input id="itemList" name="itemName" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Enter Item" onkeyup="getItems({{$set->id}})">

                                <!-- <datalist id="datalistOptions">
                                    @foreach($items as $item)

                                    <option value="{{$item->name}}">
                                        @endforeach
                                </datalist> -->
                                <div id ="list"  style="display:none;position:absolute" class="card mb-4">
                                    <ul id = "listBody" class="list-group list-group-flush">
                                        <!-- @foreach($items as $item)
                                        <a href="">
                                            <li class="list-group-item">{{$item->name}}</li>
                                        </a>
                                        @endforeach -->
                                    </ul>
                                </div>
                            </td>
                            <td style="width:33%"> <input id="quantity" name="quantity" type="text" class="form-control" id="exampleInputEmail1" placeholder="quantity">
                                <input type="hidden" name="itemId" value="{{ $item->id }}">

                            </td>

                            <td style="width:33%"> <button id="btnSave" type="submit" class="btn btn-primary">Add</button></td>

                        </table>
                    </form>
                    <!-- <ul class="search-list search-list-main ps ">
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                        </div>

                        <li>waseem</li>
                        <li>asim</li>
                    </ul> -->


                </div>


            </div>
        </div>
    </div>

</div>
@endsection

<script>
    function getItems(id) {
        var letters = $('#itemList').val();
        if(letters.length <2){
           
            return;
        }
       
        $.ajax({
        url: "{{route('get-matching-items',"+id+")}}",
        type: "GET",
        data:{
            key :letters,
        },
        success: function (dataResult) {
            $("#listBody").empty();
            var i;
            for (i = 0; i < dataResult.length; ++i) {
                // do something with `substr[i]`
                var item = dataResult[i];
                console.log(item.name);
                markup = ' <li id="item'+item.id+'" class="list-group-item" onClick="test('+item+')" >'+item.name+'</li>';
                $("#listBody").append(markup);    
            }
        },
        error: function (xhr, status, error) {

            var err = eval("(" + xhr.responseText + ")");
            console.log(err);
            alert(err);
        },
    });
        $("#list").show();
        console.log(letters);

    }
    function test(item) {
        
        console.log('waseem is king');
        $('itemList').val = iten.name;
    }


</script>