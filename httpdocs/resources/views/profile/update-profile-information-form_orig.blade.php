<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

		@if(Auth::user()->role == 'vendor')
		<!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Phone') }}" />
            <x-jet-input id="phone" onkeyup="checkPhone(this.value)"  pattern="[+]{1}[0-9]{12}" type="text" class="mt-1 block w-full add-resturant-phone" wire:model.defer="state.phone" autocomplete="phone" title="e.g: +390000000000"/>
            <x-jet-input-error for="phone" class="mt-2" />
			<p style="color:red;" id="phone-error"></p>
        </div>

		<!-- Zipcode -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="zipcode" value="{{ __('Zipcode') }}" />
            <x-jet-input id="zipcode" type="text" onkeyup="checkZipCode(this.value)"  class="mt-1 block w-full" wire:model.defer="state.zipcode" autocomplete="zipcode" />
            <x-jet-input-error for="zipcode" class="mt-2" />

			<p style="color:red;" id="zipcode-error"></p>
        </div>
		<!-- business_description -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="business_description" value="{{ __('Business description') }}" />
            <x-jet-input onkeyup="checkBusinessDescription(this.value)" id="business_description" type="text" class="mt-1 block w-full" wire:model.defer="state.business_description" autocomplete="business_description" />
            <x-jet-input-error for="business_description" class="mt-2" />
			<p style="color:red;" id="business-description-error"></p>
        </div>
		<!-- address -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="address" value="{{ __('Business Address') }}" />
            <x-jet-input onkeyup="checkaddress(this.value)" id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" autocomplete="address" />
            <x-jet-input-error for="address" class="mt-2" />
			<p style="color:red;" id="address-error"></p>
        </div>
				@if(Auth::user()->vendor_payment_password == NULL)
			<div class="col-span-6 sm:col-span-4">
				<x-jet-label for="vendor_payment_password" value="{{ __('Vendor Payment Password') }}" />
				<x-jet-input id="vendor_payment_password" type="password" class="mt-1 block w-full" wire:model.defer="state.vendor_payment_password" autocomplete="new-password" />
				<x-jet-input-error for="vendor_payment_password" class="mt-2" />
			</div>
			@endif
		@endif
		@if(Auth::user()->role == 'buyer')
		<!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Phone') }}" />
            <x-jet-input id="phone" onkeyup="checkPhone(this.value)"  type="text" wire:model.defer="state.phone" autocomplete="phone"  pattern="[+]{1}[0-9]{12}"  class="mt-1 block w-full add-resturant-phone" wire:model.defer="state.phone" autocomplete="phone" title="e.g: +390000000000"/>
            <x-jet-input-error for="phone" class="mt-2" />
			<p style="color:red;" id="phone-error"></p>
        </div>

		<!-- Zipcode -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="zipcode" value="{{ __('Zipcode') }}" />
            <x-jet-input id="zipcode" type="text" onkeyup="checkZipCode(this.value)"  class="mt-1 block w-full" wire:model.defer="state.zipcode" autocomplete="zipcode" />
            <x-jet-input-error for="zipcode" class="mt-2" />

			<p style="color:red;" id="zipcode-error"></p>
        </div>
		@endif
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo" id="btn-submit">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
<script>
  function checkPhone(phone)
		{
			   var PATTERN = "[+]{1}[0-9]{12}";

				if (phone.match(PATTERN)) {
				document.getElementById('phone-error').innerHTML = "";
					document.getElementById("btn-submit").disabled = false;
					return (true)

				}
				else{
				document.getElementById('phone-error').innerHTML = "Please follow this format ( e.g: +390000000000 )";
					document.getElementById("btn-submit").disabled = true;
					return (false)
				}
	}

	 function checkBusinessDescription(text)
		{

				if (text.length <= 0 || text.length > 100) {
				document.getElementById('business-description-error').innerHTML = "Business description letter length should be in 1 to 100!";
					document.getElementById("btn-submit").disabled = true;
					return (false)

				}
				else{
				document.getElementById('business-description-error').innerHTML = "";
					document.getElementById("btn-submit").disabled = false;
					return (true)
				}
	}
	 function checkaddress(text)
		{

				if (text.length <= 0 || text.length > 100) {
				document.getElementById('address-error').innerHTML = "Business address letter length should be in 1 to 100!";
					document.getElementById("btn-submit").disabled = true;
					return (false)

				}
				else{
				document.getElementById('address-error').innerHTML = "";
					document.getElementById("btn-submit").disabled = false;
					return (true)
				}
	}

	 function checkZipCode(text)
		{

				if (text.length <= 0) {
				document.getElementById('zipcode-error').innerHTML = "Please enter zipcode!";
					document.getElementById("btn-submit").disabled = true;
					return (false)

				}
				else{
				document.getElementById('zipcode-error').innerHTML = "";
					document.getElementById("btn-submit").disabled = false;
					return (true)
				}
	}


		$('.add-resturant-phone').keyup(function(){
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
