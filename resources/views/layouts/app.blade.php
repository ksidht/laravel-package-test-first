<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
          
        </div>

        <script src="https://js.stripe.com/v3/"></script>

        <script>
            console.log(sid)
            const stripe = Stripe('pk_test_51M1nmLSA8qqKU7LU7UckY4vtW2uJ7CBB9v8gGt3vAjoUaxNTre0MA2Tg2jCirtKge2q1l8nQ1FxFt2e1YNaYDG9V00nv9vxnlV');

            const elements = stripe.elements();
            const cardElement = elements.create('card');

            cardElement.mount('#card-element');
        </script>

        <script>
            const cardHolderName = document.getElementById('card-holder-name');
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;
            
            cardButton.addEventListener('click', async (e) => {
                const { setupIntent, error } = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );
            
                if (error) {
                    console.log(error)
                } else {
                    console.log(setupIntent)
                    axios.post("{{ route('subscription.subscribe')}}", {
                        id: setupIntent.id,
                        payment_method: setupIntent.payment_method,
                    }).then((res) => {
                        window.location.href = "{{ route('subscription.success') }}";
                    }).catch((err) => {
                        console.log(err)
                    })


                }
            });            
        </script>

    </body>
</html>
