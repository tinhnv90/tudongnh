<?php
namespace App\Modules\User\Controllers;

use Auth;
use Hash;
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
		$listinvoice=tblinvoice::
			where([['created_at','<>',date('Y-m-d')],'paid'=>0])->get();
		if($listinvoice!=null){
			$listinvoice=$listinvoice->toArray();
			foreach ($listinvoice as $invoice) {
				tblinvoiceDetail::where('idinvoice',$invoice['idinvoice'])->delete();
				tblinvoice::where('idinvoice',$invoice['idinvoice'])->delete();
			}
		}
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
		$user->email=$request->email;
		$user->password=bcrypt($request->password);
		$user->name=$request->name;
		$user->phone=$request->phone;
		$user->remember_token=$request->_token;
		$user->adress=$request->adress;
		$user->year=$request->year;
		$user->sex=$request->sex;
		$user->save();

		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
			return redirect('/');
		}
	}

	public function myAccount(){
		$this->data['users']=Auth::user();
		return view('User::myAccount',$this->data);
	}
	public function updateAccount(Request $request){
		$this->data['users']=Auth::user();
		if (isset($request->update_myaccount)) {
			$rules=[
				'phone'=>'required|numeric|digits:10',
			];
			$messeger=[
				'phone.required'=>'Bạn chưa nhập số điện thoại',
				'phone.numeric'=>'Số điện thoại bao gồm các chữ số từ 0-9',
				'phone.digits'=>'Số điện thoại có độ dài 10 chữ số',
			];
			$validator=Validator::make($request->all(),$rules,$messeger);
			if($validator->fails()){
				return view('User::myAccount',$this->data)->withErrors($validator);
			}else{
				$user=User::find($this->data['users']->id);
				$user->name=$request->name;
				$user->sex=$request->sex;
				$user->year=$request->year;
				$user->phone=$request->phone;
				$user->adress=$request->adress;
				$user->save();
				return redirect('tai-khoan');
			}
		}else{
			$rules=[
				'password_old'=>'required',
				'password'=>'required|min:6',
				'password_confirmation'=>'required|min:6|same:password'
			];
			$messeger=[
				'password_old.required'=>'Bạn chưa nhập mật khẩu cũ',
				'password.required'=>'Mật khẩu mới chưa được nhập',
				'password.min'=>'Độ dài tối thiểu là 6 ký tự',
				'password_confirmation.required'=>'Nhắc lại mật khẩu chưa được nhập',
				'password_confirmation.min'=>'độ dài tối thiểu 6 ký tự',
				'password_confirmation.same'=>'nhắc lại mật khẩu không khớp'
			];

			$validator=Validator::make($request->all(),$rules,$messeger);
			if($validator->fails() || !Hash::check($request->password_old, 
					$this->data['users']->password)){
				$this->data['noteExistsPass']='Nhập sai mật khẩu cũ';
				return view('User::myAccount',$this->data)->withErrors($validator);
			}else{
				$user=User::find($this->data['users']->id);
				$user->password=bcrypt($request->password);
				$user->save();
				return redirect('tai-khoan');
			}
		}
	}

	public function forgotPassword(){
		return view('User::forgotPassword',$this->data);
	}
	public function transactionHistory(){
		$listinvoice=tblinvoice::query()
			->with('getDetail','getDetail.getProduct')
			->where('id',Auth::user()->id)
			->get();
		if($listinvoice!=null){
			$this->data['listinvoice']=$listinvoice->toArray();
		}

		return view('User::transactionHistory',$this->data);
	}
}
?>