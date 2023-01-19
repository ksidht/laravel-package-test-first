<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 bg-white border-b border-gray-200">
                    Checkout
                </div>

                <div class="max-w-3xl">

                <div className="mt-6">
                    <label htmlFor="card-holder-name" className="block text-sm font-medium text-gray-700">
                    Email address
                    </label>
                    <div className="mt-1">
                    <input
                        type="text"
                        id="card-holder-name"
                        name="card-holder-name"
                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    />
                    </div>
                </div>                

                <input id="card-holder-name" type="text">
 
                <!-- Stripe Elements Placeholder -->
                <div id="card-element"></div>
                
                <button id="card-button" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </button>


                </div>




            </div>
        </div>
    </div>


</x-app-layout>
