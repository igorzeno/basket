<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DeleteController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function __invoke(Request $request) {
        $data = Validator::make($request->all(), [
            'id' => 'required|integer|exists:carts,product_id'
        ]);
        if ($data->fails()) {
            return json_encode(array('text'=>$data->errors()->all()));
        }
        auth()->user()->cart()->where('product_id', $request->id)->delete();

        return json_encode(array( 'success'=> 'DELETE'));
    }
}
