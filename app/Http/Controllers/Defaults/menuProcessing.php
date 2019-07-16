<?php

namespace App\Http\Controllers\Defaults;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Model\tblcategory;
use App\Model\tblseo;
use App\Model\tblproduct;
use App\Model\tblhtml;
use App\Model\tblproducer;
use App\Model\tblproductDetail;
use App\Model\tblpost;
use App\Model\tblinvoiceDetail;
use App\Http\Controllers\Controller;

class menuProcessing extends Controller
{
    function __construct()
    {
    	
    }

    public static function get_List_Category($pathCt=''){
        return tblcategory::query()
            ->with('children','children.children')
            ->where(['leveCt'=>0,'statusCt'=>1,['pathCt','like','%'.$pathCt.'%']])
            ->orderBy('orderCt')
            ->get()->toArray();
    }

    public static function deleteCategory_by_id($idcategory){
    	try {
                $listidcategory=tblcategory::select('idcategory')->where('leveCt',$idcategory)->get()->toArray();
                $listidcate=[$idcategory];
                foreach ($listidcategory as $idcate) {
                    $listidcate[]=$idcate['idcategory'];
                }

                $listidproduct=tblproduct::select('idproduct')->whereIn('idcategory',$listidcate)->get()->toArray();
                $listidpro=[];
                foreach ($listidproduct as $idpro) {
                    $listidpro[]=$idpro['idproduct'];
                }

            if($listidpro!=null){
                tblinvoiceDetail::whereIn('idproduct',$listidpro)->delete();
                tblproductDetail::whereIn('idproduct',$listidpro)->delete();
                tblseo::whereIn('idproduct',$listidpro)->delete();
                tblproduct::where('idcategory',$listidcate)->delete();
            }
            
            tblcategory::whereIn('idcategory',$listidcate)->delete();
            tblseo::whereIn('idcategory',$listidcate)->delete();
            tblseo::where('idcategory',$idcategory)->delete();
            tblcategory::where('idcategory',$idcategory)->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public static function menuedit(Request $request,$idcategory){
        $tblcategory = tblcategory::find($idcategory);
        $tblcategory->titleCt=$request->txtName_category;
        $tblcategory->pathCt=$request->pathCt;
        $tblcategory->typeCt=$request->sltypeCt;
        $tblcategory->leveCt=$request->idcategory;
        $tblcategory->orderCt=$request->txtOrderCt;
        $tblcategory->statusCt=$request->statusCt;
        $tblcategory->idImg=$request->idimg;
        $tblcategory->showproducthome=$request->showproducthome;
        $tblcategory->save();

        $idSeo=tblseo::where('idcategory',$idcategory)->first()->toArray();
        $tblseo=tblseo::find($idSeo['idSeo']);
        $tblseo->metaTag=$request->txtMetaTag_category;
        $tblseo->tags=$request->txtTags_category;
        $tblseo->description=$request->txtDescription_category;
        $tblseo->keyword=$request->txtkeyWord_category;
        $tblseo->save();
    }

    public static function menuinsert(Request $request){
        tblcategory::insert([
            'titleCt'=>$request->txtName_category,
            'pathCt'=>$request->pathCt,
            'typeCt'=>$request->sltypeCt,
            'leveCt'=>$request->idcategory,
            'orderCt'=>$request->txtOrderCt,
            'statusCt'=>$request->statusCt,
            'idImg'=>$request->idimg,
            'showproducthome'=>$request->showproducthome
        ]);

        $tblcategory=tblcategory::select('idcategory')->orderBy('idcategory', 'DESC')->first();
        tblseo::insert([
            'metaTag'=>$request->txtMetaTag_category,
            'tags'=>$request->txtTags_category,
            'description'=>$request->txtDescription_category,
            'keyword'=>$request->txtkeyWord_category,
            'idcategory'=>$tblcategory->idcategory
        ]);
    }

    public static function get_Father_List(){
    	$father_List_Category=[];        
        $listCategory=tblcategory::all()->toArray();
        foreach ($listCategory as $category) {
            $father_List_Category[$category['leveCt']][]=$category;
        }
        return $father_List_Category;
    }

    public static function get_Father_List_Except_It($idcategory){
    	$father_List_Category=[];        
        $listCategory=tblcategory::all()->toArray();
        foreach ($listCategory as $category) {
            $father_List_Category[$category['leveCt']][]=$category;
        }
        return $father_List_Category;
    }

    public static function datashow_menuedit($idcategory,$_tonken){
        $data['List_father_categorys']=menuProcessing::get_Father_List_Except_It($idcategory);

        $data['idcategory']=$idcategory;
        $data['_tonken']=$_tonken;
        $data['infoCategory']=tblcategory::where('idcategory','=',$idcategory)->first()->toArray();

        $data['typect_web']='';
        $data['typect_post']='';
        $data['typect_product']='';
       
        if($data['infoCategory']['typeCt']=='web'){
            $data['typect_web']='selected="selected"';
        }
        if($data['infoCategory']['typeCt']=='product'){
            $data['typect_product']='selected="selected"';
        }
        if($data['infoCategory']['typeCt']=='post'){
            $data['typect_post']='selected="selected"';
        }

        $data['infoSeoCategory']=tblseo::where('idcategory','=',$data['infoCategory']['idcategory'])->first()->toArray();

        $data['selected_false']=$data['selected_true']='';
        if($data['infoCategory']['statusCt']==1)
            $data['selected_true']='selected="selected"';
        else
            $data['selected_false']='selected="selected"';
        $contentcate=tblhtml::where('properties',$data['infoCategory']['pathCt'])
            ->first();
        $data['contentCate']='';
        if($contentcate != null)
            $data['contentCate']=$contentcate->toArray()['value'];
        return $data;
    }

    public static function getRules($insert=true){
        $rules=[
            'txtName_category'=>'required',
            'txtMetaTag_category'=>'max:250',
            'txtDescription_category'=>'required',
            'txtkeyWord_category'=>'max:250',
            'txtOrderCt'=>'required|integer'
        ];
        if($insert)
            $rules['pathCt']='unique:tblcategories';
        return $rules;
    }
    public static function getMessages($insert=true){
        $messages=[
            'txtName_category.required'=>'Tên Danh Mục là trường bắt buột.',
            'txtMetaTag_category.max'=>'Tiêu đề Meta Tag không nhập quá 250 ký tự',
            'txtDescription_category.required'=>'Mô Tả từ khóa là trường bắt buộc.',
            'txtkeyWord_category.max'=>'độ dài KeyWord không nhập quá 250 ký tự',
            'txtOrderCt.required'=>'Thứ Tự là trường bắt buộc',
            'txtOrderCt.integer'=>'Thứ Tự cần nhập kiểu số'
        ];
        if($insert)
           $messages['pathCt.unique']='Trường dữ liệu SEO url(path) đã tồn tại.';

       return $messages;
    }
}
