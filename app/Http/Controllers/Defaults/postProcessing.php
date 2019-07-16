<?php

namespace App\Http\Controllers\Defaults;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\tblcategory;
use App\Model\tblseo;
use App\Model\tblproduct;
use App\Model\tblproducer;
use App\Model\tblproductDetail;
use App\Model\tblpost;
use App\Model\tblimage;
use App\Model\tblinvoiceDetail;
use App\Http\Controllers\Controller;

class postProcessing extends Controller
{
    function __construct()
    {
    	
    }

    public static function getRules($insert=true){
        $rules=[
            'txtnamepost'=>'required',            
            'txtmetatitle'=>'required'
        ];
        if($insert)
            $rules['pathPost']='unique:tblposts';
        return $rules;
    }

    public static function getMessasges($insert=true){
        $messages=[
            'txtnamepost.required'=>'Tiêu Đề Bài Viết là trường bắt buột.',
            'txtmetatitle.required'=>'meta title là trường bắt buột.'
        ];
        if($insert)
            $messages['pathPost.unique']='Trường dữ liệu SEO url(path) đã tồn tại.';
        return $messages;
    }

    public static function insertPost(Request $request){
        tblpost::insert([
            'id'=>$request->userid,
            'idcategory'=>$request->slidcategory,
            'titlePost'=>$request->txtnamepost,
            'pathPost'=>$request->pathPost,
            'shortDescription'=>$request->txtshortDespost,
            'contentPost'=>$request->post_content,
            'idImg'=>$request->txtidimg,
            'numview'=>rand(186,429),
            'quote'=>$request->txtquote,
            'status'=>$request->txtstatuspost
        ]);

    	$idPost=tblpost::select('idPost')->orderBy('idPost', 'DESC')->first()->toArray();
        tblseo::insert([
            'metaTag'=>$request->txtmetatitle,
            'tags'=>$request->txttagspost,
            'description'=>$request->txtdespost,
            'keyword'=>$request->txtkeywordpost,
            'idPost'=>$idPost['idPost']
        ]);
    }

    public static function editpost(Request $request,$idpost){
    	$tblpost=tblpost::find($idpost);
        $tblpost->id=$request->userid;
        $tblpost->idcategory=$request->slidcategory;
        $tblpost->titlePost=$request->txtnamepost;
        $tblpost->pathPost=$request->pathPost;
        $tblpost->shortDescription=$request->txtshortDespost;
        $tblpost->idImg=$request->txtidimg;
        $tblpost->status=$request->txtstatuspost;
        $tblpost->contentPost=$request->post_content;
        $tblpost->quote=$request->txtquote;
        $tblpost->save();

        $idSeo=tblseo::where('idPost',$idpost)->first()->toArray();
        $tblseo=tblseo::find($idSeo['idSeo']);
        $tblseo->metaTag=$request->txtmetatitle;
        $tblseo->tags=$request->txttagspost;
        $tblseo->description=$request->txtdespost;
        $tblseo->keyword=$request->txtkeywordpost;
        $tblseo->save();
    }

    public static function datashowpost($idPost,$_tonken){
    	$data['listcategory']=tblcategory::where('typeCt','post')->orWhere('typeCt','product')->get()->toArray();
        $data['infoPost']=tblpost::where('idPost',$idPost)->first()->toArray();
        $data['infoseo']=tblseo::where('idPost',$idPost)->first()->toArray();
        $data['images']=tblimage::where('idImg',$data['infoPost']['idImg'])->first()->toArray();
        $data['_tonken']=$_tonken;
        $data['status_true']=$data['status_false']='';
        if($data['infoPost']['status']==1)
            $data['status_true']='selected="selected"';
        else
            $data['status_false']='selected="selected"';
        return $data;
    }
}
