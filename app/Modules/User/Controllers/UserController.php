<?php
namespace App\Modules\User\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
	public $data;
	function __construct(Request $request)
	{
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
	public function login(){
		$this->middleware('auth');
		return view('User::login',$this->data);
	}
	public function post_login(){
		return view('User::login',$this->data);
	}

	public function register(){
		return view('User::login',$this->data);
	}
	public function post_register(){
		return view('User::login',$this->data);
	}
}
?>