@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.css" integrity="sha512-A374yR9LJTApGsMhH1Mn4e9yh0ngysmlMwt/uKPpudcFwLNDgN3E9S/ZeHcWTbyhb5bVHCtvqWey9DLXB4MmZg==" crossorigin="anonymous" />
<style>
    .modal-content{
    position: relative;
    display: flex;
    flex-direction: column;
    margin-top: 30%;
}
</style>
@section('content')
<div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><strong>Payment Section</strong> </div>
                    <div class="card-body">
             
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <label for="tran_id"> Transaction ID: </label>
                                                        <strong>{{ $transaction->id }}</strong>
                                                    </div>
                                                    <div class="col-sm-10">
                                                            <label for="cname"> Applicant name: </label>
                                                            <strong>{{ $transaction->lname}}, {{ $transaction->fname}}</strong>
                                                        
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <label for="permit_ID"> Transaction Description: </label>
                                                        <strong>{{ $transaction->tran_desc}}</strong>
                                                    </div>
                                                </div>
                                    </div> 
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for=""><strong>Payment Breakdown</strong> </label>
                                    @foreach ($payment as $item)
                                        <p>{{$item->payment_desc}} : {{$item->amount}}</p>
                                    @endforeach
                                   <label for=""><strong>Total Payment</strong> </label>
                                   <div class="row">
                                        <div class="col-4">
                                            <input value="{{$total}}" class="form-control" type="text" name="total" id="total" readonly>
                                        </div>
                                        <div class="col-4">
                                            <a href="{{url('show_payment/'.$transaction->id)}}" class="btn btn-outline-primary">Refresh list</a>
                                            <a href="{{url('printReceipt/'.$transaction->id)}}" class="btn btn-warning"><i class="fa fa-print"></i> Print</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="container">
                                    <div class="table">
                                        <form method="post" id="dynamic_form">
                                            <span id="result"></span>
                                            
                                            <table class="table table-striped" id="payment_table">
                                                <thead>
                                                    <tr>
                                                        <th width="20%">Transaction ID</th>
                                                        <th width="30%">Payment Description</th>
                                                        <th width="30%">Amount</th>
                                                        <th width="20%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                             
                                                    @csrf
                                                    <input style="margin-right: 20px; margin-bottom: 10px" type="submit" name="save" id="save" class="btn btn-success pull-right" value="Save">
                                              
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        var count = 1;

        dynamic_field(count);

        function dynamic_field(number)
        {
            var html = '<tr>';
            
            html += '<td><input readonly type="text" name="tran_id[]" class="form-control" value="{{$transaction->id}}"/></td>';
            html += '<td><input type="text" name="description[]" class="form-control" /></td>';
            html += '<td><input type="text" name="amount[]" class="form-control" /></td>';
            
            if(number > 1)
            {
                html += '<td><button type="button" name="remove" id="remove" class="btn btn-outline-danger"><i class="fa fa-minus"></i></button></td></tr>';
                $('tbody').append(html);
            }
            else
            {
                html += '<td><button type="button" name="add" id="add" class="btn btn-outline-success"><i class="fa fa-plus"></i></button></td></td></tr>';
                $('tbody').html(html);
            }
            
        }

        $(document).on('click', '#add', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '#remove', function(){
            count--;
            $(this).closest("tr").remove();
        });

        $('#dynamic_form').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url:'{{ url("/store_dynamicPay") }}',
                method: 'post',
                data:$(this).serialize(),
                dataType:'json',
                beforeSend: function(){
                    $('#save').attr('disabled', 'disabled');
                },
                success:function(data)
                {
                    if(data.error)
                    {
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++)
                        {
                            error_html += '<p>'+data.error[count]+'</p>';
                        }
                        $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: 'You have missed something.'
                        })
                    }
                    else
                    {
                        dynamic_field(1);
                        $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Payment has been saved',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    }
                    $('#save').attr('disabled', false);
                    
                }                
            })
        });
    });
</script>
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.14.0/sweetalert2.min.js" integrity="sha512-tiZ8585M9G8gIdInZMGGXgEyFdu8JJnQbIcZYHaQxq+MP4+T8bkvA+TfF9BjPmiePjhBhev3bQ6nloOB1zF9EA==" crossorigin="anonymous"></script>

@endsection
