<?php
namespace App\Modules\Products\Controllers;

use App\Model\tblhtml;
use App\Model\tblpost;
use App\Model\tblimage;
use App\Model\tblbanner;
use App\Model\tblproduct;
use App\Model\tblcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Defaults\stringProcessing;


class ProductsController extends Controller{
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
    public function ProductDetail(Request $request,$pathPro){
        //product infomation
        $infoProduct=tblproduct::query()
            ->with('getImages','getDetail','getSeo')
            ->where('pathPro',$pathPro)
            ->first()->toArray();
        $this->data['infoProduct']=$infoProduct;

        //danh sách ảnh kèm theo
        $listimages=[];
        if($infoProduct['moreImg']!=''){
            $listidImg=explode(',', $infoProduct['moreImg']);
            $listimages=tblimage::whereIn('idImg',$listidImg)->get()->toArray();
            $this->data['listimages']=$listimages;
            unset($listimages);unset($listidImg);
        }

        //danh sách thẻ tag sản phẩm
        $listTags=[];
        if($infoProduct['get_seo']['tags']!=''){
            $tags=stringProcessing::convert_PathUrl($infoProduct['get_seo']['tags'],'');
            $listTags=explode(',', $tags);
            $this->data['listTags']=$listTags;
            $this->data['listTags_text']=explode(',', $infoProduct['get_seo']['tags']);
            unset($listTags);unset($tags);
        }
        return view('Products::ProductDetail',$this->data);
    }
}

?>