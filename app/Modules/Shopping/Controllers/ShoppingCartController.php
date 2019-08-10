<?php
namespace App\Modules\Shopping\Controllers;

use DB;
use Auth;
use Validator;
use App\Model\tblhtml;
use App\Model\tblpost;
use App\Model\tblimage;
use App\Model\tblbanner;
use App\Model\tblproduct;
use App\Model\tblinvoice;
use App\Model\tblcategory;
use Illuminate\Http\Request;
use App\Model\tblinvoiceDetail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Defaults\stringProcessing;


class ShoppingCartController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request){
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

        $listSpecialProduct=tblproduct::query()
            ->with('getImages')
            ->orderBy('numview','DESC')
            ->limit(10)->get();
        if ($listSpecialProduct!=null) {
            $this->data['listSpecialProduct']=$listSpecialProduct->toArray();
        }

        if (Auth::check()) {
            $tblinvoice=tblinvoice::where([
                'id'=>Auth::user()->id,
                'created_at'=>date('Y-m-d'),
                'paid'=>0
                ])
            ->orderBy('idinvoice','DESC')
            ->first();
            if($tblinvoice!=null)
                $this->data['tblinvoice']=$tblinvoice->toArray();
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
        $listSpecialProduct=tblproduct::query()
            ->with('getImages')
            ->orderBy('numview','DESC')
            ->limit(10)->get();
        if ($listSpecialProduct!=null) {
            $this->data['listSpecialProduct']=$listSpecialProduct->toArray();
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
        $listSpecialProduct=tblproduct::query()
            ->with('getImages')
            ->orderBy('numview','DESC')
            ->limit(10)->get();
        if ($listSpecialProduct!=null) {
            $this->data['listSpecialProduct']=$listSpecialProduct->toArray();
        }
        return view('Shopping::compare',$this->data);
    }


    public function removecart(Request $request){
    	$request->session()->forget('productInTheCart.'.$request->idproduct);
        if($request->session()->get('productInTheCart')==null)
            $request->session()->forget('productInTheCart');
    	return response()->json(['result'=>$request->idproduct]);
    }
    public function removecompare(Request $request){
        $request->session()->forget('productInTheCompare.'.$request->idproduct);
        if($request->session()->get('productInTheCompare')==null)
            $request->session()->forget('productInTheCompare');
    	return response()->json(['result'=>$request->idproduct]);
    }
    public function removewishlist(Request $request){
        $request->session()->forget('productInTheWishlist.'.$request->idproduct);
        if($request->session()->get('productInTheWishlist')==null)
            $request->session()->forget('productInTheWishlist');
    	return response()->json(['result'=>$request->idproduct]);
    }

    public function order(Request $request){
        if(Auth::check() && Auth::user()->type==68)
            Auth::logout();
        if(!Auth::check())
            return redirect('dang-nhap');

        $rules=[
            'username'=>'required|string',
            'phone'=>'required|numeric|digits:10',
            'adress_order'=>'required|string'
        ];
        $messeger=[
            'username.required'=>'Tên người nhận không được để trống',
            'username.string'=>'Tên người nhận là một chuỗi ký tự a-z[A-Z]',
            'phone.required'=>'SĐT người nhận không được để trống',
            'phone.numeric'=>'SĐT là dữ liệu kiểu số nguyên 0-9',
            'phone.digits'=>'SĐT có độ dài 10 chữ số',
            'adress_order.required'=>'Trường địa chỉ không được để trống',
            'adress_order.string'=>'Địa chỉ là một chuỗi ký tự'
        ];

        $validator=Validator::make($request->all(),$rules,$messeger);
        if($validator->fails()){
            return redirect('/gio-hang')->withErrors($validator);
        }

        if($request->codeinvoice==null){
            tblinvoice::insert([
                'id'=>$request->iduser,
                'recipientName'=>$request->username,
                'recipientPhone'=>$request->phone,
                'recipientAdress'=>$request->adress_order,
                'totalmoney'=>$request->sumprice,
                'created_at'=>date('Y-m-d')
            ]);
        }else{
            DB::table('tblinvoices')
                ->where('code',$request->codeinvoice)
                ->update([
                    'id'=>trim($request->iduser),
                    'recipientName'=>$request->username,
                    'recipientPhone'=>$request->phone,
                    'recipientAdress'=>$request->adress_order,
                    'totalmoney'=>$request->sumprice,
                    'created_at'=>date('Y-m-d')
                ]);
        }
        $tblinvoice=tblinvoice::where([
            'id'=>Auth::user()->id,
            'created_at'=>date('Y-m-d'),
            'paid'=>0
        ])->first()->toArray();

        if($tblinvoice['code']==null){
            $invoice=tblinvoice::find($tblinvoice['idinvoice']);
            $invoice->code=crc32($tblinvoice['idinvoice']);
            $invoice->save();
        }

        tblinvoiceDetail::where('idinvoice',$tblinvoice['idinvoice'])->delete();

        $listproduct=$request->session()->get('productInTheCart');
        foreach ($listproduct as $idproduct => $number) {
            tblinvoiceDetail::insert([
                'idproduct'=>$idproduct,
                'idinvoice'=>$tblinvoice['idinvoice'],
                'number'=>$number[0]
            ]);
        }
        return redirect('/thanh-toan');
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

        return view('Shopping::payment',$this->data);
    }
    public function post_payment(Request $request){
        $rules=[
            'cardNumber'=>'required|digits:16|numeric',
            'month'=>'required|numeric|digits:2',
            'year'=>'required|numeric|digits:4',
            'nameCard'=>'required'
        ];
        $messeger=[
            'cardNumber.required'=>'Mã số thẻ không được để trống',
            'cardNumber.digits'=>'Mã số thẻ bao gồm 16 hoặc 19 số',
            'cardNumber.numeric'=>'Mã số thẻ là các số nguyên từ 0-9',
            'month.required'=>'Tháng phát hành thẻ không được để trống',
            'month.numeric'=>'Trường Tháng là các số nguyên từ 0-9',
            'month.digits'=>'Trường Tháng bao gồm 2 chữ số',
            'year.required'=>'Năm phát hành thẻ không được để trống',
            'year.numeric'=>'Trường Năm là các số nguyên từ 0-9',
            'year.digits'=>'Trường Năm bao gồm 4 chữ số',
            'nameCard.required'=>'Tên In trên thẻ không được để trống',
        ];
        $validator=Validator::make($request->all(),$rules,$messeger);
        if($validator->fails()){
            $invoice=tblinvoice::where([
                'id'=>Auth::user()->id,
                'created_at'=>date('Y-m-d'),
                'paid'=>0
            ])->orderBy('idinvoice','DESC')
            ->first();
            if($invoice!=null){
                $this->data['tblinvoice']=$invoice->toArray();
            }
            return view('Shopping::payment',$this->data)->withErrors($validator);
        }
        dd('true');
    }

    public function shipcod(){
        return view('Shopping::paymentForm.shipcod');
    }
    public function techcombank(){
        return view('Shopping::paymentForm.techcombank');
    }
    public function viettinbank(){
        return view('Shopping::paymentForm.viettinbank');
    }
}

?>