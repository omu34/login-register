<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            {{--  @extends('layouts.app')

            @section('content')
            <div class="row justify-content-center mt-5">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">Register</div>
                        <div class="card-body">
                            <form action="{{ route('store') }}" method="post">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                        @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email
                                        Address</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                        @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                                </div>


                                <div class="mt-2">
                                    <x-label for="client_type" class="font-bold ml-0.5 uppercase text-green-500 text-lg" value="{{ __('Client registration:') }}" />

                                    <select name="client_type" id="client_type" class="w-full hover:shadow-sm  shadow-emerald-300 border-emerald-500  rounded-xl shadow-sm">
                                        <option value="2">Employer</option>
                                        <option value="3">Business</option>
                                    </select>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endsection  --}}

            <div class="mt-2">
                <x-label for="dealer_type" class="font-bold uppercase text-green-500 text-lg" value="{{ __('Fill First Four Input:') }}" />
            </div>
            <div>
                <x-input id="name" placeholder="Name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-2">
                <x-input id="email" placeholder="Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-2">
                <x-input id="password" placeholder="Password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-2">
                <x-input id="password_confirmation" placeholder="Confirm Password" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-2">
                <x-label for="client_type" class="font-bold ml-0.5 uppercase text-green-500 text-lg" value="{{ __('Client registration:') }}" />

                <select name="client_type" id="client_type" class="w-full hover:shadow-sm  shadow-emerald-300 border-emerald-500  rounded-xl shadow-sm">
                    <option value="2">Employer</option>
                    <option value="3">Business</option>
                </select>
            </div>

            <div class="mt-1" data-role="2" id="employer_fields" style="display: none;">
                <x-label for="employer_identity" class="font-bold" value="{{ __('Your Employership Reg. Number') }}" />
                <x-input id="employer_identity" class="block mt-1 w-full" type="text" name="employer_identity" />

                <x-label for="employer_coop_account_number" value="{{ __('Your 13 Digits COOP-BANK A/C Number?') }}" />
                <x-input id="employer_coop_account_number" class="block mt-1 w-full" type="text" :value="old('employer_coop_account_number')" name="employer_coop_account_number" />

                <x-label for="employer_phone_number" value="{{ __('Your Employership Phone Number') }}" />
                <x-input id="employer_phone_number" class="block mt-1 w-full" type="text" :value="old('employer_phone_number')" name="employer_phone_number" />

            </div>

              <div class="mt-1" data-role="3" id="business_fields" style="display: none;">
                <x-label for="business_identity" value="{{ __('Business Registration Number') }}" />
                <x-input id="business_identity" class="block mt-1 w-full" type="text" name="business_identity" />

                <x-label for="business_coop_account_number" value="{{ __('Your 13 Digits COOP-BANK A/C Number?') }}" />
                <x-input id="business_coop_account_number" class="block mt-1 w-full" type="text" :value="old('business_coop_account_number')" name="business_coop_account_number" />

                <x-label for="business_phone_number" value="{{ __('Business Number') }}" />
                <x-input id="business_phone_number" class="block mt-1 w-full" type="text" :value="old('business_phone_number')" name="business_phone_number" />

            </div>


            {{--



            <div class="mt-2">
                <x-label for="dealer_type" class="font-bold ml-0.5 uppercase text-green-500 text-lg" value="{{ __('Dealer Registration:') }}" />
                <select name="dealer_type" id="dealer_type" class="hover:shadow-sm w-full shadow-emerald-300 focus:border-green-500  rounded-xl shadow-sm">
                    <option value="4">Dealer</option>
                    <option value="5">Do you have Agents?</option>
                </select>
            </div>

            <div class="mt-1" data-role="4" id="dealer_fields" style="display: none;">
                <x-label for="dealer_identity" class="font-bold" value="{{ __('Your Dealership Number') }}" />
                <x-input id="dealer_identity" class="block mt-1 w-full" type="text" name="dealer_identity" />

                <x-label for="dealer_address" value="{{ __('Your Dealership Address') }}" />
                <x-input id="dealer_address" class="block mt-1 w-full" type="text" :value="old('dealer_address')" name="dealer_address" />

                <x-label for="dealer_phone_number" value="{{ __('Your Dealership Phone Number') }}" />
                <x-input id="dealer_phone_number" class="block mt-1 w-full" type="text" :value="old('dealer_phone_number')" name="your_phone_number" />

            </div>

            <div class="mt-1" data-role="5" id="agent_fields" style="display: none;">
                <x-label for="dealer_identity" class="font-bold" value="{{ __('Your Dealership Number') }}" />
                <x-input id="dealer_identity" class="block mt-1 w-full" type="text" name="dealer_identity" />

                <x-label for="agent_identity" value="{{ __('Your Agents Job Identity Number') }}" />
                <x-input id="agent_identity" class="block mt-1 w-full" type="text" name="agent_identity" />

                <x-label for="agent_phone_number" value="{{ __('Your Agents Phone Number') }}" />
                <x-input id="agent_phone_number" class="block mt-1 w-full" type="text" :value="old('agent_phone_number')" name="agent_phone_number" />

                <x-label for="agent_location" value="{{ __('Your Agents Location') }}" />
                <x-input id="agent_location" class="block mt-1 w-full" type="text" :value="old('agent_location')" name="agent_location" />
            </div>

            <div class="mt-2">
                <x-label for="employee_type" class="font-bold ml-0.5 uppercase text-green-500 text-lg" value="{{ __(' COOP Bank Employees:') }}" />
                <select name="employee_type" id="employee_type" class="hover:shadow-sm w-full shadow-emerald-300 focus:border-green-500  rounded-xl shadow-sm">
                    <option value="6">Employee</option>
                </select>
            </div>

            <div class="mt-1" data-role="6" id="employee_fields" style="display: none;">
                <x-input id="employee_job_id" placeholder="Job Identity" class="block mt-1 w-full text-black" type="text" name="employee_job_id" />

                <x-input id="employee_title" placeholder="Job Title" class="block mt-1 w-full" type="text" name="employee_title" />


            </div>--}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    function toggleFields() {
                        var clientType = document.getElementById('client_type').value;
                       //  var dealerType = document.getElementById('dealer_type').value;
                        //var employeeType = document.getElementById('employee_type').value;


                        // Hide all fields initially
                        document.querySelectorAll('[data-role]').forEach(function(field) {
                            field.style.display = 'none';
                        });

                        // Show fields based on selected client type
                        document.querySelectorAll('[data-role="' + clientType + '"]').forEach(function(field) {
                            field.style.display = 'block';
                        });

                        // Show fields based on selected dealer type
                      //  document.querySelectorAll('[data-role="' + dealerType + '"]').forEach(function(field) {
                       //     field.style.display = 'block';
                       // });
                        // Show fields based on selected employee type
                       // document.querySelectorAll('[data-role="' + employeeType + '"]').forEach(function(field) {
                          //  field.style.display = 'block';
                       // });
                    }

                    // Call toggleFields() initially to set up the form
                    toggleFields();

                    // Listen for changes in the 'client_type' select element
                    document.getElementById('client_type').addEventListener('change', function() {
                        toggleFields();
                    });

                    // Listen for changes in the 'dealer_type' select element
                    //document.getElementById('dealer_type').addEventListener('change', function() {
                      //  toggleFields();
                   // });
                    // Listen for changes in the 'employee_type' select element
                    //document.getElementById('employee_type').addEventListener('change', function() {
                      //  toggleFields();
                    //});
                });

            </script>



            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="mt-4">
                <!-- Terms and Privacy Policy checkboxes -->
            </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>



{{-- @extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="{{ route('store') }}" method="post">
@csrf
<div class="mb-3 row">
    <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
    <div class="col-md-6">
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
        @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
        @endif
    </div>
</div>
<div class="mb-3 row">
    <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email
        Address</label>
    <div class="col-md-6">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
        @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
    </div>
</div>
<div class="mb-3 row">
    <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label>
    <div class="col-md-6">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
        @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
    </div>
</div>
<div class="mb-3 row">
    <label for="password_confirmation" class="col-md-4 col-form-label text-md-end text-start">Confirm Password</label>
    <div class="col-md-6">
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
</div>
<div class="mb-3 row">
    <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
</div>


<div class="mt-2">
    <x-label for="client_type" class="font-bold ml-0.5 uppercase text-green-500 text-lg" value="{{ __('Client registration:') }}" />

    <select name="client_type" id="client_type" class="w-full hover:shadow-sm  shadow-emerald-300 border-emerald-500  rounded-xl shadow-sm">
        <option value="2">Employer</option>
        <option value="3">Business</option>
    </select>
</div>

</form>
</div>
</div>
</div>
</div>
@endsection --}}
