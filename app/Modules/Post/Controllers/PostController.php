<?php
namespace App\Modules\Post\Controllers;

use App\Model\tblhtml;
use App\Model\tblpost;
use App\Model\tblimage;
use App\Model\tblbanner;
use App\Model\tblproduct;
use App\Model\tblcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Defaults\stringProcessing;


class PostController extends Controller{
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
    public function PostDetail(Request $request,$pathPost){
        $postdetail=tblpost::query()->with('getUser','getImages','getSeo')
            ->where('pathPost',$pathPost)
            ->first()->toArray();
        $this->data['postdetail']=$postdetail;

        $listProductRecommend=tblproduct::query()
            ->with('getImages','getDetail','getSeo')
            ->orderBy('numview','DESC')
            ->limit(12)->get()->toArray();
        $this->data['listproducts']=$listProductRecommend;
        $this->data['numberColumn']=6;
        return view('Post::PostDetail',$this->data);
    }
}

?>