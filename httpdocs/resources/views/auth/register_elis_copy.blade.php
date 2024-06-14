@extends('layouts.front.master')

@section('front')

@push("front-styles")
<style>
	.login-input{
    padding: 5px 0px 5px 7px;
    display: block;
    padding: 10px;
    background-color: white !important;
		width: 100%;
	}
	.auth-container{
	margin-top:76px;
		height:auto;
	}
</style>
@endpush


		<!--begin::Main-->
		<!--begin::Root-->
		<div class="auth-container">

		<div class="row gx-0 h-100">
			<!--begin::Authentication - Sign-in -->
			<div class="col-lg-6">
				<!--begin::Content-->
				
				<div class="widget">
					<!--begin::Wrapper-->
					<div class="register-widget">
				
						
                        
						<form action="{{ route('register') }}" method="POST" class="validatedForm" name="registerform" enctype="multipart/form-data">
                            @csrf  
                            <!--begin::Form-->
            @if ($errors->any())
            <div class="alert alert-danger pb-0">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif        
                            <div class="row">
                
                              <div class="form-group my-2 col-md-6">
                                <label for="">Nome : <span class="required"></span></label>
                                <input placeholder="inserisci nome" type="text" name="name" value="{{old('name')}}"  class="login-input shadow" required>
                
                              </div>
                
                              <div class="form-group my-2 col-md-6">
                                <label>Email : <span class="required"></span></label>
                                <input  required type="text" name="email" placeholder="demo@demo.com" value="{{old('email')}}"  class="login-input shadow">
                              </div>
                
                              <div class="form-group my-2 col-md-6">
                                <label for="">Telefone :</label>
                                <input placeholder="+390000000000" required type="tel" value="+39"   name="phone" pattern="[+]{1}[0-9]{12}" class="login-input shadow" id="phone" title="e.g: +390000000000" 
									   
									   >
                              </div>
                              <div class="form-group my-2 col-md-6">
                                <label>
                                    Paese : <span class="required"></span>
                                  </label>
                                <select id="country" required class="login-input shadow" name="country">
                                    <option value="IT" selected>Italy</option>
                                </select>
                              </div>
                
                              <div class="form-group my-2 col-md-6">
                                <label>
                                    Regione : <span class="required"></span>
                                  </label>
                                <select onchange="filterCities(this)" name="state" required class="login-input shadow">
                                  <option value="" selected>Seleziona</option>
                                 
<option value="Abruzzo" data-id="1679">Abruzzo</option>
<option value="Agrigento" data-id="1727">Agrigento</option>
<option value="Alessandria" data-id="1783">Alessandria</option>
<option value="Ancona" data-id="1672">Ancona</option>
<option value="Aosta Valley" data-id="1716">Aosta Valley</option>
<option value="Apulia" data-id="1688">Apulia</option>
<option value="Ascoli Piceno" data-id="1681">Ascoli Piceno</option>
<option value="Asti" data-id="1780">Asti</option>
<option value="Avellino" data-id="1692">Avellino</option>
<option value="Barletta-Andria-Trani" data-id="1686">Barletta-Andria-Trani</option>
<option value="Basilicata" data-id="1706">Basilicata</option>
<option value="Belluno" data-id="1689">Belluno</option>
<option value="Benevento" data-id="1701">Benevento</option>
<option value="Bergamo" data-id="1704">Bergamo</option>
<option value="Biella" data-id="1778">Biella</option>
<option value="Brescia" data-id="1717">Brescia</option>
<option value="Brindisi" data-id="1714">Brindisi</option>
<option value="Calabria" data-id="1703">Calabria</option>
<option value="Caltanissetta" data-id="1718">Caltanissetta</option>
<option value="Campania" data-id="1669">Campania</option>
<option value="Campobasso" data-id="1721">Campobasso</option>
<option value="Caserta" data-id="1731">Caserta</option>
<option value="Catanzaro" data-id="1728">Catanzaro</option>
<option value="Chieti" data-id="1739">Chieti</option>
<option value="Como" data-id="1740">Como</option>
<option value="Cosenza" data-id="1742">Cosenza</option>
<option value="Cremona" data-id="1751">Cremona</option>
<option value="Crotone" data-id="1754">Crotone</option>
<option value="Cuneo" data-id="1775">Cuneo</option>
<option value="Emilia-Romagna" data-id="1773">Emilia-Romagna</option>
<option value="Enna" data-id="1723">Enna</option>
<option value="Fermo" data-id="1744">Fermo</option>
<option value="Ferrara" data-id="1746">Ferrara</option>
<option value="Foggia" data-id="1771">Foggia</option>
<option value="Forlì-Cesena" data-id="1779">Forlì-Cesena</option>
<option value="Friuli–Venezia Giulia" data-id="1756">Friuli–Venezia Giulia</option>
<option value="Frosinone" data-id="1776">Frosinone</option>
<option value="Gorizia" data-id="1777">Gorizia</option>
<option value="Grosseto" data-id="1787">Grosseto</option>
<option value="Imperia" data-id="1788">Imperia</option>
<option value="Isernia" data-id="1789">Isernia</option>
<option value="L'Aquila" data-id="1781">L'Aquila</option>
<option value="La Spezia" data-id="1791">La Spezia</option>
<option value="Latina" data-id="1674">Latina</option>
<option value="Lazio" data-id="1678">Lazio</option>
<option value="Lecce" data-id="1675">Lecce</option>
<option value="Lecco" data-id="1677">Lecco</option>
<option value="Liguria" data-id="1768">Liguria</option>
<option value="Livorno" data-id="1745">Livorno</option>
<option value="Lodi" data-id="1747">Lodi</option>
<option value="Lombardy" data-id="1705">Lombardy</option>
<option value="Lucca" data-id="1749">Lucca</option>
<option value="Macerata" data-id="1750">Macerata</option>
<option value="Mantua" data-id="1758">Mantua</option>
<option value="Marche" data-id="1670">Marche</option>
<option value="Massa and Carrara" data-id="1759">Massa and Carrara</option>
<option value="Matera" data-id="1760">Matera</option>
<option value="Medio Campidano" data-id="1761">Medio Campidano</option>
<option value="Modena" data-id="1757">Modenas</option>
<option value="Molise" data-id="1695">Molise</option>
<option value="Monza and Brianza" data-id="1769">Monza and Brianza</option>
<option value="Novara" data-id="1774">Novara</option>
<option value="Nuoro" data-id="1790">Nuoro</option>
<option value="Oristano" data-id="1786">Oristano</option>
<option value="Padua" data-id="1665">Padua</option>
<option value="Palermo" data-id="1668">Palermo</option>
<option value="Parma" data-id="1666">Parma</option>
<option value="Pavia" data-id="1676">Pavia</option>
<option value="Perugia" data-id="1691">Perugia</option>
<option value="Pesaro and Urbino" data-id="1693">Pesaro and Urbino</option>
<option value="Pescara" data-id="1694">Pescara</option>
<option value="Piacenza" data-id="1696">Piacenza</option>
<option value="Piedmont" data-id="1702">Piedmont</option>
<option value="Pisa" data-id="1685">Pisa</option>
<option value="Pistoia" data-id="1687">Pistoia</option>
<option value="Pordenone" data-id="1690">Pordenone</option>
<option value="Potenza" data-id="1697">Potenza</option>
<option value="Prato" data-id="1700">Prato</option>
<option value="Ragusa" data-id="1729">Ragusa</option>
<option value="Ravenna" data-id="1707">Ravenna</option>
<option value="Reggio Emilia" data-id="1708">Reggio Emilia</option>
<option value="Rieti" data-id="1712">Rieti</option>
<option value="Rimini" data-id="1713">Rimini</option>
<option value="Rovigo" data-id="1719">Rovigo</option>
<option value="Salerno" data-id="1720">Salerno</option>
<option value="Sardinia" data-id="1715">Sardinia</option>
<option value="Sassari" data-id="1722">Sassari</option>
<option value="Savona" data-id="1732">Savona</option>
<option value="Sicily" data-id="1709">Sicily</option>
<option value="Siena" data-id="1734">Siena</option>
<option value="Siracusa" data-id="1667">Siracusa</option>
<option value="Sondrio" data-id="1741">Sondrio</option>
<option value="South Sardinia" data-id="1730">South Sardinia</option>
<option value="Taranto" data-id="1743">Taranto</option>
<option value="Teramo" data-id="1752">Teramo</option>
<option value="Terni" data-id="1755">Terni</option>
<option value="Trapani" data-id="1733">Trapani</option>
<option value="Trentino-South Tyrol" data-id="1725">Trentino-South Tyrol</option>
<option value="Treviso" data-id="1762">Treviso</option>
<option value="Trieste" data-id="1763">Trieste</option>
<option value="Tuscany" data-id="1664">Tuscany</option>
<option value="Udine" data-id="1764">Udine</option>
<option value="Umbria" data-id="1683">Umbria</option>
<option value="Varese" data-id="1765">Varese</option>
<option value="Veneto" data-id="1753">Veneto</option>
<option value="Verbano-Cusio-Ossola" data-id="1726">Verbano-Cusio-Ossola</option>
<option value="Vercelli" data-id="1785">Vercelli</option>
<option value="Verona" data-id="1736">Verona</option>
<option value="Vibo Valentia" data-id="1737">Vibo Valentia</option>
<option value="Vicenza" data-id="1738">Vicenza</option>
<option value="Viterbo" data-id="1735">Viterbo</option>
                                </select>
                              </div>
                
                              <div class="form-group my-2 col-md-6">
                            <!-- Alabama-->
                            <label>
                                Città : <span class="required"></span>
                              </label>
                                <select id="city" required class="login-input shadow cities-tb" name="city">
                                @if (old('city'))
                                      <option value="{{ old('city') }}" selected>{{ old('city') }}</option>
                                  @endif
                                </select> 
                            </div>

                            
                              <div class="form-group my-2 col-md-12">
                                <label for="">Codice postale : <span class="required"></span></label>
                                <input placeholder="Inserisci codice postale" type="number" name="zipcode" value=""  class="login-input shadow" required>
                
                              </div>
                              <div class="col-md-12 ">
                                <div class="row">
                                  <div class="form-group my-2 col-md-6">
                                    <label for="">Password : <span class="required"></span></label>
                                    <div class="input-group">
                                      <input name="password" required type="password" id="password"  value="{{old('password')}}" class="login-input shadow" placeholder="Inserisci nuova password">
                                    
                                    </div>
                                  </div>
                                  <div class="form-group my-2 col-md-6">
                                    <label for="">Conferma Password : <span class="required"></span></label>
                                    <div class="input-group">
                                      <input placeholder="Inserisci password per confermare" id="password_confirm"  value="{{old('password_confirm')}}" type="password" required name="password_confirm" class="login-input shadow">
                                     
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <p class="text-danger" style="display:none;" id="passwordconfirmError">La password e la sua password di conferma non sono la stessa cosa</p>
                            </div>
                            
                            <div class="form-group my-2 col-md-6">
                                <label for="exampleInputSlug">Inserisci foto profile :</label><br>
                                <div class="input-group mb-3">
                                  <div class="custom-file">
                                    <input type="file"  class="login-input shadow"  value="{{old('profile')}}" name="profile" class="custom-file-input" >
                                    
                                  </div>
                                </div>
                              </div>
                            <div class="form-group my-2 col-md-12">
								
								@php
								$pdf = \App\Models\TermsAndConditions::first();
								@endphp
                         <input type="checkbox" value="yes" class="form-check-input" name="termsandconditions" required>
								<label >Cliccando qui, dichiaro di aver letto e accettato i termini di ZeepUp 
									<a href="https://drive.google.com/file/d/1k77SAZyKjqKQBERS2cxMo1_bl5hGaFwX/view?usp=drive_link
" class="text-decoration-none" target="_blank">Termini e Condizioni</a> e
								<a href="https://drive.google.com/file/d/1OnnPfQhHZFuqSQz4d5f1vgGlnkAF_MWv/view?usp=drive_link" class="text-decoration-none" target="_blank">Politica sulla privacy</a>. 
								</label>
							</div>
                
                            <div class="form-group my-2 ">
                              
                              <button type="reset"  class="btn hero-section-btn shadow w-25 m-0 p-0" style="height:3rem;"><i class="fa fa-refresh"></i> Reset</button>
                               
                                  
                              <button type="submit" onclick="return Validate()" id="button1" class="btn hero-section-btn shadow w-25 m-0 p-0" style="height:3rem;"><i class="fa fa-check-circle"></i>
                                Registrati</button>
                               
                                
                            </div>
                        </form>
						<!--end::Form-->
					</div>
					</div>
					<!--end::Wrapper-->
				
				<!--end::Content-->
				
			</div>
			<div class="col-lg-6 ">
     <div class="auth-bg" style="background-image:url({{ asset('front-end/images/register-bg-new.png') }}); background-size:cover; background-repeat:no-repeat; background-position:center center; height:100%;">
					<div class="content">
						<div class="date">
						<!--February 21, 2023-->
						</div>
						<!--<h3 class="heading">Sign Up</h3>-->
						<!--<p>
						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, 
						</p>
						<a href="#">Read More</a>-->
					</div>
				</div>
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		
		</div>
		<!--end::Root-->




@push("front-scripts")
    <script src="https://unpkg.com/lokijs@^1.5/build/lokijs.min.js"></script>
    <script src="{{ asset('front-end/js/app.js') }}"></script>
<script>
			$(window).scroll(function() {
            $('nav').toggleClass('scrolled', $(this).scrollTop() > 50);
        });

    function Validate() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password_confirm").value;
        if (password != confirmPassword) {
            $('#passwordconfirmError').show();
            return false;
        }
        
        $('#passwordconfirmError').hide();
        return true;
    }
	$('#phone').keyup(function(){
  // Don't run for backspace key entry, otherwise it bugs out
    if(event.which != 8){

        // Remove invalid chars from the input
        var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");
        var inputlen = input.length;
        // Get just the numbers in the input
        var numbers = this.value.replace(/\D/g,'');
        var numberslen = numbers.length;
        // Value to store the masked input
        var newval = "";

        // Loop through the existing numbers and apply the mask
        for(var i=0;i<numberslen;i++){
            if(i==0) newval="+"+numbers[i];
            else if(i==1) newval+=numbers[i];
            else if(i==5) newval+=numbers[i];
            else newval+=numbers[i];
        }

        // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.
        if(inputlen>=1&&numberslen==0&&input[0]=="(") newval="(";
        else if(inputlen>=6&&numberslen==3&&input[4]==")"&&input[5]==" ") newval+=") ";
        else if(inputlen>=5&&numberslen==3&&input[4]==")") newval+=" ";
        else if(inputlen>=6&&numberslen==3&&input[5]==" ") newval+=" ";
        else if(inputlen>=10&&numberslen==6&&input[9]=="-") newval+="-";

        $(this).val(newval.substring(0,13));

    }
});
</script>
@endpush
@endsection
