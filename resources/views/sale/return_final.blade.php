

@extends('template.header')
@section('section')
<div class="content-wrapper" id="content-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h4 class="">Return Adjustments</h4>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-6">
                            <label class="mt-1" for="" >take back from investor </label>
                            <input type="text"  class="form-control" value="{{ number_format($cash_back_investor)}}">
                            <label class="mt-1" for="" >take back from alp </label>
                            <input type="text"  class="form-control" value="{{ number_format($cash_back_company)}}">
                            <label class="mt-1" for="" >investor will receive </label>
                            <input type="text"  class="form-control" value="{{ number_format($give_to_investor)}}">
                            <label class="mt-1" for="" >alp recived </label>
                            <input type="text"  class="form-control" value="{{ number_format($give_to_company)}}">
                        </div>
                        <div class="col-6">
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_type" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                <option value="4">
                                    Bank
                                 </option>

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_type" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                <option value="4">
                                    Bank
                                 </option>

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_type" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                <option value="4">
                                    Bank
                                 </option>

                            </select>
                            <label class="mt-1" for="" >Select Account </label>
                            <select id="acc_type" name="acc_type" class="form-select ">
                                <option value="1">
                                   cash
                                </option>
                                <option value="4">
                                    Bank
                                 </option>

                            </select>
                        

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="mt-1 btn btn-primary"> Save</button>

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