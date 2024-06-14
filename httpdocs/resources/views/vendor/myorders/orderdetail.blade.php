<style>
    /* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  
}

input:checked + .slider {
  background-color: #ff0066;
}

input:focus + .slider {
  box-shadow: 0 0 1px #ff0066;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                <h2>Ordine effettuato da</h2>
            </div>
        </div>
        <div class="row">
            <div class="col"><b>Nome:</b></div>
            <div class="col">{{ $buyer->name }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Telefono:</b></div>
            <div class="col">{{ $buyer->phone }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Indirizzo:</b></div>
            <div class="col">{{ $buyer->address }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Codice postale:</b></div>
            <div class="col">{{ $buyer->zipcode }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Citta:</b></div>
            <div class="col">{{ $buyer->city }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Regione:</b></div>
            <div class="col">{{ $buyer->state }}</div>
        </div>
    </div>
    <div class="col">
        <div class="row">
            <div class="col">
                <h2>Ordine ritirato da</h2>
            </div>
        </div>
        <div class="row">
            <div class="col"><b>Nome:</b></div>
            <div class="col">@if($order->name!="") {{ $order->name }} @else {{ $buyer->name }} @endif</div>
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
            <div class="col"><b>Codice postale:</b></div>
            <div class="col">{{ $order->zipcode }}</div>
        </div>
        <div class="row">
            <div class="col"><b>Citta:</b></div>
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
        <b>Orario di ritiro: <span style="color:#FF0066">{{date("d-m-Y H:i:s", strtotime($order->delivery_date." ".$order->delivery_time))}}</span></b>
    </div>
    <div class="col text-right">
        <div class="row">
            <div class="col">
                <b>Ritirato?</b>
            </div>
            <div class="col">
                <label class="switch">
                    <input type="checkbox" id="chkCollected" value="yes" @if($order->collected=='yes') checked disabled @endif>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="col" id="coltime">
                @if($order->collected=='yes')
                    {{$order->collectiontime}}
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
            &euro; {{ $itemdisplay['unit_price'] }}
        </div>
        <div class="col">
            {{ $itemdisplay['quantity'] }}
        </div>
        <div class="col">
            &euro; {{ $itemdisplay['total_price'] }}
        </div>
    </div>
@endforeach

<script>
    $(document).ready(function(){
        var checkedval = "no";
        document.getElementById('chkCollected').addEventListener('change', (e) => {
            this.checkboxValue = e.target.checked ? 'on' : 'off';
            //console.log(this.checkboxValue)
            if(this.checkboxValue=='on')
            {
               checkedval = 'yes'
            }
            else {
                //console.log('not checked');
                checkedval = 'no';
            }

            $.ajax({
                url: "{{route('vendor.myorder.changestatus')}}",
                type: 'POST',
                headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"},
                data: {'id': {{$order->id}}, 'checkedval':checkedval},
                success: function(response) {
                    //console.log(response);
                    //return;
                    //alert('Item added to cart!');
                    //$('#ordermodal').modal('toggle');
                    //$('.orderdetail').html(response);
                    $('#coltime').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    alert('Errore nel trovare dettagli ordine');
                }
            });

        })
        /*$('.slider').click(function(){
            //$('#chkCollected').toggle();
            console.log('here');
            if($('.slider').checked)
            {
                console.log('checked');
            }
            else {
                console.log('not checked');
            }
        });*/
        /*$('#chkCollected').change(function(){
            console.log($(this).val());
            if($(this).checked)
            {
                console.log('checked');
            }
            else {
                console.log('not checked');
            }
        });*/
    });
</script>
