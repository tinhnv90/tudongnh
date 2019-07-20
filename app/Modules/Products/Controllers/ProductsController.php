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
    public function ProductDetail($pathPro){
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

        //danh sách sản phẩm liên quan
        $listRelatedProduct=tblproduct::query()
            ->with('getImages','getDetail','getSeo')
            ->where(['idcategory'=>$infoProduct['idcategory'],
                    ['idproduct','<>',$infoProduct['idproduct']]])
            ->orderBy('numview','DESC')
            ->limit(12)->get()->toArray();
        $this->data['listproducts']=$listRelatedProduct;
        return view('Products::ProductDetail',$this->data);
    }

    public function category($pathCt){
        //danh sách sản phẩm
        $listproduct=tblcategory::query()
            ->with(['listproduct'=>function($query){
                $query->with('getImages','getDetail')
                    ->orderBy('numview','DESC')->limit(8);
            }])->where('pathCt',$pathCt)
            ->first()->toArray();
        $this->data['listProductOfCategory']=$listproduct;
        $this->data['numberColumn']=6;
        //end

        
        return view('Products.Category',$this->data);
    }
}

?>