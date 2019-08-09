<?php
namespace App\Modules\User\Controllers;

use Auth;
use App\User;
use Validator;
use App\Model\tblinvoice;
use App\Model\tblinvoiceDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class UserController extends Controller
{
	public $data;
	function __construct(Request $request)
	{
		if(Auth::check() && Auth::user()->type==68)
			Auth::logout();
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
		return view('User::login',$this->data);
	}
	public function post_login(Request $request){
		$rules=[
			'email'=>'required|email',
			'password'=>'required|min:6'
		];
		$messeger=[
			'email.required'=>'Bạn chưa nhập thông tin tài khoản ',
			'email.email'=>'Email không hợp lệ vd:vinakitchen.net@gmail.com',
			'password.required'=>'Bạn chưa nhập Mật Khẩu',
			'password.min'=>'Độ dài mât khẩu phải lớn hơn 6 ký tự'
		];
		$validator=validator::make($request->all(),$rules,$messeger);
		if($validator->fails()){
			return view('User::login',$this->data)->withErrors($validator);
		}

		if(Auth::attempt([
			'email'=>$request->email,
			'password'=>$request->password,
			'type'=>0
		])){
			return redirect('/');
		}

		return redirect('/dang-nhap')->with('fails','Sai Tài Khoản Hoặc Mật Khẩu');
	}
	public function logout(){
		if(Auth::check()){
			Auth::logout();
			return redirect('/dang-nhap');
		}
		return redirect('/');
		
	}
	public function register(){
		return view('User::login',$this->data);
	}
	public function post_register(Request $request){
		$rules=[
			'email'=>'required|email|unique:users',
			'password'=>'required|confirmed|min:6',
			'password_confirmation'=>'required|min:6',
			'phone' => 'required|numeric|digits:10',
			'year'=>'numeric|digits:4'
		];
		$messeger=[
			'email.required'=>'Bạn chưa nhập thông tin tài khoản',
			'email.email'=>'Email không hợp lệ. vd: vinakitchen.net@gmail.com',
			'email.unique'=>'Email đã tồn tại',
			'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
			'password.confirmed'=>'Nhắc lại mật khẩu không chính xác',
			'password.min'=>'Mật khẩu phải ít nhất 6 ký tự',
			'password_confirmation.required'=>'Bạn Chưa Nhập Nhắc Lại Mật Khẩu',
			'password_confirmation.min'=>'mật khẩu phải ít nhất 6 ký tự',
			'phone.required'=>'Bạn chưa nhập số điện thoại',
			'phone.numeric'=>'Bạn phải nhập dữ liệu kiểu số',
			'phone.digits'=>'Độ dài số điện thoại 10 chữ số',
			'year.numeric'=>'Năm sinh kiểu số',
			'year.digits'=>'Độ dài 4 chữ số'
		];
		$validator=validator::make($request->all(),$rules,$messeger);
		if($validator->fails()){
			return view('User::login',$this->data)->withErrors($validator);
		}
		$user=new User();
		$user->name=$request->name;
		$user->email=$request->email;
		$user->password=bcrypt($request->password);
		$user->phone=$request->phone;
		$user->remember_token=$request->_token;
		$user->adress=$request->adress;
		$user->save();

		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
			return redirect('/');
		}
	}

	public function myAccount(){
		return view('User::infoAccount',$this->data);
	}
	public function forgotPassword(){
		return view('User::forgotPassword',$this->data);
	}
	public function transactionHistory(){
		return view('User::transactionHistory',$this->data);
	}
	public function payment(){
		if(Auth::check() && Auth::user()->type==68)
            Auth::logout();
        if(!Auth::check())
            return redirect('/dang-nhap');

		$invoice=tblinvoice::where([
			'id'=>Auth::user()->id,
            'created_at'=>date('Y-m-d'),
            'paid'=>0
		])->orderBy('idinvoice','DESC')
		->first();
		if($invoice!=null){
			$this->data['tblinvoice']=$invoice->toArray();
		}

		return view('User::payment',$this->data);
	}
	public function post_payment(Request $request){
		dd($request->all());
	}
}
?>