<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;

class HomeController extends Controller
{
    private $product;
    private $store;

    public function __construct(Product $product, Store $store)
    {
        $this->product = $product;
        $this->store = $store;
    }

    public function index() 
    {
        $products = $this->product->limit(6)->orderBY('id', 'DESC')->get();
        $stores = $this->store->limit(3)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('products', 'stores'));
    }

    public function single($slug)
    {
        $product = $this->product->whereSlug($slug)->first();

        return view('product', compact('product'));
    }
}
