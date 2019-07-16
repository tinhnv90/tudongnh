<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Validator;
use App\Http\Requests;
use App\Model\tblimage;
use App\Model\Component;
use App\Model\Stylesheet;
use App\Model\Subcomponent;
use Illuminate\Http\Request;
use App\Http\Controllers\Defaults\productProcessing;


class WebDesignBasis extends Controller
{
    public $data;
	public function __construct(Request $request){
		$this->middleware('auth');
        if(Auth::check()){
            $this->data['useradmin']=Auth::user();
            $this->data['useradmin']['srcImg']=tblimage::
                where('idImg',$this->data['useradmin']['idImg'])
                ->first()->toArray()['srcImg'];
        }
        $this->data['listfolder']=$this->listfolder($request);
        $this->data['listfile']=scandir(public_path().'/images');
        //dd($this->data['listfile']);
        unset($this->data['listfile'][0]);unset($this->data['listfile'][1]);

        $this->data['listidImg']=[];
        foreach ($this->data['listfile'] as $images) {
            if(is_file(public_path().'/images/'.$images)){
                $ischeckimg=tblimage::where('srcImg','/images/'.$images)->count();
                if($ischeckimg==0){
                    tblimage::insert([
                        'altImg'=>str_replace(['.jpg','.png','.jpeg'],'',$images),
                        'pathImg'=>stringProcessing::convert_PathUrl($images),
                        'srcImg'=>'/imagess/'.$images,
                        'srcImgBig'=>'/imagess/'.$images
                    ]);
                }
                $idImg=tblimage::where('srcImg','/images/'.$images)
                    ->first()->toArray();
                $this->data['listidImg'][]=$idImg['idImg'];
            }
        }
	}
    public function listfolder(){
        $this->processingpro=new productProcessing();
        $this->processingpro->listImgPro('/images');
        $listfolder=array_reverse($this->processingpro->getlistfolder());
        return $listfolder;
    }
    public function edithomepage(Request $request){
        $this->data['parentchild']=Component::first()->toArray();
        $this->data['design_content_home']=$this->getcontenthome('design_content_home');
        return View('admins.webdesign.homepage',$this->data);
    }
    public function getcontenthome($listcontent){
        return $listcontent;
    }
    public function editheader(Request $request){

    	return View('admins.webdesign.header',$this->data);
    }

    public function editcontent(Request $request){

    	return View('admins.webdesign.content',$this->data);
    }
    public function editfooter(Request $request){

    	return View('admins.webdesign.footer',$this->data);
    }
    public function append_child(){
        return View('admins.webdesign.getchild');
    }
    public function insertnode(Request $request){
        Stylesheet::insert([
            'attrclass'=>'attr'.$request->elementid
        ]);
        $idStyle=Stylesheet::orderBy('idStyle','DESC')->first()->toArray()['idStyle'];
        Component::insert([
            'idStyle'=>$idStyle,
            'parentComp'=>$request->elementid,
            'orderComp'=>$request->order
        ]);
        unset($idStyle);
        return Component::orderBy('idComponent','DESC')->first()->toArray()['idComponent'];
    }
    public function deletenode(Request $request){
        $comp=Component::where('idComponent',$request->idcomp)->first()->toArray();
        Component::where('idComponent',$request->idcomp)->delete();
        Stylesheet::where('idStyle',$comp['idStyle'])->delete();
        unset($comp);
    }
}
