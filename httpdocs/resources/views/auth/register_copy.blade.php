b0VIM 8.2      x�Te�wj ��! root                                    vps-6d659175                            /var/www/vhosts/it.zeepup.com/httpdocs/resources/views/auth/register.blade.php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     3210    #"! U                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 tp           Z                     ��������B       [              ��������@       �              ��������@       �              ��������F                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            ad     �     Z       �  �  �  �  �  �  �  �  l  Y  1  "      �  �  �  �  �  �  �  �  �  �  �  l  A  '      �  �  �  �  �  �    �  �  �  b  M    �  �  �  �  �  Y  H    �
  
  �	  �	  �	  �	  +	  �  j  Y    �    �  �  �  �  X    �  y  *     �  �  �  ]    �  m    �  �  �  �  M    �  �  �               <option value="Ascoli Piceno" data-id="1681">Ascoli Piceno</option> <option value="Apulia" data-id="1688">Apulia</option> <option value="Aosta Valley" data-id="1716">Aosta Valley</option> <option value="Ancona" data-id="1672">Ancona</option> <option value="Alessandria" data-id="1783">Alessandria</option>  <option value="Abruzzo" data-id="1679">Abruzzo</option>                                                                     <option value="" selected>Seleziona</option>                                 <select onchange="filterCities(this)" name="state" required class="login-input shadow">                                   </label>                                     Regione : <span class="required"></span>                                 <label>                               <div class="form-group my-2 col-md-6">                                                </div>                                 </select>                                     <option value="IT" selected>Italy</option>                                 <select id="country" required class="login-input shadow" name="country">                                   </label>                                     Paese : <span class="required"></span>                                 <label>                               <div class="form-group my-2 col-md-6">                               </div> 									   > 									                                    <input placeholder="+390000000000" required type="tel" value="+39"   name="phone" pattern="[+]{1}[0-9]{12}" class="login-input shadow" id="phone" title="e.g: +390000000000"                                  <label for="">Telefone :</label>                               <div class="form-group my-2 col-md-6">                                                </div>                                 <input  required type="text" name="email" placeholder="demo@demo.com" value="{{old('email')}}"  class="login-input shadow">                                 <label>Email : <span class="required"></span></label>                               <div class="form-group my-2 col-md-6">                                                </div>                                                  <input placeholder="inserisci nome" type="text" name="name" value="{{old('name')}}"  class="login-input shadow" required>                                 <label for="">Nome : <span class="required"></span></label>                               <div class="form-group my-2 col-md-6">                                              <div class="row">         @endif                     </div>                 </ul>                     @endforeach                         <li>{{ $error }}</li>                     @foreach ($errors->all() as $error)                 <ul>             <div class="alert alert-danger pb-0">             @if ($errors->any())                             <!--begin::Form-->                             @csrf   						<form action="{{ route('register') }}" method="POST" class="validatedForm" name="registerform" enctype="multipart/form-data">                          						 				 					<div class="register-widget"> 					<!--begin::Wrapper--> 				<div class="widget"> 				 				<!--begin::Content--> 			<div class="col-lg-6"> 			<!--begin::Authentication - Sign-in --> 		<div class="row gx-0 h-100">  		<div class="auth-container"> 		<!--begin::Root--> 		<!--begin::Main-->   @endpush </style> 	} 		height:auto; 	margin-top:76px; 	.auth-container{ 	} 		width: 100%;     background-color: white !important;     padding: 10px;     display: block;     padding: 5px 0px 5px 7px; 	.login-input{ <style> @push("front-styles")  @section('front')  @extends('layouts.front.master') ad  "  V     F       �  �  �  �  �  �  }  U  L  I  @  -  ,  +  *  )    �  �  |  [        �  �  Y  .  �  �  �  �  �  �  �  m  /      �
  �
  �
  T
   
  �	  �	  �	  �	  r	  K	  	  �  �  �  �  �  !  �  �  ?  �  �  �  �    y  u  k  b  V  U                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    @endsection @endpush </script> });     }          $(this).val(newval.substring(0,13));          else if(inputlen>=10&&numberslen==6&&input[9]=="-") newval+="-";         else if(inputlen>=6&&numberslen==3&&input[5]==" ") newval+=" ";         else if(inputlen>=5&&numberslen==3&&input[4]==")") newval+=" ";         else if(inputlen>=6&&numberslen==3&&input[4]==")"&&input[5]==" ") newval+=") ";         if(inputlen>=1&&numberslen==0&&input[0]=="(") newval="(";         // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.          }             else newval+=numbers[i];             else if(i==5) newval+=numbers[i];             else if(i==1) newval+=numbers[i];             if(i==0) newval="+"+numbers[i];         for(var i=0;i<numberslen;i++){         // Loop through the existing numbers and apply the mask          var newval = "";         // Value to store the masked input         var numberslen = numbers.length;         var numbers = this.value.replace(/\D/g,'');         // Get just the numbers in the input         var inputlen = input.length;         var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");         // Remove invalid chars from the input      if(event.which != 8){   // Don't run for backspace key entry, otherwise it bugs out 	$('#phone').keyup(function(){     }         return true;         $('#passwordconfirmError').hide();                  }             return false;             $('#passwordconfirmError').show();         if (password != confirmPassword) {         var confirmPassword = document.getElementById("password_confirm").value;         var password = document.getElementById("password").value;     function Validate() {          });             $('nav').toggleClass('scrolled', $(this).scrollTop() > 50); 			$(window).scroll(function() { <script>     <script src="{{ asset('front-end/js/app.js') }}"></script>     <script src="https://unpkg.com/lokijs@^1.5/build/lokijs.min.js"></script> @push("front-scripts")     		<!--end::Root--> 		</div> 		 		</div> 			<!--end::Authentication - Sign-in--> 			</div> 				</div> 					</div> 						<a href="#">Read More</a>--> 						</p> 						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,  						<!--<p> 