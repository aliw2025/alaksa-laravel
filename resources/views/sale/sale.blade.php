@extends('template.header')
@section('section')
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <section class="invoice-add-wrapper">
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <form class="" method="POST" autocomplete="on" action="{{ route('sale.store') }}">
                            <div class="card invoice-preview-card">
                                <!-- Header starts -->
                                <div class="card-body invoice-padding pb-0">
                                    <div
                                        class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                        <div>
                                            <div class="logo-wrapper">
                                                <h3 class="ms-0 text-primary invoice-logo">Alpha Digital</h3>
                                            </div>
                                            <p class="card-text mb-25">Office 149,Mustafa plaza</p>
                                            <p class="card-text mb-25">Ring Road Peshawar, PK</p>
                                            <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                        </div>
                                        <div class="invoice-number-date mt-md-0 mt-2">
                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                @csrf
                                                <h4 class="invoice-title">Sale</h4>
                                                <div class="input-group input-group-merge invoice-edit-input-group">
                                                    <div class="input-group-text">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-hash">
                                                            <line x1="4" y1="9" x2="20"
                                                                y2="9">
                                                            </line>
                                                            <line x1="4" y1="15" x2="20"
                                                                y2="15">
                                                            </line>
                                                            <line x1="10" y1="3" x2="8"
                                                                y2="21">
                                                            </line>
                                                            <line x1="16" y1="3" x2="14"
                                                                y2="21">
                                                            </line>
                                                        </svg>
                                                    </div>
                                                    <input name="purchaseId" type="text"
                                                        class="form-control invoice-edit-input" placeholder="">
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center justify-content-between mb-1">
                                                <span class="title">Date:</span>
                                                <input name="payment_date" type="text"
                                                    class="form-control invoice-edit-input date-picker flatpickr-input"
                                                    readonly="readonly">
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="title">Investor:</span>
                                                <div style="width: 11.21rem; max-width:11.21rem; "
                                                    class="align-items-center">

                                                    <select name="investor_id"
                                                        class=" select2 select2-hidden-accessible form-control invoice-edit-input"
                                                        id="select2-basic" data-select2-id="select2-basic" tabindex="-1"
                                                        aria-hidden="true">

                                                        @foreach ($investors as $investor)
                                                            <option value="{{ $investor->id }}">
                                                                {{ $investor->investor_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <!-- Header ends -->
                                <hr class="invoice-spacing">
                                <!-- Product Details starts -->
                                <div class="card-body invoice-padding invoice-product-details">
                                    <form class="source-item">
                                        <div data-repeater-list="group-a">
                                            <div class="repeater-wrapper" data-repeater-item="">
                                                <div class="row">
                                                    <div class="col-12  product-details-border position-relative pe-0">
                                                        <div class="row py-2">
                                                            <div class="col-1 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">id</p>
                                                                <input disabled id="item_id" name="amount" type="number"
                                                                    class="form-control" value="" placeholder="id">
                                                            </div>
                                                            <div class="col-3 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Item Name</p>
                                                                <input onkeyup="getItems()" id="item_name" name="amount"
                                                                    type="text" class="form-control"
                                                                    placeholder="Item Name">
                                                                <div class="list-type" id="list"
                                                                    style="position: absolute; z-index: 1;"
                                                                    class="card mb-4">
                                                                    <div id="listBody" class="list-group">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Selling Price
                                                                </p>
                                                                <input onkeyup="calculateInstallments()" id="selling_price" name="amount" type="number"
                                                                    class="form-control" value=""
                                                                    placeholder="Selling Price">
                                                            </div>
                                                            <div class="col-2 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">Plan</p>
                                                                <input onkeyup="calculateInstallments()" id="plan" name="amount" type="number"
                                                                    class="form-control" value=""
                                                                    placeholder="Months">
                                                            </div>
                                                            <div class="col-2 my-lg-0 my-2">
                                                                <p class="card-text col-title mb-md-2 mb-0">MarkUp</p>
                                                                <input onkeyup="calculateInstallments()" id="markup" name="amount" type="number"
                                                                    class="form-control" value="" placeholder="%">
                                                            </div>

                                                            {{-- <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                                <p class="card-text col-title mb-md-50 mb-0">Total</p>
                                                                <input
                                                                    style=" border: none;background-color: transparent;resize: none;outline: none;"
                                                                    id="rowTotal0" name="rowTotal" class="form-control"
                                                                    value="0 PKR" disabled>
                                                            </div> --}}

                                                        </div><s></s>

                                                    </div>
                                                </div>
                                                <div class="row mt-1">
                                                    <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                        <div class="row ">
                                                            <div class="col-6">
                                                                <p >Down Payment :</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p> 4</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                   

                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                        <div class="row ">
                                                            <div class="col-6">
                                                                <p >Instalments :</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p> 4</p>

                                                            </div>
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                <div class="row">
                                 
                                                    <div class="col-lg-5 col-12 mt-lg-0 mt-2">
                                                        <div class="row ">
                                                            <div class="col-6">
                                                                <p >Instalments per Month :</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p> 4000</p>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- Product Details ends -->


                                <!-- Invoice Total ends -->
                                <hr class="invoice-spacing mt-0">

                                <div class="card-body invoice-padding py-0">
                                    <!-- Invoice Note starts -->
                                    <div class="row">
                                        <div class="col-12">
                                            {{-- <div class="mb-2">
                                                <label for="note" class="form-label fw-bold">Note:</label>
                                                <textarea name="note" class="form-control" rows="2" id="note"></textarea>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <!-- Invoice Note ends -->
                                </div>
                                <div class="row p-2">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-2">Save</button>
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
            </section>
        </div>
    </div>

    <script src="{{ url('/resources/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ url('/resources/js/scripts/forms/form-select2.min.js') }}"></script>
    <script src="{{ url('/resources/js/scripts/pages/app-invoice.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2-selection__arrow').hide();
            $('#instal').text('name is khan');
        });

        function getItems() {

            console.log('function callled');

            var letters = $('#item_name').val();
            if (letters.length < 2) {
                return;
            }
            console.log(letters);
            var investor_id = $("#select2-basic").val();
            console.log(investor_id);
            $.ajax({
                url: "{{ route('get-investor-items') }}",
                type: "GET",
                data: {
                    key: letters,
                    investor_id: investor_id
                },
                success: function(dataResult) {
                    $("#listBody").empty();
                    console.log('recv');
                    console.log(dataResult);
                    var i;
                    for (i = 0; i < dataResult.length; i++) {
                        var item = dataResult[i].item;
                        console.log(item);
                        markup = `<button id = "btnItem` + item.id +
                            `" type="button" class="list-group-item list-group-item-action" onclick="setText(` +
                            item.id + `)">` + item.name + `</button>`;
                        $("#listBody").append(markup);
                    }
                },
                error: function(xhr, status, error) {

                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err);
                    alert(err);
                },
            });
            $("#list").show();

        }
        $(".content-wrapper").click(function(event) {

            var myClass = $(event.target).hasClass("list-group-item");
            if (myClass == true) {
                console.log("you clicked menu");

            } else {
                $(".list-type").hide();

            }
        });
        function calculateInstallments() {


            console.log('ddfdfdf');
            var sellingPrice = $('#selling_price').val();
            var plan = $('#plan').val();
            var markup = $('#markup').val();
            var finalPrice = ( parseFloat(sellingPrice) * (parseFloat(markup) /100))+parseFloat(sellingPrice);  
            var temp = finalPrice/plan;
            var len = temp.toString().length;
            var factor = Math.pow(10, len-1);
            var newtemp = Math.floor(temp/factor)*factor;
            console.log('un normalizedd');
            console.log(temp);
            console.log('normalizedd');
            console.log(newtemp);

            console.log('final selling price: ');
            console.log(finalPrice);
            
        }

        function setText(item) {

            console.log($('#item_name' + item).text());
            $("#item_name").val($('#btnItem' + item).text());
            $("#item_id").val(item);
            $("#list").hide();




        }
        $('#select2-basic').change(function() {
            
            $("#item_id").val("");
            $("#item_name").val("");


        });
    </script>
@endsection
