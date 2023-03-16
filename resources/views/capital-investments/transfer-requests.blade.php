@extends('template.header')
@section('section')
    <div class="content-wrapper" id="content-wrapper">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Pending</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Approved</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                            type="button" role="tab" aria-controls="contact" aria-selected="false">Cancelled</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table id="transfer-table" class="table">
                            <thead class="thead-dark">
                                <tr style="background-color:red !important;">
                                    <th style="width: 2px !important">#</th>
                                    <th scope="col">name</th>
                                    <th>from Account</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">To Account</th>
                                   
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="inventory-iems-body" id="nventory-iems-body">
                                @php
                                    $count = 1;
                                @endphp
                                
       
                                @foreach ($t_pending as $t)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $t->sender_account->owner->name }}</td>
                                        <td>{{ $t->sender_account->account_name }} |
                                            {{ $t->sender_account->account_number }} </td>
                                        <td>{{ number_format($t->amount) }} </td>
                                        <td>{{ $t->reciever_account->account_name }} |
                                            {{ $t->reciever_account->account_number }} </td>
                                       
                                        <td>
                                            @if($t->status ==0)
                                            <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('ro--transfer-approval')}}">
                                                @csrf
                                                <input type="hidden" name="tran_id" value="{{$t->id}}" id="">
                                                <button type="submit" name="submit" value="approve"
                                                    class="btn btn-primary">Approve </button>
                                                <button type="submit" name="submit" value="cancel"
                                                    class="btn btn-danger">Cancel </button>
                                            </form>
                                            @endif

                                        </td>
                                    </tr>
                                    @php
                                        $count = $count + 1;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table id="transfer-table" class="table">
                            <thead class="thead-dark">
                                <tr style="background-color:red !important;">
                                    <th style="width: 2px !important">#</th>
                                    <th scope="col">name</th>
                                    <th>from Account</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">To Account</th>
                                     
                                </tr>
                            </thead>
                            <tbody class="inventory-iems-body" id="nventory-iems-body">
                                @php
                                    $count = 1;
                                @endphp
                                
       
                                @foreach ($t_appr as $t)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $t->sender_account->owner->name }}</td>
                                        <td>{{ $t->sender_account->account_name }} |
                                            {{ $t->sender_account->account_number }} </td>
                                        <td>{{ number_format($t->amount) }} </td>
                                        <td>{{ $t->reciever_account->account_name }} |
                                            {{ $t->reciever_account->account_number }} </td>
                                       
                                        <td>
                                            @if($t->status ==0)
                                            <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('ro--transfer-approval')}}">
                                                @csrf
                                                <input type="hidden" name="tran_id" value="{{$t->id}}" id="">
                                                <button type="submit" name="submit" value="approve"
                                                    class="btn btn-primary">Approve </button>
                                                <button type="submit" name="submit" value="cancel"
                                                    class="btn btn-danger">Cancel </button>
                                            </form>
                                            @endif

                                        </td>
                                    </tr>
                                    @php
                                        $count = $count + 1;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <table id="transfer-table" class="table">
                            <thead class="thead-dark">
                                <tr style="background-color:red !important;">
                                    <th style="width: 2px !important">#</th>
                                    <th scope="col">name</th>
                                    <th>from Account</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">To Account</th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody class="inventory-iems-body" id="nventory-iems-body">
                                @php
                                    $count = 1;
                                @endphp
                                
       
                                @foreach ($t_cancel as $t)
                                    <tr>
                                        <td>{{ $count }}</td>
                                        <td>{{ $t->sender_account->owner->name }}</td>
                                        <td>{{ $t->sender_account->account_name }} |
                                            {{ $t->sender_account->account_number }} </td>
                                        <td>{{ number_format($t->amount) }} </td>
                                        <td>{{ $t->reciever_account->account_name }} |
                                            {{ $t->reciever_account->account_number }} </td>
                                       
                                        <td>
                                            @if($t->status ==0)
                                            <form method="POST" class="form form-vertical" autocomplete="on" action="{{route('ro--transfer-approval')}}">
                                                @csrf
                                                <input type="hidden" name="tran_id" value="{{$t->id}}" id="">
                                                <button type="submit" name="submit" value="approve"
                                                    class="btn btn-primary">Approve </button>
                                                <button type="submit" name="submit" value="cancel"
                                                    class="btn btn-danger">Cancel </button>
                                            </form>
                                            @endif

                                        </td>
                                    </tr>
                                    @php
                                        $count = $count + 1;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
