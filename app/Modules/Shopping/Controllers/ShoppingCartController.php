<?php
namespace App\Modules\Shopping\Controllers;

use App\Model\tblhtml;
use App\Model\tblpost;
use App\Model\tblimage;
use App\Model\tblbanner;
use App\Model\tblproduct;
use App\Model\tblcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Defaults\stringProcessing;


class ShoppingCartController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request){
        //giỏ hàng
        $this->data['productNumberInTheCart']=0;
        $this->data['totalMoney']=0;
        if($request->session()->has('productInTheCart')){
            $this->data['productNumberInTheCart']=count($request->session()->get('productInTheCart'));
        }
        
        //so sánh ản phẩm
        $this->data['productNumberInTheCompare']=0;
        if($request->session()->has('productInTheCompare')){
            $this->data['productNumberInTheCompare']=count($request->session()->get('productInTheCompare'));
        }

        //sản phẩm ưa thích
        $this->data['productNumberInTheWishlist']=0;
        if($request->session()->has('productInTheWishlist')){
            $this->data['productNumberInTheWishlist']=count($request->session()->get('productInTheWishlist'));
        }
    }
    public function cart(Request $request){
		if($request->session()->has('productInTheCart') && 
			count($request->session()->get('productInTheCart'))>0){
			foreach($request->session()->get('productInTheCart') as $key=>$number){
				$listidproduct[]=$key;
			}
			$listproduct=tblproduct::query()
				->with('getSeo','getImages','getDetail')
				->whereIn('idproduct',$listidproduct)
				->get()->toArray();
			$this->data['listproduct']=$listproduct;
		}
		return view('Shopping::carts',$this->data);
    }

    public function wishlist(Request $request){
       if($request->session()->has('productInTheWishlist') && 
			count($request->session()->get('productInTheWishlist'))>0){
			foreach($request->session()->get('productInTheWishlist') as $key=>$number){
				$listidproduct[]=$key;
			}
			$listproduct=tblproduct::query()
				->with('getSeo','getImages','getDetail')
				->whereIn('idproduct',$listidproduct)
				->get()->toArray();
			$this->data['listproduct']=$listproduct;
		}
        return view('Shopping::wishlist',$this->data);
    }
    public function compare(Request $request){
       if($request->session()->has('productInTheCompare') && 
			count($request->session()->get('productInTheCompare'))>0){
			foreach($request->session()->get('productInTheCompare') as $key=>$number){
				$listidproduct[]=$key;
			}
			$listproduct=tblproduct::query()
				->with('getSeo','getImages','getDetail')
				->whereIn('idproduct',$listidproduct)
				->get()->toArray();
			$this->data['listproduct']=$listproduct;
		}
        return view('Shopping::compare',$this->data);
    }


    public function removecart(Request $request){
    	$request->session()->forget('productInTheCart.'.$request->idproduct);
    	return response()->json(['result'=>$request->idproduct]);
    }
    public function removecompare(Request $request){
        $request->session()->forget('productInTheCompare.'.$request->idproduct);
    	return response()->json(['result'=>$request->idproduct]);
    }
    public function removewishlist(Request $request){
        $request->session()->forget('productInTheWishlist.'.$request->idproduct);
    	return response()->json(['result'=>$request->idproduct]);
    }
}

?>