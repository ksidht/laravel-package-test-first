<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Cashier\Cashier;
use App\Models\UserPaymentMethod;

class SubscriptionController extends Controller
{
    public function plans()
    {
        // Extra's

        // $stripe = auth()->user()->addPaymentMethod('pm_1M6uu3SA8qqKU7LUixR6RqEr');

        // $sub = auth()->user()->newSubscription(
        //     'default', 'price_1M4NZASA8qqKU7LUpKSUcGDl'
        // )->create('pm_1M6uu3SA8qqKU7LUixR6RqEr');

        // dd($sub);

        // Extra's
        return view('subscription.plan');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();
        $userStripe = auth()->user()->createOrGetStripeCustomer();

        $intent = $user->createSetupIntent();

        return view('subscription.checkout', [
            'intent' => $intent
        ]);
        // return checkout page view
    }

    /* 
    *   TO Improve
    *   1. Error handling
    *   2. Subscrition to product 
    *   3. Use dyanamic price name & subscrition name (pull it using stripe)
    */
    public function createSubscription(Request $request)
    {
        if ($request->id && $request->payment_method) {
            UserPaymentMethod::create([
                'setup_intent' => $request->id,
                'payment_method' => $request->payment_method
            ]);

            auth()->user()->addPaymentMethod($request->payment_method);

            $subscription = auth()->user()->newSubscription(
                'default', 'price_1M4NZASA8qqKU7LUpKSUcGDl'
            )->create($request->payment_method);


            return response()->json(['message' => 'Subscription is sucessfull']);
        }
    }

    public function subscribeSuccess()
    {
        return view('subscription.success');
    }
}
