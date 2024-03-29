<?php
namespace App\Modules\Homepages\Controllers;

use Auth;
use App\Model\tblhtml;
use App\Model\tblpost;
use App\Model\tblbanner;
use App\Model\tblproduct;
use App\Model\tblcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomepagesController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        if(Auth::check() && Auth::user()->type==68)
            Auth::logout();
        # parent::__construct();
    }
    public function index(Request $request){
        //danh sách sản phẩm được xem nhiều nhất
        $listProductMostView=tblproduct::query()->with('getImages','getDetail')
            ->orderBy('numview','DESC')
            ->limit(10)
            ->get()->toArray();
        $data['listProductMostView']=$listProductMostView;

        //danh sách sản phẩm chính của trang web
        $idcategory=tblhtml::where('properties','listProductOfCategoryInHome')
            ->first()->toArray()['value'];
        $category=tblcategory::query()
            ->with('getSeo','getImages')
            ->where('idcategory',$idcategory)
            ->first()->toArray();
        $data['category']=$category;

        $listproduct=tblproduct::query()
            ->with('getImages','getDetail')
            ->where('idcategory',$idcategory)
            ->orderBy('numview','DESC')->limit(8)
            ->get()->toArray();
        $data['listproducts']=$listproduct;

        //danh sách 3 banner trang chủ
        $listbanner=tblbanner::query()->with('getImages')
            ->where('type','banner')->get()->toArray();
        $data['threeBannerInHome']=$listbanner;

        //danh sách slide
        $listslide=tblbanner::query()->with('getImages')
            ->where('type','slide')->get()->toArray();
        $data['listslide']=$listslide;

        //danh sách tin tức mới nhất
        $listPostMostView=tblpost::query()->with('getImages')
            ->orderBy('created_at','DESC')->limit(10)->get()->toArray();
        $data['listPostMostView']=$listPostMostView;

        //giỏ hàng
        $data['productNumberInTheCart']=0;
        $data['totalMoney']=0;
        if($request->session()->has('productInTheCart')){
            $data['productNumberInTheCart']=count($request->session()->get('productInTheCart'));
        }

        $data['productNumberInTheCompare']=0;
        if($request->session()->has('productInTheCompare')){
            $data['productNumberInTheCompare']=count($request->session()->get('productInTheCompare'));
        }

        $data['productNumberInTheWishlist']=0;
        if($request->session()->has('productInTheWishlist')){
            $data['productNumberInTheWishlist']=count($request->session()->get('productInTheWishlist'));
        }
        //end giỏ hàng

        //thông tin warpper
        $listwarpper=tblhtml::where('properties','like','warpper%')->get();
        if($listwarpper!=null){
        	$data['listwarpper']=$listwarpper->toArray();
        }

        //thông tin listmainleft
        $listmainleft=tblhtml::where('properties','like','leftMain%')->get();
        if($listmainleft!=null){
        	$data['listmainleft']=$listmainleft->toArray();
        }

        //thông tin specialPost
        $idspecialPost=tblhtml::where('properties','specialPost1')->first();
        if($idspecialPost!=null){
        	$idspecialPost=$idspecialPost->toArray()['value'];
        	$data['specialPost']=tblpost::query()
        		->with('getImages')
        		->where('idPost',$idspecialPost)
        		->first()->toArray();
        } 
        $idspecialPost=tblhtml::where('properties','specialPost2')->first();
        if($idspecialPost!=null){
        	$idspecialPost=$idspecialPost->toArray()['value'];
        	$data['specialPost2']=tblpost::
        		where('idPost',$idspecialPost)
        		->first()->toArray();
        }
        $idspecialPost=tblhtml::where('properties','specialPost3')->first();
        if($idspecialPost!=null){
        	$idspecialPost=$idspecialPost->toArray()['value'];
        	$data['specialPost3']=tblpost::
        		where('idPost',$idspecialPost)
        		->first()->toArray();
        }
        return view('Homepages::index',$data);
    }
}

?>