<?php

namespace App\Providers;
use DB;
use Auth;
use App\Model\tblseo;
use App\Model\tblhtml;
use App\Http\Requests;
use App\Model\tblpost;
use App\Model\tblimage;
use App\Model\tblbanner;
use App\Model\Component;
use App\Model\Stylesheet;
use App\Model\tblinfoweb;
use App\Model\tblproduct;
use App\Model\tblcategory;
use App\Model\Subcomponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        if(tblimage::where('pathImg','error-images.png')->count()==0){
            tblimage::insert([
                'altImg'=>'error-images',
                'pathImg'=>'error-images.png',
                'srcImg'=>'/images/icons/error-images.png',
                'srcImgBig'=>'/images/icons/error-images.png',
            ]);
        }

        $idImgErorr=tblimage::where('pathImg','error-images.png')
            ->first()->toArray()['idImg'];
        if(tblbanner::where('type','banner')->count()==0){
            tblbanner::insert([
                'nameBn'=>'banner 1',
                'pathBn'=>asset('/'),
                'idImg'=>$idImgErorr,
            ]);
            tblbanner::insert([
                'nameBn'=>'banner 2',
                'pathBn'=>asset('/'),
                'idImg'=>$idImgErorr,
            ]);
            tblbanner::insert([
                'nameBn'=>'banner 3',
                'pathBn'=>asset('/'),
                'idImg'=>$idImgErorr,
            ]);
        }
        DB::table('tblposts')
            ->whereRaw('idImg not in (select idImg from tblimages)')
            ->update(['idImg'=>$idImgErorr]);
        DB::table('tblproducts')
            ->whereRaw('idImg not in (select idImg from tblimages)')
            ->update(['idImg'=>$idImgErorr]);
        DB::table('tblproducers')
            ->whereRaw('idImg not in (select idImg from tblimages)')
            ->update(['idImg'=>$idImgErorr]);
        DB::table('tblbanners')
            ->whereRaw('idImg not in (select idImg from tblimages)')
            ->update(['idImg'=>$idImgErorr]);
        DB::table('users')
            ->whereRaw('idImg not in (select idImg from tblimages)')
            ->update(['idImg'=>$idImgErorr]);
        unset($idImgErorr);
        //menu danh mục
        View::share(
            'listCategory',tblcategory::query()
                ->with('children','children.children')
                ->where(['leveCt'=>0,'statusCt'=>1])
                ->orderBy('orderCt')
                ->get()
                ->toArray()
        );

        //component content left
        if($request->is('/search'))
            View::share('mostview_product',tblproduct::
                join('tblimages','tblproducts.idImg','=','tblimages.idImg')
                ->join('tblseos','tblseos.idproduct','=','tblproducts.idproduct')
                ->join('tblproduct_details','tblproduct_details.idproduct','=','tblproducts.idproduct')
                ->where('statusPro',1)
                ->where('tblproducts.namePro','like','%'.$request->txtsearch.'%')
                ->orWhere('tblseos.tags','like','%'.$request->txtsearch.'%')
                ->orWhere('tblseos.keyword','like','%'.$request->txtsearch.'%')
                ->orderBy('numview','DESC')
                ->limit(5)->get()->toArray()
            );
        else
            View::share('mostview_product',tblproduct::
                join('tblimages','tblproducts.idImg','=','tblimages.idImg')
                ->join('tblproduct_details','tblproduct_details.idproduct','=','tblproducts.idproduct')
                ->where('statusPro',1)
                ->orderBy('numview','DESC')
                ->limit(16)->get()->toArray()
            );
        //content left
        View::share('mostview_post',tblpost::join('users','tblposts.id','=','users.id')
            ->join('tblimages','tblposts.idImg','=','tblimages.idImg')
            ->where('status',1)
            ->orderBy('numview','DESC')
            ->limit(3)->get()->toArray()
        );
        View::share('listproduct_left',tblproduct::
            join('tblimages','tblproducts.idImg','=','tblimages.idImg')
            ->join('tblproduct_details','tblproduct_details.idproduct','=','tblproducts.idproduct')
            ->get()->toArray()
        );
        View::share('listcategory_post',tblcategory::
            join('tblseos','tblcategories.idcategory','=','tblseos.idcategory')
            ->where(['typeCt'=>'post',['leveCt','<>',0],'statusCt'=>1])
            ->get()->toArray()
        );//end content left

        View::share(
            'productportfolio',
            tblcategory::where(['typeCt'=>'product','leveCt'=>0,'statusCt'=>1])
            ->get()->toArray()
        );
        //link stylesheet
        $pathcss='/public/css/';
        $pathcssDefault=$pathcss.'default/';
        $pathcssAdmin=$pathcss.'admin/';
        View::share('default_category',asset($pathcssDefault.'category.css'));
        View::share('default_productDetail',asset($pathcssDefault.'productDetail.css'));
        View::share('default_showPost',asset($pathcssDefault.'showPost.css'));
        View::share('default_mobile',asset($pathcssDefault.'mobile.css'));
        View::share('default_home',asset($pathcssDefault.'home.css'));
        View::share('default_search',asset($pathcssDefault.'search.css'));
        View::share('default_stylesheet',asset($pathcssDefault.'stylesheet.css'));
        View::share('csswebseting',asset($pathcssAdmin.'webseting.css'));
        View::share('cssopenfileimages',asset($pathcssAdmin.'openfileimages.css'));
        unset($pathcss);unset($pathcssDefault);unset($pathcssAdmin);

        //src javascript
        $pathjs='/public/js/';
        $pathjsDefault=$pathjs.'default/';
        $pathjsAdmin=$pathjs.'admin/';
        View::share('jsdefault_home',asset($pathjsDefault.'home.js'));
        View::share('jsdefault_slide',asset($pathjsDefault.'slide.js'));
        View::share('jsdefault_mobile',asset($pathjsDefault.'mobile.js'));
        View::share('webscript',asset($pathjsDefault.'webscript.js'));
        View::share('js_zoom',asset($pathjs.'jquery.zoom.js'));
        View::share('js_jquery',asset($pathjs.'jquery-3.4.0.js'));
        View::share('js_minjquery',
            'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
        View::share('basescript',asset($pathjs.'basescript.js'));
        View::share('baseinfoweb',asset($pathjsAdmin.'baseinfoweb.js'));
        unset($pathjs);unset($pathjsDefault);unset($pathjsAdmin);
        //****************info web**********************************
        if(tblinfoweb::all()->toArray()==null){
            tblinfoweb::insert([
                'name'=>'Máy Bơm Hút Bùn',
                'theme'=>'default',
                'phone'=>'0969 578 901',
                'email'=>'vinakitchen.net@gmail.com',
                'adress'=>"Địa Chỉ: Số 11A/47 Ngõ 168 Kim Giang - Thanh Xuân - Hà Nội \r\n Chi Nhánh Sài Gòn: Số 19 - Đường 18 - Phường 11 - Quận 6 - TP.HCM",
                'facebook'=>'https://www.facebook.com/vinakitchen.net/',
                'youtube'=>'https://www.youtube.com/channel/UCjKNJWdVrR-usXG7oaHMlog',
                'google'=>'link google',
                'twitter'=>'link twitter',
                'imglogo'=>asset('/public/images/icons/favicon-100x100.png'),
                'imgicon'=>asset('/public/images/icons/favicon-100x100.png')
            ]);
            $info=tblinfoweb::
                orderBy('idinfoweb','DESC')->first()->toArray()['idinfoweb'];
            tblseo::insert([
                'metaTag'=>'Máy Bơm Hút Bùn',
                'description'=>'Chuyên phân phối các loại máy bơm hút bùn',
                'keyword'=>'máy bơm hút bùn, máy hút bùn, máy bơm công nghiệp',
                'idinfoweb'=>$info
            ]);
            unset($info);
            tblhtml::insert([
                'descript'=>'Máy Bơm Hút Bùn',
                'properties'=>'theme',
                'value'=>'default'
            ]);
            
        }
        //**********analytic/mastertool/appface***********
        if(tblhtml::where('properties','analytic')->first() == null)
            tblhtml::insert([
                'descript'=>'analytic',
                'properties'=>'analytic',
                'value'=>''
            ]);
        if(tblhtml::where('properties','mastertool')->first() == null)
            tblhtml::insert([
                'descript'=>'Google Master Tool',
                'properties'=>'mastertool',
                'value'=>''
            ]);

        if(tblhtml::where('properties','appface')->first() == null){
            tblhtml::insert([
                'descript'=>'',
                'properties'=>'appface',
                'value'=>''
            ]);
        }
        $codeSeo=tblhtml::
            whereIn('properties',['analytic','mastertool','appface'])
            ->get()->toArray();
        View::share('analytic',$codeSeo[0]['value']);
        View::share('mastertool',$codeSeo[1]['value']);
        View::share('appface',$codeSeo[2]);
        unset($codeSeo);
        //************end analytic/mastertool/appface**********
        if(Component::where('nameComp','content-home')->first()==null){
            Stylesheet::insert([
                'attrclass'=>'container',
                'width'=>'100%',
                'height'=>'-1px',
                'floats'=>'left'
            ]);
            $idstyle=Stylesheet::orderBy('idStyle','DESC')
                ->first()->toArray()['idStyle'];
            Component::insert([
                'nameComp'=>'content-home',
                'idStyle'=>$idstyle,
                'parentComp'=>0,
                'orderComp'=>1
            ]);
        }
        //*****************animation**********
        if(tblhtml::where('properties','style-animation')->count()==0){
            tblhtml::insert([
                'descript'=>'1',
                'properties'=>'style-animation',
                'value'=>'slideup-dow'
            ]);
        }
        //**********infoweb*********************
        View::share('infoweb',tblinfoweb::
            join('tblseos','tblinfowebs.idinfoweb','=','tblseos.idinfoweb')
            ->where('theme','<>','')
            ->first()->toArray()
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
