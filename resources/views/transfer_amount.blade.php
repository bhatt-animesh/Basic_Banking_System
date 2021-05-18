@extends('theme.default')

@section('content')
<style type="text/css">
    .pac-container {
    z-index: 10000 !important;
}
</style>
<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{URL::to('/admin/home')}}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Transfer Amount</a></li>
        </ol> 
    </div>
</div>
<!-- row -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <span id="message"></span>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Transfer Money</h4>
                    <div class="table-responsive" id="table-display">
                        <form id="add_product" enctype="multipart/form-data">
                            <div class="modal-body">
                                <span id="msg"></span>
                                @csrf
                                <div class="form-group">
                                    <label for="from_name">Select Sender Name:</label>
                                    <select class="form-control" name="from_name" id="from_name" required>
                                        <option selected>Select Sender Name</option>
                                        <?php
                                            foreach ($getcustomer as $users) {
                                        ?>
                                            <option value="{{$users->name}}">{{$users->name}}</option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="to_name">Select Receiver Name:</label>
                                    <select class="form-control" name="to_name" id="to_name" required>
                                        <option selected>Select Receiver Name</option>
                                        <?php
                                            foreach ($getcustomer as $users) {
                                        ?>
                                            <option value="{{$users->name}}">{{$users->name}}</option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount" class="col-form-label">Enter Amount:</label>
                                    <input class="form-control" type="text" name="amount" id="amount" placeholder="Enter Amount" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" id="submitbtn" class="btn btn-secondary" data-dismiss="modal">reset</button>
                                <button type="submit" id="closebtn" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- #/ container -->
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {
    $('#add_product').on('submit', function(event){
        event.preventDefault();
        var msgs = '';
        var value1 = $( "#from_name option:selected" ).val();
        var value2 = $( "#to_name option:selected" ).val();
        console.log(value1 + value2);
        if(value1 == value2){
            msgs += '<div class="alert alert-danger">Sender And Receiver is Same!!</div>';
            $('#msg').html(msgs);
            setTimeout(function(){
                $('#msg').html('');
            }, 7000);
            return false;
        }else if(value1 == "Select Sender Name" || value2 == "Select Receiver Name"){
            msgs += '<div class="alert alert-danger">Sender And Receiver Is not selected!!</div>';
            $('#msg').html(msgs);
            setTimeout(function(){
                $('#msg').html('');
            }, 7000);
            return false;
        }
        var form_data = new FormData(this);
        swal({
            title: "Are you sure?",
            text: "Do you want to transfer money?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Transfer!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: false,
            showLoaderOnConfirm: true,
        },
        function(isConfirm) {
        if (isConfirm) {
        $.ajax({
            url:"{{ URL::to('transfer/amount') }}",
            method:"POST",
            data:form_data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(result) {
                var msg = '';
                if(result.error.length > 0)
                {
                    for(var count = 0; count < result.error.length; count++)
                    {
                        msg += '<div class="alert alert-danger">'+result.error[count]+'</div>';
                    }
                    $('#msg').html(msg);
                    setTimeout(function(){
                      $('#msg').html('');
                    }, 5000);
                }
                else
                {   
                    swal({
                            title: "Approved!",
                            text: "Money Transferred Successfully",
                            type: "success",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Ok",
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                swal.close();
                                window.location.replace('/transactionhistorys');
                            }
                    });
                }
            },
            error: function(e) {
                        swal("Cancelled", "Something Went Wrong :(", "error");
            }
        })
    }else {
                swal("Cancelled", "Something went wrong :)", "error");
            }
      });
    });
});
</script>
@endsection