<?php

namespace App\Http\Controllers\Defaults;

use DB;
use App\Model\tblseo;
use App\Model\tblhtml;
use App\Http\Requests;
use App\Model\tblimage;
use App\Model\tblinfoweb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class processwebseting extends Controller
{
    public static function update_Infoweb(Request $request){
    	$tblinfoweb=tblinfoweb::find($request->idinfoweb);
        $tblinfoweb->theme=$request->listtheme;
        $tblinfoweb->phone=$request->phone;
        $tblinfoweb->email=$request->email;
        $tblinfoweb->adress=$request->adress;
        $tblinfoweb->facebook=$request->linkface;
        $tblinfoweb->youtube=$request->linkyoutube;
        $tblinfoweb->google=$request->linkgoogle;
        $tblinfoweb->twitter=$request->linktwitter;
        $tblinfoweb->imglogo=$request->imglogo;
        $tblinfoweb->imgicon=$request->imgicon;
        $tblinfoweb->save();
        unset($tblinfoweb);
    }
    public static function update_Seo(Request $request){
    	$idSeo=tblseo::where('idinfoweb',$request->idinfoweb)->first()->toArray();
        $tblseo=tblseo::find($idSeo['idSeo']);
        $tblseo->metaTag=$request->titlepage;
        $tblseo->description=$request->description;
        $tblseo->keyword=$request->keywork;
        $tblseo->save();
        unset($tblseo);
    }
    public static function dbupdate_Html($parameter,$saveValue){
    	DB::table('tblhtmls')->where('properties',$parameter)
    		->update(['value'=>$saveValue]);
    }
    public static function dbupdate_Html_face($parameter,$arrayValue){
    	DB::table('tblhtmls')->where('properties',$parameter)->update($arrayValue);
    }
    public static function dbupdate_Html_theme($arrayParameter,$saveDescript){
    	DB::table('tblhtmls')->where($arrayParameter)
    		->update(['descript'=>$saveDescript]);
    }
    public static function dbupdate_Html_logotext($value){
        $isCheck=tblhtml::where('properties','logotext')->first();
        if($isCheck==null){
            tblhtml::insert(['properties'=>'logotext','value'=>$value]);
        }elseif($value==''){
            tblhtml::where('properties','logotext')->delete();
        }else{
            DB::table('tblhtmls')->where('properties','logotext')
                ->update(['value'=>$value]);
        }
    }
    public static function show_webseting(){
    	$data['listtheme']=tblhtml::where('properties','theme')->get()->toArray();
        $data['infoweb']=tblinfoweb::
            join('tblseos','tblinfowebs.idinfoweb','=','tblseos.idinfoweb')
            ->where('theme','<>','')
            ->first()->toArray();
        $data['infohtml']=tblhtml::
            where(['properties'=>'theme','value'=>$data['infoweb']['theme']])
            ->orWhereIn('properties',['analytic','mastertool','appface'])
            ->get()->toArray();

        $data['logotext']='';
        $info=tblhtml::where('properties','logotext')->first();
        if($info!=null){
            $data['logotext']=$info->toArray()['value'];
        }
        return $data;
    }

}
