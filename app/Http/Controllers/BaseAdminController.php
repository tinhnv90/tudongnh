<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use App\Model\tblseo;
use App\Model\tblhtml;
use App\Model\tblpost;
use App\Http\Requests;
use App\Model\tblimage;
use App\Model\tblbanner;
use App\Model\tblproduct;
use App\Model\tblinfoweb;
use App\Model\tblcategory;
use App\Model\tblproducer;
use Illuminate\Http\Request;
use App\Model\tblproductDetail;
use App\Model\tblinvoiceDetail;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Defaults\processBanner;
use App\Http\Controllers\Defaults\postProcessing;
use App\Http\Controllers\Defaults\menuProcessing;
use App\Http\Controllers\Defaults\stringProcessing;
use App\Http\Controllers\Defaults\processwebseting;
use App\Http\Controllers\Defaults\productProcessing;

class BaseAdminController extends Controller
{
    public $data;
    public $processingpro;
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

    public function home(){

    	return view('admins.home',$this->data);
    }

    public function update_showproducthome(Request $request){
        DB::table('tblcategories')->where('idcategory',$request->idcategory)
            ->update(['showproducthome'=>$request->showproducthome]);
    }
    public function get_webseting(){
        $this->data=array_merge($this->data,processwebseting::show_webseting());
        return view('admins.webseting',$this->data);
    }
    public function post_webseting(Request $request){
        processwebseting::update_Infoweb($request);
        processwebseting::update_Seo($request);

        $arrayParameter=['properties'=>'theme','value'=>$request->listtheme];
        processwebseting::dbupdate_Html_theme($arrayParameter,$request->nameweb);
        processwebseting::dbupdate_Html('analytic',$request->analytic);
        processwebseting::dbupdate_Html('mastertool',$request->mastertool);
        $arrayValue=['descript'=>$request->appidface,'value'=>$request->facebook_sdk];
        processwebseting::dbupdate_Html_face('appface',$arrayValue);
        processwebseting::dbupdate_Html_logotext($request->logoName);
        
        $this->data=array_merge($this->data,processwebseting::show_webseting());
        return view('admins.webseting',$this->data);
    }
    public function menu(Request $request){
        //page
        $this->data['urlpage']=asset('/admin/menu').'?';
        $this->data['productNumberDisplayed']=20;
        $this->data['page']=1;
        if(isset($request->page))
            $this->data['page']=$request->page;

        $this->data['namecategory']='';
        if(isset($request->search_namecategory)){
        	$this->data['namecategory']=$request->search_namecategory;
        	$this->data['urlpage'].='&search_namecategory='.$this->data['namecategory'];
        }

        $pathCt=stringProcessing::convert_PathUrl($this->data['namecategory']);
        $this->data['countproduct']=tblcategory::
        	where(['typeCt'=>'product','statusCt'=>1,['pathCt','like','%'.$pathCt.'%']])
        	->count();    
        //end page
        $this->data['offset']=($this->data['page']-1)*$this->data['productNumberDisplayed'];
        $this->data['take']=$this->data['productNumberDisplayed'];
        $this->data['listcategory']=menuProcessing::get_List_Category($pathCt);
        return view('admins.menu',$this->data);
    }

    public function menudelete(Request $request){
        $result['resuilt_delete']='Đã xóa bản ghi thành công';
        foreach ($request->delete_id as $idcategory) {
            if(!menuProcessing::deleteCategory_by_id($idcategory)){
                $result['resuilt_delete']='Đã xảy ra lỗi khi xóa bản ghi '.$idcategory;
                break;
            }
        }
        return response()->json($result);
    }

     public function get_menuadd(){
        $this->data['typect_web']=$this->data['typect_post']='';
        $this->data['typect_product']='';
        $this->data['List_father_categorys']=menuProcessing::get_Father_List();
        if($this->data['List_father_categorys']==null)
            $this->data['List_father_categorys'][0]=[];
        return view('admins.menuadd',$this->data);
     }
    public function post_menuadd(Request $request){
        $this->data['typect_web']=$this->data['typect_post']='';
        $this->data['typect_product']='';
        $rules=menuProcessing::getRules();
        $messages=menuProcessing::getMessages();

        $validator=Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            $this->data['List_father_categorys']=menuProcessing::get_Father_List();
            return View('admins.menuadd',$this->data)->withErrors($validator);
        }
        try{
            menuProcessing::menuinsert($request);
            $idcategory=tblcategory::orderBy('idcategory','DESC')
                ->first()->toArray()['idcategory'];
            tblhtml::insert([
                'descript'=>$idcategory,
                'properties'=>$request->pathCt,
                'value'=>$request->contentCategory
            ]);
        }catch (Exception $e) {
        }

        $this->data['List_father_categorys']=menuProcessing::get_Father_List();
        return view('admins.menuadd',$this->data);
    }
    public function get_menuedit($idcategory,$_tonken){
        $this->data=array_merge($this->data,
                menuProcessing::datashow_menuedit($idcategory,$_tonken));
        return view('admins.menuedit',$this->data);
    }
    public function post_menuedit(Request $request,$idcategory,$_tonken){
        $rules=menuProcessing::getRules(false);
        $messages=menuProcessing::getMessages(false);
        $validator=Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            $this->data=array_merge($this->data,
                menuProcessing::datashow_menuedit($idcategory,$_tonken));
            return View('admins.menuedit',$this->data)->withErrors($validator);
        }
        
        if($request->_tonken==$_tonken){
            menuProcessing::menuedit($request,$idcategory);

            $contentCategory=tblhtml::where('descript',$idcategory)
                ->first();
            if($contentCategory != null){
                $tblhtml=tblhtml::find($contentCategory->toArray()['idhtml']);
                $tblhtml->properties=$request->pathCt;
                $tblhtml->value=$request->contentCategory;
                $tblhtml->save();
            }else{
                tblhtml::insert([
                    'descript'=>$idcategory,
                    'properties'=>$request->pathCt,
                    'value'=>$request->contentCategory
                ]);
            }
        }
        //page
        $this->data['urlpage']=asset('/admin/menu').'?';
        $this->data['productNumberDisplayed']=20;
        $this->data['page']=1;
        if(isset($request->page))
            $this->data['page']=$request->page;

        $this->data['namecategory']='';
        if(isset($request->search_namecategory)){
            $this->data['namecategory']=$request->search_namecategory;
            $this->data['urlpage'].='&search_namecategory='.$this->data['namecategory'];
        }

        $pathCt=stringProcessing::convert_PathUrl($this->data['namecategory']);
        $this->data['countproduct']=tblcategory::
            where(['typeCt'=>'product','statusCt'=>1,['pathCt','like','%'.$pathCt.'%']])
            ->count();    
        //end page
        $this->data['offset']=($this->data['page']-1)*$this->data['productNumberDisplayed'];
        $this->data['take']=$this->data['productNumberDisplayed'];
        $this->data['listcategory']=menuProcessing::get_List_Category();
        $this->data['List_father_categorys']=menuProcessing::get_Father_List();

        return view('admins.menu',$this->data);
    }

    public function product(Request $request){
        //page
            $this->data['urlpage']=asset('/admin/product').'?';
            $this->data['productNumberDisplayed']=20;
            $this->data['page']=1;
            if(isset($request->page))
                $this->data['page']=$request->page;
        //end page
            $this->data['nameproduct']='';
            $this->data['codeproduct']='';
            if(isset($request->search_namepro)){
            	$this->data['nameproduct']=$request->search_namepro;
            	$this->data['urlpage'].='&search_namepro='.$this->data['nameproduct'];
            }
            if(isset($request->search_codepro)){
            	$this->data['codeproduct']=$request->search_codepro;
            	$this->data['urlpage'].='&search_codepro='.$this->data['codeproduct'];
            }

            $pathproduct=stringProcessing::convert_PathUrl($this->data['nameproduct']);
        $this->data['listproducts']=tblproduct::query()
            ->with('getDetail','getImages')
            ->orderBy('idproduct','DESC')
            ->where([
            	['pathPro','like','%'.$pathproduct.'%'],
            	['codepro','like','%'.$this->data['codeproduct'].'%']
            ])
            ->get()->toArray();
        $this->data['countproduct']=tblproduct::where([
            	['pathPro','like','%'.$pathproduct.'%'],
            	['codepro','like','%'.$this->data['codeproduct'].'%']
            ])->get()->count();
        return view('admins.product',$this->data);
    }
    public function productdelete(Request $request){
        $result['resuilt_delete']='Đã xóa bản ghi thành công';
        foreach ($request->delete_id as $idproduct) {
            if(!$this->processingpro->deleteProduct_by_id($idproduct)){
                $result['resuilt_delete']='Đã xảy ra lỗi khi xóa bản ghi '.$idproduct;
                break;
            }
        }
        return response()->json($result);
    }
    public function get_productadd(Request $request){
        $this->data['listCategory']=tblcategory::
            where('typeCt','product')
            ->get()->toArray();
        $this->data['listProducer']=tblproducer::all()->toArray();
        
        return view('admins.productadd',$this->data);
    }
    public function post_productadd(Request $request){
        $this->data['listCategory']=tblcategory::
            where('typeCt','product')
            ->get()->toArray();
        $this->data['listProducer']=tblproducer::all()->toArray();

        $rules=$this->processingpro->getRules();
        $messages=$this->processingpro->getMessasges();
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){            
            return View('admins.productadd',$this->data)->withErrors($validator);
        }
        $this->processingpro->productinsert($request);
        
        return view('admins.productadd',$this->data);
    }

    public function get_productedit($idproduct,$_tonken){
        $this->data=array_merge($this->data,
                $this->processingpro->datashow_productedit($idproduct,$_tonken));
        return view('admins.productedit',$this->data);
    }

    public function post_productedit(Request $request,$idproduct,$_tonken){
        $this->data=$this->processingpro->datashow_productedit($idproduct,$_tonken);
        $rules=$this->processingpro->getRules(false);
        $messages=$this->processingpro->getMessasges(false);
        $validator=Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){            
            return View('admins.productadd',$this->data)->withErrors($validator);
        }
        if($request->_tonken==$_tonken){
            $this->processingpro->editproduct($request,$idproduct);
        }

        return redirect('/admin/product/edit-'.$idproduct.'/'.$_tonken);
    }

    public function post(Request $request){
        //page
            $this->data['urlpage']=Url()->current().'?';
            $this->data['productNumberDisplayed']=20;
            $this->data['page']=1;
            if(isset($request->page))
                $this->data['page']=$request->page;
        //end page
        $this->data['listposts']=tblpost::
            select('tblposts.*','users.name','tblimages.*')
            ->join('users','tblposts.id','=','users.id')
            ->join('tblimages','tblposts.idImg','=','tblimages.idImg')
            ->offset(($this->data['page']-1)*$this->data['productNumberDisplayed'])
            ->take($this->data['productNumberDisplayed'])
            ->get()->toArray();
        $this->data['countproduct']=tblpost::all()->count();
        return view('admins.post',$this->data);
    }

    public function postdelete(Request $request){
        $isdelete_idPost=false;
        $idPost_false='';
        foreach ($request->delete_id as $idPost) {
            try {
                tblpost::where('idPost',$idPost)->delete();
                tblseo::where('idPost',$idPost)->delete();
                $isdelete_idPost=true;
            } catch (Exception $e) {
                $isdelete_idPost=false;
                $idPost_false=$idcategory;
                break;
            }
        }
        if ($isdelete_idPost)
            return response()->json(['resuilt_delete'=>'Đã xóa bản ghi thành công']);
        return response()->json(['resuilt_delete'=>'Đã xảy ra lỗi khi xóa bản ghi '.$idPost_false]);
    }
    public function get_postadd(Request $request){
        $this->data['listcategory']=tblcategory::
            where('typeCt','post')
            ->orWhere('typeCt','product')
            ->get()->toArray();
        return view('admins.postadd',$this->data);
    }
    public function post_postadd(Request $request){
        $this->data['listcategory']=tblcategory::
            where('typeCt','post')
            ->orWhere('typeCt','product')
            ->get()->toArray();
        $rules=postProcessing::getRules();
        $messages=postProcessing::getMessasges();
        $validator=Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return View('admins.postadd',$this->data)->withErrors($validator);
        }
        postProcessing::insertPost($request);
        return view('admins.postadd',$this->data);
    }
    public function get_postedit($idPost,$_tonken){
        $this->data=array_merge($this->data,
            postProcessing::datashowpost($idPost,$_tonken));
        return view('admins.postedit',$this->data);
    }
    public function post_postedit(Request $request,$idPost,$_tonken){
        if(isset($request->btnpostAdd) && $request->_tonken==$_tonken){
            postProcessing::editpost($request,$idPost);
        }
        $this->data=array_merge($this->data,
            postProcessing::datashowpost($idPost,$_tonken));
        return view('admins.postedit',$this->data);
    }

    public function choosefolder(Request $request){
        $listnameimages=scandir(public_path().$request->pathfolder);
        $listsrcImg=[];
        foreach ($listnameimages as $name) {
            if(is_file(public_path().$request->pathfolder.'/'.$name)){
                $listsrcImg[]=$request->pathfolder.'/'.
                    stringProcessing::convert_PathUrl($name);
            }
        }
        $listimages=tblimage::
            whereIn('srcImg',$listsrcImg)
            ->get()->toArray();
        return response()->json(['listimages'=>$listimages]);
    }

    public function producer(){
        $this->data['listproducer']=tblproducer::
            join('tblimages','tblproducers.idImg','=','tblimages.idImg')
            ->get()->toArray();
        return view('admins.producer',$this->data);
    }
    public function addproducer(Request $request){
         $notifi_nameproducer=$notifi_pathproducer='';
        if(isset($request->btnsubmit)){
            $notifi_nameproducer='Tên Nhà Sản Xuất là trường bắt buột.';
            $notifi_pathproducer='Dữ Liệu Đã Tồn Tại';
        }
        $this->data['actionform']='add';
        $rules=[
            'nameproducer'=>'required',
            'pathProducer'=>'unique:tblproducers'
        ];
        $messages=[
            'nameproducer.required'=>$notifi_nameproducer,
            'pathProducer.unique'=>$notifi_pathproducer
        ];
        $validator=Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()) {
            return view('admins.formproducer',$this->data)->withErrors($validator);
        }
        productProcessing::insertproducer($request);
        return view('admins.formproducer',$this->data);
    }
    public function editproducer(Request $request,$pathproducer){
        $this->data['actionform']='edit/'.$pathproducer;
        $notifi_nameproducer=$notifi_pathproducer='';
        if (isset($request->btnsubmit)) 
            $notifi_nameproducer='Tên Nhà Sản Xuất là trường bắt buột.';
        $rules=['nameproducer'=>'required',];
        $messages=['nameproducer.required'=>$notifi_nameproducer,];

        $validator=Validator::make($request->all(),$rules,$messages);
        if ($validator->fails()){
            $this->data['infoProducer']=productProcessing::showproducer($pathproducer);
            return view('admins.formproducer',$this->data)->withErrors($validator);
        }
        if (isset($request->btnsubmit)){
            productProcessing::updateProducer($request,$pathproducer);
        }
        $this->data['infoProducer']=productProcessing::showproducer($pathproducer);
        return view('admins.formproducer',$this->data)->withErrors($validator);
    }
    public function deleteproducer(Request $request){
        $result['resuilt_delete']='Đã xóa bản ghi thành công';
        foreach ($request->delete_id as $idProducer) {
            if(!$this->processingpro->deleteproducer_by_id($idProducer)){
                $result['resuilt_delete']='Đã xảy ra lỗi khi xóa bản ghi '.$idProducer;
                break;
            }
        }
        return response()->json($result);
    }
    public function li_slide(){
        return view('admins.li-slide');
    }
    public function li_service(){
        return view('admins.li-service');
    }
    public function li_custom(){
        return view('admins.li-custom');
    }
    public function banner(Request $request){
        $this->data=array_merge($this->data,processBanner::showbanner());
        return view('admins.banner',$this->data);
    }
    public function editbanner(Request $request){
        if(isset($request->savebanner)){
             processBanner::editbanner($request);
        }
        $this->data=array_merge($this->data,processBanner::showbanner());
        return view('admins.banner',$this->data);
    }

    public function introduce(Request $request){
        if(isset($request->btnintroduce)){
            DB::table('tblhtmls')
                ->where('properties','gioi-thieu')
                ->update(['value'=>$request->introduce]);
        }
        $this->data['container_introduce']=tblhtml::
            where('properties','gioi-thieu')
            ->first()->toArray()['value'];
        return view('admins.introduce',$this->data);
    }

}