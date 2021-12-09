<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Product;


class IndexController extends Controller
{
    public function __invoke()
    {
        $products = Product::paginate(4);
        $total = 0;
        if(auth()->user()){
            $total = auth()->user()->cart()->count();
        }
        return view('main.index', compact('products', 'total'));
    }
}
