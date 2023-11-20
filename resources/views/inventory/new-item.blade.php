@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-md-9 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Items</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <div class="col-12 table-responsive">
                            <table id="investor-table" class="table">
                                <thead class="thead-dark">
                                    <tr style="background-color:red !important;">

                                        <th style="width: 2px !important">#</th>
                                        <th scope="col">Item id</th>
                                        <th scope="col">Item name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Make</th>

                                        <th scope="col">Model</th>
                                        <th scope="col">Action</th>

                                        {{-- <th scope="col">Supplier</th> --}}
                                    </tr>
                                </thead>
                                <tbody class="set-iems-body" id="set-iems-body">
                                    @php
                                    $count = 1;
                                    @endphp
                                    @if (isset($items))
                                    @foreach ($items as $i)
                                    <tr>
                                        <th style="width: 2px !important">{{ $count }}</th>
                                        <td>{{ $i->id }}</td>
                                        <td>{{ $i->name }}</td>
                                        <td>{{ $i->Category->category_name?? ""  }}</td>
                                        <td>{{ $i->make }}</td>
                                        <td>{{ $i->model }}</td>
                                        {{-- <td>{{ $item->Supplier }}</td> --}}
                                        <td>
                                            <div class="d-flex align-items-center">

                                                <form class="" method="POST" autocomplete="on" action="{{ route('item.destroy', $i->id) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button style="border:0ch;background-color:white !important;" id="btnDel{{ $i->id }}" type="submit" class=""><i data-feather='trash-2'></i></button>
                                                </form>
                                                <form class="" method="GET" autocomplete="on" action="{{ route('item.edit', $i->id) }}">
                                                    @csrf
                                                    {{ method_field('GET') }}
                                                    <button style="border:0ch;background-color:white !important;" id="btnDel{{ $i->id }}" type="submit" class=""><i data-feather='edit'></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        @php
                                        $count = $count + 1;
                                        @endphp
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <div>
                        <h4 class="text-center">{{ isset($item) ? 'Update item' : 'Add New item' }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if (isset($item))
                    <div class="d-flex justify-content-end">
                        <div>
                            <a href='{{ route('item.index') }}'" type=" reset" class="">
                                Add New
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="">
                        <form method="POST" class="form form-vertical" autocomplete="on" action=" {{ isset($item) ? route('item.update', $item) : route('item.store') }}">
                            @csrf
                            <div class="mb-1">
                                <label class="form-label" for="first-name-vertical">item Name</label>
                                <input value="{{ old('name', isset($item) ? $item->name : '') }}" type="text" id="itemName" class=" @error('name') is-invalid @enderror form-control" name="name" placeholder="item Name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-1">
                                <label class="form-label" for="first-name-vertical">make</label>
                                <input value="{{ old('make', isset($item) ? $item->make : '') }}" type="text" id="cateogoryName" class=" @error('make') is-invalid @enderror form-control" name="make" placeholder="make">
                                @error('make')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-1">
                                <label class="form-label" for="first-name-vertical">model</label>
                                <input value="{{ old('model', isset($item) ? $item->model : '') }}" type="text" id="cateogoryName" class=" @error('model') is-invalid @enderror form-control" name="model" placeholder="model">
                                @error('model')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- <div class="mb-1">
                                    <label class="form-label" for="first-name-vertical">supplier</label>
                                    @if (isset($item))
                                        <input
                                            value="{{ old('supplier', isset($item) ? (isset($item->supplier) ? $item->supplier->name : '') : '') }}"
                                            type="text" id="cateogoryName"
                                            class=" @error('supplier') is-invalid @enderror form-control"
                                            placeholder="supplier">
                                    @else
                                        <select class="form-control" name="supplier" id="">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif

                                    @error('supplier')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror


                                </div> -->

                            <div class="mb-1">
                                <label class="form-label" for="first-name-vertical">category</label>
                                <select name="category_id" class="form-select" id="cat_id">
                                    @foreach ($categories as $cat)
                                    @if(isset($item))
                                    @if($cat->id==$item->cat_id)
                                    <option value="{{ $cat->id }}" selected>{{ $cat->category_name }} </option>
                                    @else
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }} </option>
                                    @endif
                                    @else
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }} </option>
                                    @endif

                                    @endforeach

                                </select>
                            </div>

                            <div id="custom-feilds">
                                @if (isset($propertyValues))
                                @foreach ($propertyValues as $pv)
                                <label class="form-label" for="first-name-vertical">{{ $pv->prop_name }}</label>
                                <input value="{{ $pv->prop_value }}" type="text" class=" @error('model') is-invalid @enderror form-control" name="{{$pv->prop_id}}" placeholder="{{ $pv->prop_name }}">
                                @endforeach
                                @endif
                            </div>

                            <div class="mt-2">
                                @if (isset($item))
                                {{ method_field('PUT') }}
                                @endif

                                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">{{ isset($item) ? 'Update' : 'Add' }}</button>
                                <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@if(Session::has('message'))
<script>
    $(document).ready(function() {
        toastr.success("{{Session::get('message')}}", "Success!", {
            closeButton: !0,
            tapToDismiss: !1,
            rtl: false
        });
    });
</script>
@endif
@if(Session::has('error'))
<script>
    $(document).ready(function() {
        toastr.error("{{ Session::get('error') }}", "Failed!", {
            closeButton: true,
            tapToDismiss: false,
            rtl: false
        });
    });
</script>
@endif
<script type="text/javascript">
    $(document).ready(function() {

        $(document).ready(function() {
            $('#investor-table').DataTable();
        });

    });
    $('#cat_id').on('change', function() {

        var cat_id = this.value;

        $.ajax({
            url: "{{ url('get-properties') }}/" + cat_id,
            type: "GET",

            success: function(dataResult) {
                var section = $("#custom-feilds");
                section.empty();
                console.log('recv');
                console.log(dataResult);
                for (i = 0; i < dataResult.length; i++) {
                    var prop = dataResult[i];
                    // value="{{ old('model', isset($item) ? $item->model : '') }}"
                    var markup = `<label class="form-label" for="first-name-vertical">` + prop
                        .property_name + `</label>` +
                        ` <input  type="text"
                                class=" @error('model') is-invalid @enderror form-control"
                                name="` + prop.id + `" placeholder="` + prop.property_name + `">`
                    section.append(markup);
                }


            },
            error: function(xhr, status, error) {

                var err = eval("(" + xhr.responseText + ")");
                console.log(err);
                alert(err);
            },
        });


    });
</script>
@endsection