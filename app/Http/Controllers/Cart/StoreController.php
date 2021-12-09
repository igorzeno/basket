<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function __invoke(Request $request) {
        $data = Validator::make($request->all(), [
            'id' => 'required|integer|exists:products,id'
        ]);

        if ($data->fails()) {
            return json_encode(array('text'=>$data->errors()->all()));
        }
        else {
            $product = Product::where('id', $request->id)->first();

            if($product->cartBy(auth()->user())){
                return response(null, 409);
            }
            $cart = Cart::create([
                'product_id' => $request->id,
                'user_id' => auth()->user()->id
            ]);
            return json_encode(array( 'success'=> 'STORE'));
        }
    }
}
