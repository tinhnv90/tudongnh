<?php
namespace App\Modules\Products\Controllers;

use DB;
use Auth;
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
    public function ProductDetail($pathPro){
        //product infomation
        $infoProduct=tblproduct::query()
            ->with('getImages','getDetail','getSeo')
            ->where('pathPro',$pathPro)
            ->first()->toArray();
        $this->data['infoProduct']=$infoProduct;
        DB::table('tblproducts')->where('pathPro',$pathPro)
            ->update(['numview'=>++$infoProduct['numview']]);

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


        $listSpecialProduct=tblproduct::query()
            ->with('getImages')
            ->where('idcategory',$infoProduct['idcategory'])
            ->limit(5)->get()->toArray();
        $this->data['listSpecialProduct']=$listSpecialProduct;
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
        $this->data['productNumberDisplayed']=$limit;//số sản phẩn hiển thị trong trang
        //**************end page**************

        $this->data['ordername']=$orderby[0];
        $this->data['ordervalue']=$orderby[1];
        $this->data['limit']=$limit;

        //danh sách id danh mục sản phẩm hiển thị
        $category=tblcategory::query()
            ->with('children','getSeo','getImages')
            ->where('pathCt',$pathCt)
            ->first()->toArray();
        $this->data['category']=$category;

        //dùng đánh dấu(active menu) danh mục được chọn trong menu left
        $this->data['idcategory']=$category['idcategory'];
        $this->data['idparent']=$category['leveCt'];

        //danh sách id danh mục con nếu có
        $listidcategory[]=$category['idcategory'];
        if(count($category['children'])>0){
            unset($listidcategory);
            foreach ($category['children'] as $children)
               $listidcategory[]=$children['idcategory'];
        }


        //tổng số sản phẩm của danh mục được chọn, dùng trang phân trang
        $countproduct=tblproduct::
        join('tblcategories','tblcategories.idcategory','=','tblproducts.idcategory')
        ->whereIn('tblproducts.idcategory',$listidcategory)->count();
        $this->data['countproduct']=$countproduct;

        //danh sách sản phẩm
        $listproducts=tblproduct::query()
            ->with('getImages','getDetail')
            ->whereIn('idcategory',$listidcategory)
            ->orderBy($this->data['ordername'],$this->data['ordervalue'])
            ->offset(($this->data['page']-1)*$this->data['limit'])
            ->take($this->data['limit'])
            ->get()->toArray();
        $this->data['listproducts']=$listproducts;

        //số sản phẩm hiển thị trên 1 hàng
        $this->data['numberColumn']=4;
        //end
        $listSpecialProduct=tblproduct::query()
            ->with('getImages')
            ->where('idcategory',$category['idcategory'])
            ->limit(5)->get()->toArray();
        $this->data['listSpecialProduct']=$listSpecialProduct;
        return view('Products::Category',$this->data);
    }
}

?>