@extends('layouts.buyer.master')

@section('buyer')
<div class="card mb-3">
    <div class="card-header align-items-center">
        <h3 class="fw-bolder m-0">Conferma Ordine</h3>
    </div>
    <div class="card-body">
        Grazie per il tuo ordine! Il tuo ordine e' confermato. Ordine numero <span style="color:#FF0066">{{$strOrderNumber}}</span>
        <div class="row">
            <div class="col">
                <b>Ora di ritiro: <span style="color:#FF0066">{{ $thisOrder->delivery_date }} {{ $thisOrder->delivery_time }}</span></b><br/><br/>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <img src="{{asset('images/fork.jpeg')}}" style="width: 100px" />
                <img src="{{asset('images/clock.jpeg')}}" style="width: 100px" />
            </div>
        </div>
        <div class="row">
            <div class="col">
                <br/>
                <a style="color:#FF0066" href="{{route('all.categories')}}">Continua a esplorare altre offerte!</a>
            </div>
        </div>
    </div>
</div>




@endsection
@section('customjs')

@endsection
