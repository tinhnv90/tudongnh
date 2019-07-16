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
    public function boot()
    {
        $domain=asset('/public');
        View::share('style',$domain.'/css/local/');
        View::share('script',$domain.'/js/local/');
        View::share('icons',$domain.'/images/icons/');

        $pathcssAdmin='/public/css/admin/';
        View::share('csswebseting',asset($pathcssAdmin.'webseting.css'));
        View::share('cssopenfileimages',asset($pathcssAdmin.'openfileimages.css'));
        unset($pathcss);unset($pathcssDefault);unset($pathcssAdmin);
        $pathjsAdmin='/public/js/admin/';
        View::share('baseinfoweb',asset($pathjsAdmin.'baseinfoweb.js'));
        unset($pathjs);unset($pathjsDefault);unset($pathjsAdmin);

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
