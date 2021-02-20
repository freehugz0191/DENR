@extends('layouts.app')
<style>
    @media print{
        body * {
            visibility: hidden;
        }

        .print-container, .print-container * {
            visibility: visible;
        }

        .print-container {
            width: 100%;
            height:100%;
            position:absolute;
            top:0px;
            bottom:0px;
            margin: auto;
            margin-top: 0px !important;
            border: 1px solid;
            zoom: 200%;
        }

        @page
    {
        size: 297mm 210mm; /* landscape */
        /* you can also specify margins here: */
        margin: 250mm;
        margin-right: 450mm; /* for compatibility with both A4 and Letter */
    }
    }
</style>
@section('content')
<button onclick="window.print();" class="btn btn-warning"><i class="fa fa-print"></i></button>

    <div class="col d-flex justify-content-center">
    <div class="card print-container" style="width: 400px">
        <div class="row justify-content-center">
            <div  style="align-items: baseline">
                <br>
                <div>
                    <img style="height: 90px; width: 90px; margin-left: 25px" src="{{ url('/images/denr-logo.png') }}" alt="">
                    <div  style="margin-top: -85px; margin-left: 90px; text-align:center">
                       <strong style="font-size: 13px">City Environment and Natural Resources <br>Office of Panabo</strong>  <br><p style="font-size: 10px">Tel. no. - (084) 823 2011 <br> http://r11.denr.gov.ph/ </p> 
                    </div> 
                </div>
                
                
            </div>

        </div><br><hr style="width: 80%; margin: 0 auto; height: 2px"><br>
        <div style="text-align: center; margin-top: -10px"><h4><strong> Official Receipt</strong></h4></div>
        <br><hr style="width: 80%; margin: 0 auto; margin-top: -15px">
        <div class="row">
            <div style="margin-left: 40px; margin-top: 5px" class="col-4">
                <strong>Applicant:</strong>
            </div>
            <div style="margin-top: 5px" class="col-5">
                <p style="margin-left: -30px">{{ $transaction->lname}}, {{ $transaction->fname}}</p>
            </div>
        </div>
        <div style="margin-top: -15px" class="row">
            <div style="margin-left: 40px; margin-top: 5px" class="col-4">
                <strong>Transaction:</strong>
            </div>
            <div style="margin-top: 5px" class="col-6">
                <p style="margin-left: -30px">{{ $transaction->tran_desc}}</p>
            </div>
        </div>
        <div style="margin-top: -15px" class="row">
            <div style="margin-left: 40px; margin-top: 5px" class="col-4">
                <strong>Date:</strong>
            </div>
            <div style="margin-top: 5px" class="col-6">
                <p style="margin-left: -30px">{{ $date->format('F j, Y') }}</p>
            </div>
        </div>
        <hr style="width: 80%; margin: 0 auto">
        <div style="margin-left: 40px" class="row">
            Breakdown of Payments
        </div>
        <hr style="width: 80%; margin: 0 auto">
        
        @foreach ($payment as $item)
            <div class="row" style="margin-bottom: -20px">
                <div style="margin-left: 40px; margin-top: 5px" class="col-5">
                    {{$item->payment_desc}}
                </div>
                <div style="margin-top: 5px" class="col-5">
                    <p style="margin-left: -30px">: {{ $item->amount }}</p>
                </div>
            </div>
        @endforeach
        <hr style="width: 80%; margin: 0 auto; margin-top: 5px">
        <div class="row">
            <div style="margin-left: 40px; margin-top: 5px" class="col-5">
                Total
            </div>
            <div style="margin-top: 5px" class="col-5">
                <p style="margin-left: -30px">: <span>&#8369;</span> {{ $total }}</p>
            </div>
        </div>

        <div class="row">
            <div style="margin-left: 40px; margin-top: 5px; font-size: 10px" class="col-6">
               This is an official receipt for <br> CENRO-Panabo.
            </div>
            <div style="margin-top: 5px" class="col-4">
                <hr style="width: 100%; margin-left: -15px">
                <p style="margin-left: -10px; margin-top: -35px; font-size: 13px"> <br>Cashier Signature</p>
            </div>
        </div><br>
   


    </div>
    </div>
    
@endsection