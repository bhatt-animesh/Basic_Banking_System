@extends('theme.default')

@section('content')
<div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-1">
                <a href="{{URL::to('customers')}}" aria-expanded="false">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Customer In Bank</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ count($getcustomer) }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                    </div>
                </a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card gradient-3">
                <a href="{{URL::to('transactionhistorys')}}" aria-expanded="false">
                    <div class="card-body">
                        <h3 class="card-title text-white">Total Transaction History</h3>
                        <div class="d-inline-block">
                            <h2 class="text-white">{{ count($gethistory) }}</h2>
                        </div>
                        <span class="float-right display-5 opacity-5"><i class="fa fa-list-alt"></i></span>
                    </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Today's All Transactions</h4>
                        <div class="table-responsive" id="table-display">
                            @include('tables.todaythtable')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
@endsection