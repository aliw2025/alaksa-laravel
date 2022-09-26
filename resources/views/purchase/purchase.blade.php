@extends('template.header')
@section('section')
    <div class="content-wrapper container-xxl p-0">

        <div class="content-body">
            <section class="invoice-add-wrapper">
                <div class="row invoice-add">
                    <!-- Invoice Add Left starts -->
                    <div class="col-xl-9 col-md-8 col-12">
                        <div class="card invoice-preview-card">
                            <!-- Header starts -->
                            <div class="card-body invoice-padding pb-0">
                                <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                    <div>
                                        <div class="logo-wrapper">

                                            <h3 class="text-primary invoice-logo">Alpha Digital</h3>
                                        </div>
                                        <p class="card-text mb-25">Office 149, 450 South Brand Brooklyn</p>
                                        <p class="card-text mb-25">San Diego County, CA 91905, USA</p>
                                        <p class="card-text mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                                        
                                    </div>
                                    <div class="invoice-number-date mt-md-0 mt-2">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <h4 class="invoice-title">Purchase</h4>
                                            <div class="input-group input-group-merge invoice-edit-input-group">
                                                <div class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-hash">
                                                        <line x1="4" y1="9" x2="20" y2="9">
                                                        </line>
                                                        <line x1="4" y1="15" x2="20" y2="15">
                                                        </line>
                                                        <line x1="10" y1="3" x2="8" y2="21">
                                                        </line>
                                                        <line x1="16" y1="3" x2="14" y2="21">
                                                        </line>
                                                    </svg>
                                                </div>
                                                <input type="text" class="form-control invoice-edit-input"
                                                    placeholder="53634">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="title">Date:</span>
                                            <input type="text"
                                                class="form-control invoice-edit-input date-picker flatpickr-input"
                                                readonly="readonly">
                                        </div>
                                        <div  class="d-flex align-items-center justify-content-between">
                                            <span class="title">Investor:</span>
                                            <div style="width: 11.21rem; max-width:11.21rem; " class="align-items-center"><select  class=" select2 select2-hidden-accessible form-control invoice-edit-input" id="select2-basic" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                              <option value="AK" data-select2-id="2">Alaska</option>
                                              <option value="HI">Hawaii</option>
                                              <option value="CA">California</option>
                                              <option value="NV">Nevada</option>
                                              <option value="OR">Oregon</option>
                                              <option value="WA">Washington</option>
                                              <option value="AZ">Arizona</option>
                                             </select>
                                            {{--    <span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="1" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-select2-basic-container"><span class="select2-selection__rendered" id="select2-select2-basic-container" role="textbox" aria-readonly="true" title="Alaska">Alaska</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div> --}}
                                          </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-1">
                                            <span class="title">Supplier</span>
                                            <input type="text" class="form-control invoice-edit-input ">
                                        </div>
                                        {{-- <div class="d-flex align-items-center justify-content-between">
                                            <span class="title">Due Date:</span>
                                            <input type="text"
                                                class="form-control invoice-edit-input due-date-picker flatpickr-input"
                                                readonly="readonly">
                                        </div> --}}

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
                                                <div class="col-12 d-flex product-details-border position-relative pe-0">
                                                    <div class="row w-100 pe-lg-0 pe-1 py-2">
                                                        <div class="col-lg-3 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
                                                            <p class="card-text col-title mb-md-50 mb-0">Item</p>
                                                            <select class="form-select item-details">
                                                                @foreach( $items as $item)
                                                                <option value="item">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Cost</p>
                                                            <input type="text" class="form-control" value="24"
                                                                placeholder="24">
                                                        </div>
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Qty</p>
                                                            <input type="number" class="form-control" value="1"
                                                                placeholder="1">
                                                        </div>
                                                        <div class="col-lg-2 col-12 my-lg-0 my-2">
                                                            <p class="card-text col-title mb-md-2 mb-0">Discount</p>
                                                            <input type="number" class="form-control" value="1"
                                                                placeholder="1">
                                                        </div>
                                                        <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                                            <p class="card-text col-title mb-md-50 mb-0">Price</p>
                                                            <p class="card-text mb-0">PKR 24.00</p>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="
                    d-flex
                    flex-column
                    align-items-center
                    justify-content-between
                    border-start
                    invoice-product-actions
                    py-50
                    px-25
                  ">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                            height="14" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="feather feather-x cursor-pointer font-medium-3"
                                                            data-repeater-delete="">
                                                            <line x1="18" y1="6" x2="6"
                                                                y2="18"></line>
                                                            <line x1="6" y1="6" x2="18"
                                                                y2="18"></line>
                                                        </svg>
                                                        <div class="dropdown">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-settings cursor-pointer more-options-dropdown me-0"
                                                                id="dropdownMenuButton" role="button"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <circle cx="12" cy="12" r="3">
                                                                </circle>
                                                                <path
                                                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                                                </path>
                                                            </svg>
                                                            <div class="dropdown-menu dropdown-menu-end item-options-menu p-50"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <div class="mb-1">
                                                                    <label for="discount-input"
                                                                        class="form-label">Discount(%)</label>
                                                                    <input type="number" class="form-control"
                                                                        id="discount-input">
                                                                </div>
                                                                <div class="form-row mt-50">
                                                                    
                                                                   
                                                                </div>
                                                                <div class="dropdown-divider my-1"></div>
                                                                <div class="d-flex justify-content-between">
                                                                    <button type="button"
                                                                        class="btn btn-outline-primary btn-apply-changes waves-effect">Apply</button>
                                                                    <button type="button"
                                                                        class="btn btn-outline-secondary waves-effect">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-12 px-0">
                                            <button type="button"
                                                class="btn btn-primary btn-sm btn-add-new waves-effect waves-float waves-light"
                                                data-repeater-create="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-plus me-25">
                                                    <line x1="12" y1="5" x2="12" y2="19">
                                                    </line>
                                                    <line x1="5" y1="12" x2="19" y2="12">
                                                    </line>
                                                </svg>
                                                <span class="align-middle">Add Item</span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Product Details ends -->

                            <!-- Invoice Total starts -->
                            <div class="card-body invoice-padding">
                                <div class="row invoice-sales-total-wrapper">
                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                    
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                        <div class="invoice-total-wrapper">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Subtotal:</p>
                                                <p class="invoice-total-amount">PKR 1800</p>
                                            </div>
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Discount:</p>
                                                <p class="invoice-total-amount">PKR 28</p>
                                            </div>
                                            {{-- <div class="invoice-total-item">
                                                <p class="invoice-total-title">Tax:</p>
                                                <p class="invoice-total-amount">21%</p>
                                            </div> --}}
                                            <hr class="my-50">
                                            <div class="invoice-total-item">
                                                <p class="invoice-total-title">Total:</p>
                                                <p class="invoice-total-amount">PKR 1690</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoice Total ends -->

                            <hr class="invoice-spacing mt-0">

                            <div class="card-body invoice-padding py-0">
                                <!-- Invoice Note starts -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label for="note" class="form-label fw-bold">Note:</label>
                                            <textarea class="form-control" rows="2" id="note">It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice Note ends -->
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Add Left ends -->

                    <!-- Invoice Add Right starts -->
                    <div class="col-xl-3 col-md-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-primary w-100 mb-75 waves-effect waves-float waves-light"
                                    disabled="">Save</button>
                                {{-- <a href="app-invoice-preview.html"
                                    class="btn btn-outline-primary w-100 mb-75 waves-effect">Preview</a> --}}
                                <button type="button" class="btn btn-outline-primary w-100 waves-effect">Preview</button>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p class="mb-50">Selected Account</p>
                            <select class="form-select">
                                <option value="Bank Account">Bank Account</option>
                                <option value="Paypal">Paypal</option>
                                <option value="UPI Transfer">UPI Transfer</option>
                            </select>
                            <div class="invoice-terms mt-1">
                                
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Add Right ends -->
                </div>

                <!-- Add New Customer Sidebar -->
                <div class="modal modal-slide-in fade" id="add-new-customer-sidebar" aria-hidden="true">
                    <div class="modal-dialog sidebar-lg">
                        <div class="modal-content p-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close">×</button>
                            <div class="modal-header mb-1">
                                <h5 class="modal-title">
                                    <span class="align-middle">Add Customer</span>
                                </h5>
                            </div>
                            <div class="modal-body flex-grow-1">
                                <form>
                                    <div class="mb-1">
                                        <label for="customer-name" class="form-label">Customer Name</label>
                                        <input type="text" class="form-control" id="customer-name"
                                            placeholder="John Doe">
                                    </div>
                                    <div class="mb-1">
                                        <label for="customer-email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="customer-email"
                                            placeholder="example@domain.com">
                                    </div>
                                    <div class="mb-1">
                                        <label for="customer-address" class="form-label">Customer Address</label>
                                        <textarea class="form-control" id="customer-address" cols="2" rows="2"
                                            placeholder="1307 Lady Bug Drive New York"></textarea>
                                    </div>
                                    <div class="mb-1 position-relative">
                                        <label for="customer-country" class="form-label">Country</label>
                                        <select class="form-select select2-hidden-accessible" id="customer-country"
                                            name="customer-country" data-select2-id="customer-country" tabindex="-1"
                                            aria-hidden="true">
                                            <option label="select country" data-select2-id="2"></option>
                                            <option value="Australia">Australia</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United States of America">United States of America</option>
                                        </select><span class="select2 select2-container select2-container--default"
                                            dir="ltr" data-select2-id="1" style="width: auto;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--single" role="combobox"
                                                    aria-haspopup="true" aria-expanded="false" tabindex="0"
                                                    aria-disabled="false"
                                                    aria-labelledby="select2-customer-country-container"><span
                                                        class="select2-selection__rendered"
                                                        id="select2-customer-country-container" role="textbox"
                                                        aria-readonly="true"><span
                                                            class="select2-selection__placeholder">Select
                                                            country</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                    <div class="mb-1">
                                        <label for="customer-contact" class="form-label">Contact</label>
                                        <input type="number" class="form-control" id="customer-contact"
                                            placeholder="763-242-9206">
                                    </div>
                                    <div class="mb-1 d-flex flex-wrap mt-2">
                                        <button type="button"
                                            class="btn btn-primary me-1 waves-effect waves-float waves-light"
                                            data-bs-dismiss="modal">Add</button>
                                        <button type="button" class="btn btn-outline-secondary waves-effect"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Add New Customer Sidebar -->
            </section>

        </div>
        <div class="card mb-4">
            <div class="card-body">
                
            <div class="row"></div>
         
            
        </div>
    </div>
    <script src="{{ url('/resources/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ url('/resources/js/scripts/forms/form-select2.min.js') }}"></script>
    <script src="{{ url('/resources/js/scripts/pages/app-invoice.min.js') }}"></script>
    <script>
        $(document).ready(function(){
          
            // $('.select2-selection__arrow').hide();
        });
    </script>
@endsection
