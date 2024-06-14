<!-- addRestaurantModal -->
<div class="modal fade" id="addRestaurantModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Aggiungi il tuo punto vendita</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="regForm" action="">
                    @csrf
                    <!-- One "tab" for each step in the form: -->
                    <!--1-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome </label>
                            <input type="text" placeholder="Nome " oninput="this.className = 'form-control'"
                                   class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Descrizione</label>
                            <textarea placeholder="Descrizione " onkeyup="checkBusinessDescription(this.value)"
                                      oninput="this.className = 'form-control'" class="form-control"
                                      name="Enter Business description"></textarea>
                            <p class="text-danger" id="business-description-error"></p>
                        </div>
                    </div>
                    <!--2-->
                    <div class="tab">
                        <div class="row">
                            <div class="col-md-8 mb-3 ">
                                <label for="address" class="form-label">Indirizzo</label>
                                <input type="text" placeholder="Indirizzo" oninput="this.className = 'form-control'"
                                       class="form-control" name="address">
                            </div>
                            <div class="col-md-4 mb-3 ">
                                <label for="address" class="form-label">Numero</label>
                                <input type="text" placeholder="000" oninput="this.className = 'form-control'"
                                       class="form-control" name="street_number">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Citta’</label>
                            <select id="city" required class="form-select cities-tb-model" name="city">
                                <option value="" data-id="0" readonly selected disabled>Seleziona la Citta'</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Codice Postale</label>
                            <input type="number" name="zipcode" min="0" placeholder="Codice Postale"
                                   oninput="this.value = !!this.value && this.value < 0 ? this.value * -1 : this.value"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Regione</label>
                            <select onchange="filterCitiesModal(this)" name="state" required class="form-select">
                                <option value="" selected>Seleziona</option>

                                <option value="Abruzzo" data-id="1679">Abruzzo</option>
                                <option value="Basilicata" data-id="1706">Basilicata</option>
                                <option value="Calabria" data-id="1703">Calabria</option>
                                <option value="Campania" data-id="1669">Campania</option>
                                <option value="Emilia-Romagna" data-id="1773">Emilia-Romagna</option>
                                <option value="Friuli–Venezia Giulia" data-id="1756">Friuli–Venezia Giulia</option>
                                <option value="Lazio" data-id="1678">Lazio</option>
                                <option value="Liguria" data-id="1768">Liguria</option>
                                <option value="Lombardy" data-id="1705">Lombardia</option>
                                <option value="Marche" data-id="1670">Marche</option>
                                <option value="Molise" data-id="1695">Molise</option>
                                <option value="Piedmont" data-id="1702">Piemonte</option>
                                <option value="Sardinia" data-id="1715">Sardegna</option>
                                <option value="Sicily" data-id="1709">Sicilia</option>
                                <option value="Trentino-South Tyrol" data-id="1725">Trentino-South Tyrol</option>
                                <option value="Toscana" data-id="1664">Toscana</option>
                                <option value="Umbria" data-id="1683">Umbria</option>
                                <option value="Veneto" data-id="1753">Veneto</option>
                                <option value="Valle d'Aosta" data-id="1716">Valle d'Aosta</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="country" class="form-label">Paese</label>
                            <select id="country" required class="form-select" name="country">
                                <option value="IT" selected>Italy</option>
                            </select>
                        </div>

                    </div>
                    <!--3-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Nome e Cognome, o Denominazione Sociale</label>
                            <input type="text" placeholder="Nome e Cognome, o Denominazione Sociale "
                                   oninput="this.className = 'form-control'" class="form-control" name="company_name">
                        </div>
                        <div class="mb-3">
                            <label for="tax_id" class="form-label">Codice Fiscale</label>
                            <input
                                type="text"
                                name="tax_id"
                                placeholder="MRTMTT91D08F205J"
                                class="form-control"
                                maxlength="16"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="vat_number" class="form-label">Partita IVA</label>
                            <input
                                type="number"
                                name="vat_number"
                                class="form-control"
                                placeholder="07643520567"
                                maxlength="11"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);this.value = !!this.value && this.value < 0 ? this.value * -1 : this.value"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="sdi_code" class="form-label">Codice SDI</label>
                            <input
                                type="text"
                                name="sdi_code"
                                placeholder="Codice SDI"
                                class="form-control"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="pec" class="form-label">PEC</label>
                            <input
                                type="email"
                                name="pec"
                                placeholder="PEC"
                                class="form-control"
                                onkeyup="checkEmail(this.value, false)"
                            >
                            <p class="text-danger" id="pec-error"></p>
                        </div>
                    </div>
                    <!--4-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Logo (opzionale)</label>
                            <input type="file" name="profile_photo_path" oninput="this.className = 'form-control'"
                                   class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Banner (opzionale)</label>
                            <input type="file" name="banner_photo_path" oninput="this.className = 'form-control'"
                                   class="form-control">
                        </div>
                    </div>
                    <!--5-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="email" name="email" placeholder="email"
                                   onkeyup="checkEmail(this.value)" oninput="this.className = 'form-control'"
                                   class="form-control">
                            <p class="text-danger" id="email-error"></p>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Telefono</label>
                            <input type="text" name="phone" placeholder="+390000000000" onkeyup="checkPhone(this.value)"
                                   pattern="[+]{1}[0-9]{12}" oninput="this.className = 'form-control'"
                                   title="e.g: +390000000000" class="form-control add-resturant-phone" value="+39">
                            <p class="text-danger" id="phone-error"></p>
                        </div>
                        <div class="mb-3">
                            <label for="manager_name" class="form-label">Nome del gestore</label>
                            <input type="text" placeholder="Nome del gestore" oninput="this.className = 'form-control'"
                                   class="form-control" name="manager_name">
                        </div>
                    </div>
                    <!--6-->
                    <div class="tab">
                        <div class="mb-3">
                            <label for="name" class="form-label">Password</label>
                            <input name="password" required type="password" id="password" value="{{old('password')}}"
                                   oninput="this.className = 'form-control'" class="form-control"
                                   placeholder="Entra Password" onkeyup="validatePassword(event)">
                            <div class="d-none my-2" style="color:red;" id="password-error">La password deve essere di almeno 8 caratteri
                              
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Conferma Password</label>
                            <input placeholder="conferma password" id="password_confirm"
                                   value="{{old('password_confirm')}}" type="password" required name="password_confirm"
                                   oninput="this.className = 'form-control'" onkeyup="checkPassword(this.value)"
                                   class="form-control" placeholder="Nuova Password">
                            <div class="d-none alert alert-danger" id="password-confirmation-error"></div>
                            <p class="text-danger" id="password-c-error"></p>
                        </div>
                    </div>
                    <!--7-->
                    <div class="tab">

                        <div class="mb-3 d-flex">
                            <input type="checkbox" value="yes" class="form-check-input me-1" name="termsandconditions"
                                   id="termsandconditions" required>
                            @php
                                $termsAndConditions = App\Models\TermsAndConditions::first();
                            @endphp
                            <label>Cliccando qui, confermo di aver letto e accettato i termini e le condizioni di ZeepUp <br/>
                                <a href="terms-and-conditions/{{$termsAndConditions['terms_and_condition']}}"
                                   class="text-decoration-none" target="_blank">Termini e Condizioni</a> e
                                <a href="terms-and-conditions/{{$termsAndConditions['privacy_policy']}}"
                                   class="text-decoration-none" target="_blank">La Politica sui Cookies</a>. </label>
                        </div>

                        <p class="text-danger" id="termsandconditions-error"></p>
                    </div>


                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <button type="button" id="skipBtn" onclick="nextPrev(1)" class="btn btn-dark"
                                    style="background:#000000;display:none;">Skip
                            </button>
                            <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-secondary">
                                Precedente
                            </button>
                            <button type="button" id="nextBtn" onclick="nextPrev(1)" class="btn btn-danger">Successiva
                            </button>
                        </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>

                </form>
            </div>
            {{-- <div class="modal-footer">
                 <div class="alert alert-danger print-error-msg" style="display:none">
                   <ul></ul>
                 </div>
               <button type="button" class="btn bg-white text-dark shadow rounded-0" data-bs-dismiss="modal">Chiudi</button>
               <button type="button" class="btn btn-dark shadow rounded-0">Salva</button>
             </div>--}}
        </div>
    </div>
</div>
<style>
    .btn.show, .btn:first-child:active {
        border-color: transparent;
    }
</style>
<nav class="navbar py-2">
    <div class="container-fluid">
        <div>
            <!--elisa<button class="navbar-toggler nav-icon border-none" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    style="vertical-align: bottom;">
                <div><i class="fa-solid fa-bars border-none"></i> 
                </div>elisa-->
            </button>
            <a class="flex-start " style="text-align: bottom;transform: scale.2)" href="https://www.zeepup.com"><img
                    src="{{ secure_asset('front-end/images/logo.png')}}"  alt="" class="nav-logo" width="700px";
  height="auto";></a>

        </div>




  <div class="d-flex mt-2 mt-md-4">
<!-- elisa <a href="https://www.zeepup.com/it" style="text-decoration:underline;color:black;"><i class="fa fa-house" style="text-decoration:none; color:#ffbf00"></i>  Homepage </a></i>&nbsp&nbsp&nbsp
            &nbsp<div> elisa -->
<a href="#" style="text-decoration:none;color:white" class="signup btn" data-bs-toggle="modal" data-bs-target="#addRestaurantModal" <h2> Aggiungi il tuo negozio</h2> </a>  &nbsp&nbsp&nbsp&nbsp
<!-- elisa <a href="{{ secure_url(route('register')) }}"  style="text-decoration:none;color:black;"  <h3> Registrati </h3> </a> </div>&nbsp&nbsp&nbsp&nbsp
elisa -->
            <div>
                @if (Auth::check())
                    <a href="{{ secure_url(route('logout')) }} " class="login me-1 shadow  btn"
                       style="text-decoration:none;color:black;">
                        <i class="fa-solid fa-user pe-2 bg-white login-icon"></i><span class="login-text bg-white">
						 Disconnetti</span>

                    @if(Auth::user()->role == 'buyer')
                        <a href="{{route('buyer.dashboard')}}" class="signup btn text-capitalize"
                           style="text-decoration:none;color:white;">
                            {{ Auth::user()->name }}
                        </a>
                    @else
                        <a href="{{route('dashboard')}}" class="signup btn text-capitalize"
                           style="text-decoration:none;color:white;">
                            {{ Auth::user()->name }}
                        </a>
                    @endif

                @else


                    <a href="{{route('login')}}" class="signup btn" style="text-decoration:none;color:white;">
                    <h5><i class="fa-solid fa-user"></i>
                        Accedi</h5></a>

                @endif
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </div>
        </div>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasDarkNavbar"
             aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header ">
                <h5 class="offcanvas-title " id="offcanvasDarkNavbarLabel"><img
                        src="{{ secure_asset('front-end/images/logo.png') }}" alt=""
                        class="nav-logo-side"></h5>
                <button type="button" class="btn-close  btn-close-dark" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body  d-flex flex-column align-items-center  text-center">
                <ul class="navbar-nav ">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal"
                                            data-bs-target="#aboutUsModal">Chi siamo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                                            data-bs-target="#addRestaurantModal">
                            Aggiungi il tuo store</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="#" data-bs-toggle="modal"
                                            data-bs-target="#contactUsModal">Contattaci</a></li>

                </ul>


                <a href="{{route('login')}}">
                    <button class="login-btn me-1 shadow "><i class="fa-solid fa-user pe-2 bg-white "></i><span
                            class="bg-white">Accedi</span></button>
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    function validatePassword(e) {
        passwordError = $("#password-error");
        if (e.target.value.length >= 8) {
            passwordError.addClass("d-none")
        } else {
            passwordError.removeClass("d-none")
        }
    }

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
        // This function will display the specified tab of the form...
        var x = document.getElementsByClassName("tab");
        x[n].style.display = "block";
        //... and fix the Previous/Next buttons:
        if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
        } else {
            document.getElementById("prevBtn").style.display = "inline";
        }
        if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Invia";
        } else {
            document.getElementById("nextBtn").innerHTML = "Prossima";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(n)
    }

    function nextPrev(n) {
        // This function will figure out which tab to display
        var x = document.getElementsByClassName("tab");
        // Exit the function if any field in the current tab is invalid:
        if (n == 1 && !validateForm()) return false;
        // Hide the current tab:
        x[currentTab].style.display = "none";
        // Increase or decrease the current tab by 1:
        currentTab = currentTab + n;

        if (currentTab == 3) {
            document.getElementById("skipBtn").style.display = "inline";
        } else {
            document.getElementById("skipBtn").style.display = "none";
        }
        // if you have reached the end of the form...
        if (currentTab >= x.length) {
            // ... the form gets submitted:
            //document.getElementById("regForm").submit();
            $("#nextBtn").attr("disabled", "disabled");
            $.ajax({
                // url: $(this).attr('action'),
                url: "{{ route('register.vendor.ajax') }}",
                type: "POST",
                data: new FormData(document.getElementById("regForm")),
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        Swal.fire({
                            text: data.success,
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-danger"
                            }
                        })
                        $("#nextBtn").removeAttr("disabled");
                        $('#offcanvasDarkNavbar').offcanvas('hide');
                        $('#addRestaurantModal').modal('hide');
                        currentTab = 0;
                        showTab(currentTab);
                        form.reset();

                    } else {
                        printErrorMsg(data.error);
                    }
                },
                error: function (e) {
                    console.log(e);
                }
            });

            return;


            //return false;
        }
        // Otherwise, display the correct tab:
        showTab(currentTab);
    }

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function (key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }

    function validateForm() {
        // This function deals with validation of the form fields
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].querySelectorAll("input,select,textarea");
        // y = x[currentTab].getElementsByTagName("input");
        // A loop that checks every input field in the current tab:
        for (i = 0; i < y.length; i++) {
            if (y[i].name == 'business_description') {
                valid = checkBusinessDescription(y[i].value);
            } else if (y[i].name == 'email') {
                valid = checkEmail(y[i].value);
            } else if (y[i].name == 'phone') {
                valid = checkPhone(y[i].value)
            } else if (y[i].name == 'password' || y[i].name == 'password_confirm') {
                valid = checkPassword()
            } else if (y[i].name == 'termsandconditions') {
                if (document.getElementById('termsandconditions').checked) {
                    document.getElementById('termsandconditions-error').innerHTML = "";
                    valid = true
                } else {
                    document.getElementById('termsandconditions-error').innerHTML = "You didn't check it!";
                    valid = false
                }
            }
            if (!valid) {
                return valid;
            }
            // If a field is empty...
            if (y[i].value == "" && (y[i].name != 'profile_photo_path' && y[i].name != 'banner_photo_path' && y[i].name != 'vat_number' && y[i].name != 'sdi_code')) {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false
                valid = false;
                break;
            } else {
                y[i].classList.remove("invalid");
            }
        }
        // If the valid status is true, mark the step as finished and valid:
        if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
        }
        return valid; // return the valid status
    }


    function fixStepIndicator(n) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");
        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }
        //... and adds the "active" class on the current step:
        x[n].className += " active";
    }

    // Nomi

    var temp_status = (true);

    function checkEmail(mail, isFetch = true) {

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
            document.getElementById('email-error').innerHTML = "";
            document.getElementById('pec-error').innerHTML = "";
            $('#nextBtn').removeAttr('disabled');
            if (isFetch) {
                var url = "register/vendor/check/email/ajax";
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json', // added data type
                    data: {
                        "email": mail,
                        _token: CSRF_TOKEN
                    },
                    success: function (result) {
                        if (result.success) {
                            document.getElementById('email-error').innerHTML = "";
                            temp_status = (true);
                        } else {
                            document.getElementById('email-error').innerHTML = "email gia' registrata";
                            temp_status = (false);
                        }
                    }
                });
                return temp_status
            }
        } else {
            if (isFetch) {
                document.getElementById('email-error').innerHTML = "Indirizzo email non valido";
            } else {
                document.getElementById('pec-error').innerHTML = "Indirizzo email non valido"
                $('#nextBtn').attr('disabled', 'disabled');
            }
            return (false)
        }
    }

    function checkPhone(phone) {
        var PATTERN = "[+]{1}[0-9]{12}";

        if (phone.match(PATTERN)) {
            document.getElementById('phone-error').innerHTML = "";
            return (true)

        } else {
            document.getElementById('phone-error').innerHTML = "Per favore scrivi questo formato (e.g: +390000000000)";
            return (false)
        }
    }

    function checkBusinessDescription(text) {

        if (text.length <= 0 || text.length > 100) {
            document.getElementById('business-description-error').innerHTML = "Descrizione massimo 100 caratteri";
            return (false)

        } else {
            document.getElementById('business-description-error').innerHTML = "";
            return (true)
        }
    }

    function checkPassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("password_confirm").value;
        if (password != confirmPassword) {
            document.getElementById('password-c-error').innerHTML = "La password non coincide";
            return false;
        }
        document.getElementById('password-c-error').innerHTML = "";
        return true;
    }
</script>

<script src="https://unpkg.com/lokijs@^1.5/build/lokijs.min.js"></script>
<script>
    var db = new loki("csc.db");

    const countriesJSON =
        "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/countries.json";
    const statesJSON =
        "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/states.json";
    const citiesJSON =
        "https://raw.githubusercontent.com/dr5hn/countries-states-cities-database/master/cities.json";

    async function initializeData() {
        var countries = db.getCollection("countries");
        if (!countries) {
            countries = db.addCollection("countries");
            await fetch(countriesJSON)
                .then((response) => response.json())
                .then(async (data) => {
                    await data.forEach((c) => {
                        countries.insert(c);
                    });
                    $(".countries-tb").html(
                        `<tr> <td class="border px-4 py-2">United States - US</td></tr>`
                    );
                });
        }

        var states = db.getCollection("states");
        if (!states) {
            states = db.addCollection("states");
            await fetch(statesJSON)
                .then((response) => response.json())
                .then(async (data) => {
                    await data.forEach((d) => {
                        states.insert(d);
                    });
                });
        }

        var cities = db.getCollection("cities");
        if (!cities) {
            cities = db.addCollection("cities");
            await fetch(citiesJSON)
                .then((response) => response.json())
                .then(async (data) => {
                    await data.forEach((d) => {
                        cities.insert(d);
                    });
                });
        }
    }

    initializeData();

    async function filterCitiesModal($sid = null) {
        $sid = $sid.querySelector(":checked").getAttribute("data-id");
        let citiesColl = db.getCollection("cities");
        let cities = await citiesColl.find({state_id: parseInt($sid)});
        let $cities = $(".cities-tb-model");
        $cities.html("");
        if (cities.length) {
            await cities.forEach((c) => {
                $cities.append(`
      <option value="${c.name}">${c.name}</option>
      `);
            });
        } else {
            $cities.append(`
      <option value="No Cities Found.">No Cities Found.</option>
      `);
        }
    }

    async function filterCities($sid = null) {
        $sid = $sid.querySelector(":checked").getAttribute("data-id");
        let citiesColl = db.getCollection("cities");
        let cities = await citiesColl.find({state_id: parseInt($sid)});
        let $cities = $(".cities-tb");
        $cities.html("");
        if (cities.length) {
            await cities.forEach((c) => {
                $cities.append(`
      <option value="${c.name}">${c.name}</option>
      `);
            });
        } else {
            $cities.append(`
      <option value="No Cities Found.">No Cities Found.</option>
      `);
        }
    }


    $('.add-resturant-phone').keyup(function () {
        // Don't run for backspace key entry, otherwise it bugs out
        if (event.which != 8) {

            // Remove invalid chars from the input
            var input = this.value.replace(/[^0-9\(\)\s\-]/g, "");
            var inputlen = input.length;
            // Get just the numbers in the input
            var numbers = this.value.replace(/\D/g, '');
            var numberslen = numbers.length;
            // Value to store the masked input
            var newval = "";

            // Loop through the existing numbers and apply the mask
            for (var i = 0; i < numberslen; i++) {
                if (i == 0) newval = "+" + numbers[i];
                else if (i == 1) newval += numbers[i];
                else if (i == 5) newval += numbers[i];
                else newval += numbers[i];
            }

            // Re-add the non-digit characters to the end of the input that the user entered and that match the mask.
            if (inputlen >= 1 && numberslen == 0 && input[0] == "(") newval = "(";
            else if (inputlen >= 6 && numberslen == 3 && input[4] == ")" && input[5] == " ") newval += ") ";
            else if (inputlen >= 5 && numberslen == 3 && input[4] == ")") newval += " ";
            else if (inputlen >= 6 && numberslen == 3 && input[5] == " ") newval += " ";
            else if (inputlen >= 10 && numberslen == 6 && input[9] == "-") newval += "-";

            $(this).val(newval.substring(0, 13));

        }
    });


</script>



