<?php

namespace App\Http\Controllers;

class UserOrderController extends Controller
{
    public function index()
    {
        $userOrders = auth()->user()->orders()->paginate(10);

        return view('user_orders', compact('userOrders'));
    }
}
