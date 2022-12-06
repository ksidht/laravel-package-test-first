<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Cashier\Cashier;


class StripeController extends Controller
{

    public function __invoke()
    {
        // ...
    }

    public function index()
    {
        $user = Cashier::findBillable();
        dd($user);

    }

    public function createCustomer()
    {
        $user = User::find(1);
        $striprCustomer = $user->createAsStripeCustomer();
        dd($striprCustomer);
        return  view('features.create');
    }

    public function retrieveCustomer()
    {
        $user = User::find(1);
        $striprCustomer = $user->asStripeCustomer();
        dd($striprCustomer);
    }

    public function balanceCustomer()
    {
        $user = User::find(1);
        $striprCustomer = $user->balance();
        dd($striprCustomer);
    }

    public function redirectToBillingPortal()
    {
        $user = User::find(1);
        $user->redirectToBillingPortal();
    }
}
