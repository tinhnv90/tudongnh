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

        $listSpecialProduct=tblproduct::query()
            ->with('getImages')
            ->limit(5)
            ->get()->toArray();
        $this->data['listSpecialProduct']=$listSpecialProduct;
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
            ->with('getImages','getDetail','getSeo','getParent')
            ->where(['idcategory'=>$infoProduct['idcategory'],
                    ['idproduct','<>',$infoProduct['idproduct']]])
            ->orderBy('numview','DESC')
            ->limit(12)->get()->toArray();
        $this->data['listproducts']=$listRelatedProduct;
        return view('Products::ProductDetail',$this->data);
    }

    public function category(Request $request,$pathCt){
        //-------------page----------------
        $orderby=['namePro','ASC'];
        if(isset($request->sortBy)){
            $arr=explode('_', $request->sortBy);
            $orderby=[$arr[0],$arr[1]];
        }
        $limit=16;
        if(isset($request->limit)){
            $limit=$request->limit;
        }
        $this->data['page']=1;
        if(isset($request->page))
            $this->data['page']=$request->page;

        if(count($request->query)==0){
            $urlpage=Url()->current().'?sortBy=namePro_ASC&limit=16';
        }else{
            $urlpage=Url()->current().'?sortBy='.$request->sortBy
            .'&limit='.$request->limit;
        }
        $this->data['urlpage']=$urlpage;
        $this->data['productNumberDisplayed']=$limit;//số sản phẩn hiển thị
        $this->data['countproduct']=tblproduct::
        join('tblcategories','tblcategories.idcategory','=','tblproducts.idcategory')
        ->where(['pathCt'=>$pathCt,'tblcategories.pathCt'=>$pathCt])->count();
        //**************end page**************

        $this->data['ordername']=$orderby[0];
        $this->data['ordervalue']=$orderby[1];
        $this->data['limit']=$limit;
        //danh sách sản phẩm
        $listProductOfCategory=tblcategory::query()
            ->with(['listproduct'=>function($query){
                $query->with('getImages','getDetail')
                ->orderBy($this->data['ordername'],$this->data['ordervalue'])
                ->offset(($this->data['page']-1)*$this->data['limit'])
                ->take($this->data['limit'])->get()->toArray();;
            }])->where('pathCt',$pathCt)
            ->with('getSeo','getImages')
            ->first()->toArray();
        $this->data['listProductOfCategory']=$listProductOfCategory;
        $this->data['numberColumn']=4;
        //end
        return view('Products::Category',$this->data);
    }
}

?>