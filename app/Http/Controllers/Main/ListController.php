<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cheque;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ListController extends Controller {

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function __invoke()
    {
        if(!auth()->user()){
            return response(null, 409);
        }
        $user_id = auth()->user()->id;
        $total = auth()->user()->cart()->count();
//        DB::enableQueryLog();
        $cart = Cart::where('carts.user_id', $user_id)->with(['products'])->orderBy('carts.id', 'ASC')->get();
//        dd(DB::getQueryLog());

        return view('list.index', compact('cart', 'total'));
    }
}
