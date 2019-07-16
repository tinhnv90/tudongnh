<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\carbon;
use App\Model\tblseo;
use App\Model\tblpost;
use App\Http\Requests;
use App\Model\tblimage;
use App\Model\tblbanner;
use App\Model\tblproduct;
use App\Model\tblproducer;
use App\Model\tblcategory;
use Illuminate\Http\Request;
use App\Model\tblproductDetail;
use App\Model\tblinvoiceDetail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Defaults\postProcessing;
use App\Http\Controllers\Defaults\menuProcessing;
use App\Http\Controllers\Defaults\productProcessing;
use App\Http\Controllers\Defaults\stringProcessing;

class PostAjax extends Controller
{
    public function choosecompare(Request $request){
        if($request->session()->has('numCompare') && 
                $request->session()->has('numCompare.'.$request->idproduct)){
            $request->session()->forget('numCompare.'.$request->idproduct);
        }else{
            $request->session()
                ->push('numCompare.'.$request->idproduct,$request->idproduct);
        }
    }
    public function addcart(Request $request){
        if($request->session()->has('productInCart') && 
                $request->session()->has('productInCart.'.$request->idproduct)){
            $request->session()->forget('productInCart.'.$request->idproduct);
        }else{
            $request->session()->push('productInCart.'.$request->idproduct,$request->price);
        }
    }
}
