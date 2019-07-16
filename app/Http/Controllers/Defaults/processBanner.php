<?php

namespace App\Http\Controllers\Defaults;

use DB;
use App\Model\tblseo;
use App\Model\tblpost;
use App\Http\Requests;
use App\Model\tblhtml;
use App\Model\tblimage;
use App\Model\tblbanner;
use App\Model\tblproduct;
use App\Model\tblcategory;
use App\Model\tblproducer;
use Illuminate\Http\Request;
use App\Model\tblinvoiceDetail;
use App\Model\tblproductDetail;
use App\Http\Controllers\Controller;

class processBanner extends Controller
{
    public static function editbanner(Request $request){
    	$banner=tblbanner::find($request->idbanner0);
        $banner->nameBn=$request->namebanner0;
        $banner->pathBn=$request->pathBn0;
        $banner->idImg=$request->idimg0;
        $banner->status=$request->statusBn0;
        $banner->save();
        $banner=tblbanner::find($request->idbanner1);
        $banner->nameBn=$request->namebanner1;
        $banner->pathBn=$request->pathBn1;
        $banner->idImg=$request->idimg1;
        $banner->status=$request->statusBn1;
        $banner->save();
        $banner=tblbanner::find($request->idbanner2);
        $banner->nameBn=$request->namebanner2;
        $banner->pathBn=$request->pathBn2;
        $banner->idImg=$request->idimg2;
        $banner->status=$request->statusBn2;
        $banner->save();
        unset($banner);
        processBanner::editslide($request);
        processBanner::editservice($request);
        processBanner::editcustom($request);
    }

    public static function editslide(Request $request){
    	DB::table('tblhtmls')->where('properties','style-animation')
            ->update(['descript'=>'0']); 
        DB::table('tblhtmls')
            ->where([
                'properties'=>'style-animation',
                'value'=>$request->animation
            ])->update(['descript'=>'1']);

        for ($i=0; $i < 10; $i++) {
            if(isset($_POST['idslide'.$i])){
                if($_POST['idslide'.$i]>0){
                    //update
                    $slide=tblbanner::find($_POST['idslide'.$i]);
                    $slide->nameBn=$_POST['nameslide'.$i];
                    $slide->pathBn=$_POST['pathslide'.$i];
                    $slide->idImg=$_POST['slide'.$i];
                    $slide->status=$_POST['status_slide'.$i];
                    $slide->save();
                }else{
                    //insert
                    tblbanner::insert([
                        'nameBn'=>$_POST['nameslide'.$i],
                        'pathBn'=>$_POST['pathslide'.$i],
                        'idImg'=>$_POST['slide'.$i],
                        'type'=>'slide',
                        'status'=>$_POST['status_slide'.$i]
                    ]);
                }
            }
        }
        DB::table('tblbanners')
        	->where(['type'=>'slide','status'=>0])
        	->delete();
    }
    public static function editservice(Request $request){
    	for ($i=0; $i < 10; $i++) {
            if(isset($_POST['idservice'.$i])){
                if($_POST['idservice'.$i]>0){
                    //update
                    $servicebn=tblbanner::find($_POST['idservice'.$i]);
                    $servicebn->nameBn=$_POST['nameservice'.$i];
                    $servicebn->pathBn=$_POST['pathservice'.$i];
                    $servicebn->idImg=$_POST['service'.$i];
                    $servicebn->status=$_POST['status_service'.$i];
                    $servicebn->save();
                }else{
                    //insert
                    tblbanner::insert([
                        'nameBn'=>$_POST['nameservice'.$i],
                        'pathBn'=>$_POST['pathservice'.$i],
                        'idImg'=>$_POST['service'.$i],
                        'type'=>'service',
                        'status'=>$_POST['status_service'.$i]
                    ]);
                }
            }
        }
        DB::table('tblbanners')
        	->where(['type'=>'service','status'=>0])
        	->delete();
    }
    public static function editcustom(Request $request){
        for ($i=0; $i < 10; $i++) {
            if(isset($_POST['idcustom'.$i])){
                if($_POST['idcustom'.$i]>0){
                    //update
                    $custombn=tblbanner::find($_POST['idcustom'.$i]);
                    $custombn->nameBn=$_POST['namecustom'.$i];
                    $custombn->pathBn=$_POST['pathcustom'.$i];
                    $custombn->idImg=$_POST['custom'.$i];
                    $custombn->status=$_POST['status_custom'.$i];
                    $custombn->save();
                }else{
                    //insert
                    tblbanner::insert([
                        'nameBn'=>$_POST['namecustom'.$i],
                        'pathBn'=>$_POST['pathcustom'.$i],
                        'idImg'=>$_POST['custom'.$i],
                        'type'=>'custom',
                        'status'=>$_POST['status_custom'.$i]
                    ]);
                }
            }
        }
        DB::table('tblbanners')
            ->where(['type'=>'custom','status'=>0])
            ->delete();
    }

    public static function showbanner(){
    	$data['listbanner']=tblbanner::
            join('tblimages','tblbanners.idImg','=','tblimages.idImg')
            ->whereIn('type',['banner','slide','service','custom'])
            ->get()->toArray();

        $data['list_Style_Animation']=tblhtml::
            where('properties','style-animation')
            ->get()->toArray();

        $data['style_animation_selected']=tblhtml::
            where(['properties'=>'style-animation','descript'=>'1'])
            ->first()->toArray()['value'];
        return $data;
    }
}
