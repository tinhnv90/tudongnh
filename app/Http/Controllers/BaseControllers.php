<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BaseControllers extends Controller
{
    public function add_cart(Request $request){
        if($request->session()->has('productInTheCart') && 
                $request->session()->has('productInTheCart.'.$request->idproduct)){
            $request->session()->forget('productInTheCart.'.$request->idproduct);
            if(count($request->session()->get('productInTheCart'))==0)
                $request->session()->forget('productInTheCart');
        	$result='Đã Hủy Chọn Hàng';
        }else{
            $request->session()->push('productInTheCart.'.$request->idproduct,$request->productNumber);
            $result='Đã Chọn Hàng';
        }
        return response()->json(['result'=>$result]);
    }

    public function add_wishlist(Request $request){
        if($request->session()->has('productInTheWishlist') && 
                $request->session()->has('productInTheWishlist.'.$request->idproduct)){
            $request->session()->forget('productInTheWishlist.'.$request->idproduct);
            if(count($request->session()->get('productInTheWishlist'))==0)
                $request->session()->forget('productInTheWishlist');
            $result='Đã Hủy Chọn Hàng';
        }else{
            $request->session()->push('productInTheWishlist.'.$request->idproduct,1);
            $result='Đã Chọn Hàng';
        }
        return response()->json(['result'=>$result]);
    }

    public function add_compare(Request $request){
        if($request->session()->has('productInTheCompare') && 
                $request->session()->has('productInTheCompare.'.$request->idproduct)){
            $request->session()->forget('productInTheCompare.'.$request->idproduct);
            if(count($request->session()->get('productInTheCompare'))==0)
                $request->session()->forget('productInTheCompare');
            $result='Đã Hủy Chọn Hàng';
        }else{
            $request->session()->push('productInTheCompare.'.$request->idproduct,1);
            $result='Đã Chọn Hàng';
        }
        return response()->json(['result'=>$result]);
    }
}
