@php
date_default_timezone_set('Europe/Rome');
@endphp
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                <h2>Venditore</h2>
            </div>
        </div>
        <div class="row">
            <div class="col"><b>Nome:</b></div>
            <div class="col">{{ $vendor->name }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Telefono:</b></div>
            <div class="col">{{ $vendor->phone }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Indirizzo:</b></div>
            <div class="col">{{ $vendor->address }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Codice Postale:</b></div>
            <div class="col">{{ $vendor->zipcode }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Citta':</b></div>
            <div class="col">{{ $vendor->city }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Stato:</b></div>
            <div class="col">{{ $vendor->state }}</div>
        </div>
    </div>
    <div class="col">
        <div class="row">
            <div class="col">
                <h2>Ordine Ritirato da</h2>
            </div>
        </div>
        <div class="row">
            <div class="col"><b>Nome:</b></div>
            <div class="col">@if($order->name!="") {{ $order->name }} @else {{ $user->name }} @endif</div>
        </div>
        <div class="row">
            <div class="col"><b>Telefono:</b></div>
            <div class="col">{{ $order->phone }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Indirizzo:</b></div>
            <div class="col">{{ $order->address }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Codice Postale:</b></div>
            <div class="col">{{ $order->zipcode }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Citta':</b></div>
            <div class="col">{{ $order->city }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Regione:</b></div>
            <div class="col">{{ $order->state }}</div>
        </div>
    </div>
</div>
<div class="row">
    <br>
</div>
<div class="row">
    <div class="col">
        <b>Ora di Ritiro: <span style="color:#FF0066">{{ date("d-m-Y H:i:s", strtotime($order->delivery_date." ".$order->delivery_time)) }}</span></b>
    </div>
    <div class="col text-right">
        <div class="row">
            <div class="col">
                <b>Ritirato?</b>
            </div>
            <div class="col">
                @if($order->collected=='yes')
                    {{$order->collectiontime}}
                @else
                    Non ancora ritirato (Reference Elis)
                @endif
            </div>
        </div>
        <!-- Rounded switch -->

    </div>
</div>
<div class="row">
    <br>
</div>
<div class="row">
    <hr>
</div>
<div class="row">
    <br>
</div>
<div class="row">
    <h3>Prodotto</h3>
</div>
<div class="row">
    <div class="col">
        <b>Prodotto</b>
    </div>
    <div class="col">
        <b>Prezzo</b>
    </div>
    <div class="col">
        <b>Quantita'</b>
    </div>
    <div class="col">
        <b>Prezzo</b>
    </div>
</div>
@foreach($arrDisplay as $itemdisplay)
    <div class="row">
        <div class="col">
            {{ $itemdisplay['Title'] }}
        </div>
        <div class="col">
            &euro; {{ number_format($itemdisplay['unit_price'], 2, ',', '') }}
        </div>
        <div class="col">
            {{ $itemdisplay['quantity'] }}
        </div>
        <div class="col">
            &euro; {{ number_format($itemdisplay['total_price'], 2, ',', '') }}
        </div>
    </div>
@endforeach
