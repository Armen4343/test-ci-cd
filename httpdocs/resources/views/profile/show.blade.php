<x-app-layout>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

			@if ((Auth::user()->role == 'vendor') && (Auth::user()->vendor_payment_password != NULL))
                <div class="mt-10 sm:mt-0">
                
					<div class="md:grid md:grid-cols-3 md:gap-6">
						<div class="md:col-span-1 flex justify-between">
						<div class="px-4 sm:px-0">
							<h3 class="text-lg font-medium text-gray-900">Password Finanziaria</h3>

							<p class="mt-1 text-sm text-gray-600">
								Gestisci Password Finanziaria
							</p>
						</div>
							
					</div>

		<div class="mt-5 md:mt-0 md:col-span-2">
			<div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
				<div class="max-w-xl text-sm text-gray-600">
					<form action="{{ route('update.vendor.payment.password') }}" method="post">
						@csrf
						
						@if($errors->any())
							<div class="text-red-600">
								<p><strong>Qualcosa non va bene!</strong></p>
								<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
								</ul>
							</div>
						@endif
		<div class="col-span-6 sm:col-span-4">
            <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
			 Password Finanziaria Attuale
			</label>
            <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="vendor_payment_password" type="password" name="vendor_payment_password" required>
        </div>
		<div class="col-span-6 sm:col-span-4 mt-4" >
            <label class="block font-medium text-sm text-gray-700" for="new_vendor_payment_password">
			  Password Finanziaria Nuova
			</label>
            <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="new_vendor_payment_password" type="password" name="new_vendor_payment_password" required>
        </div>
		<div class="col-span-6 sm:col-span-4 mt-4" >
            <label class="block font-medium text-sm text-gray-700" for="confirm_vendor_payment_password">
			  Conferma Nuova Password Finanziaria
			</label>
            <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="confirm_vendor_payment_password" type="password" name="confirm_vendor_payment_password" required>
        </div>
 <button type="submit" class="inline-flex items-center px-4 py-2 mt-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
    Salva
</button>
</form>
			</div>
		</div>
		</div>
    </div>
</div>

                <x-jet-section-border />
            @endif
			
			
			
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-jet-section-border />
            @endif
			

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-jet-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
