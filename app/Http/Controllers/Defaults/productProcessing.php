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

class productProcessing extends Controller
{
    function __construct()
    {
    	
    }

    public function deleteProduct_by_id($idproduct){
    	try {
            tblinvoiceDetail::where('idproduct','=',$idproduct)->delete();
            tblproductDetail::where('idproduct','=',$idproduct)->delete();
            tblseo::where('idproduct','=',$idproduct)->delete();
            tblproduct::where('idproduct','=',$idproduct)->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function editproduct(Request $request,$idproduct){
        $tblproduct = tblproduct::find($idproduct);
        $tblproduct->idcategory=$request->txtidcategory;
        $tblproduct->idProducer=$request->txtproducerpro;
        $tblproduct->namePro=$request->txtnamepro;
        $tblproduct->pathPro=$request->pathPro;
        $tblproduct->codepro=$request->txtcodepro;
        $tblproduct->idImg=$request->txtidimg;
        $tblproduct->contentPro=$request->post_content;
        $tblproduct->statusPro=$request->txtstatuspro;
        $tblproduct->save();

        $idProDetail=tblproductDetail::where('idproduct',$idproduct)->first()->toArray();
        $tblproDetail=tblproductDetail::find($idProDetail['idProDetail']);
        $tblproDetail->number=$request->txtnumberpro;
        $tblproDetail->unit=$request->txtunitpro;
        $tblproDetail->price=$request->txtpricepro;
        $tblproDetail->size=$request->txtsizepro;
        $tblproDetail->weight=$request->txtweightpro;
        $tblproDetail->poweCapacity=$request->txtpowerpro;
        $tblproDetail->save();

        $idSeo=tblseo::where('idproduct',$idproduct)->first()->toArray();
        $tblseo=tblseo::find($idSeo['idSeo']);
        $tblseo->metaTag=$request->txttitletagpro;
        $tblseo->tags=$request->txttagspro;
        $tblseo->description=$request->txtdescriptionpro;
        $tblseo->keyword=$request->txtkeywordpro;
        $tblseo->save();
    }

    public function productinsert(Request $request){
        tblproduct::insert([
            'idcategory'=>$request->txtidcategory,
            'idProducer'=>$request->txtproducerpro,
            'namePro'=>$request->txtnamepro,
            'pathPro'=>$request->pathPro,
            'codepro'=>$request->txtcodepro,
            'idImg'=>$request->txtidimg,
            'contentPro'=>$request->post_content,
            'numview' => rand(175,445),
            'statusPro'=>$request->txtstatuspro
        ]);

        $idpro=tblproduct::select('idproduct')->orderBy('idproduct', 'DESC')->first()->toArray();
        tblproductDetail::insert([
            'idproduct'=>$idpro['idproduct'],
            'number'=>$request->txtnumberpro,
            'unit'=>$request->txtunitpro,
            'price'=>$request->txtpricepro,
            'size'=>$request->txtsizepro,
            'weight'=>$request->txtweightpro,
            'poweCapacity'=>$request->txtpowerpro
        ]);

        tblseo::insert([
            'metaTag'=>$request->txttitletagpro,
            'tags'=>$request->txttagspro,
            'description'=>$request->txtdescriptionpro,
            'keyword'=>$request->txtkeywordpro,
            'idproduct'=>$idpro['idproduct']
        ]);
    }

    public function datashow_productedit($idproduct,$_tonken){
        $data['listCategory']=tblcategory::where('typeCt','product')->get()->toArray();
        $data['listProducer']=tblproducer::all()->toArray();

        $data['infoProducts']=tblproduct::where('idproduct',$idproduct)->first()->toArray();
        $data['images']=tblimage::where('idImg',$data['infoProducts']['idImg'])->first()->toArray();

        $data['infoProductDetail']=tblproductDetail::where('idproduct',$idproduct)->first()->toArray();
        $data['infoSeo']=tblseo::where('idproduct',$idproduct)->first()->toArray();

        $data['status_true']=$data['status_false']='';
        if($data['infoProducts']['statusPro']==1)
            $data['status_true']='selected="selected"';
        else
            $data['status_false']='selected="selected"';

        $data['idproduct']=$idproduct;
        $data['_tonken']=$_tonken;
        return $data;
    }

    public function getRules($insert=true){
        $rules=[
            'txtnamepro'=>'required',            
            'txtcodepro'=>'required',
            'txttitletagpro'=>'required',
            'txtpricepro'=>'integer',
            'txtweightpro'=>'integer',
            'txtpowerpro'=>'integer',
            'txtnumberpro'=>'integer'
        ];
        if($insert)
            $rules['pathPro']='unique:tblproducts';
        return $rules;
    }

    public function getMessasges($insert=true){
        $messages=[
            'txtnamepro.required'=>'Tên Sản Phẩm là trường bắt buột.',
            'txtcodepro.required'=>'Mã Sản Phẩm là trường bắt buột.',
            'txttitletagpro.required'=>'Tiêu đề là trường bắt buột.',
            'txtpricepro.integer'=>'Giá cần nhập kiểu số',
            'txtweightpro.integer'=>'Cân nặng nhập kiểu số',
            'txtpowerpro.integer'=>'Công suất nhập kiểu số',
            'txtnumberpro.integer'=>'Số Lượng cần nhập kiểu số',
        ];
        if($insert)
            $messages['txtpathpro.unique']='Trường dữ liệu SEO url(path) đã tồn tại.';
        return $messages;
    }


    public $listfolder;
    public $listfile;
    public function listImgPro($pathImg='/images/products',$name='/images/products',$namefolder='product'){
        $dir=public_path().$pathImg;
        $listItem=scandir($dir);
        unset($listItem[0]);unset($listItem[1]);

        foreach ($listItem as $items) {
            if(is_file($dir.'/'.$items)) 
                $this->listfile[$name][]=$pathImg.'/'.$items;
            else{ 
            $this->listImgPro($pathImg.'/'.$items,$pathImg.'/'.$items,$items);
            }
        }
        $this->listfolder[]=$pathImg;
    }
    public  function getlistfolder(){
        return $this->listfolder;
    }
    public function getlistfile(){
        return $this->listfile;
    }

    public static function insertproducer(Request $request){
        tblproducer::insert([
            'nameProducer'=>$request->nameproducer,
            'pathProducer'=>$request->pathProducer,
            'contentProducer'=>$request->contentproducer,
            'idImg'=>$request->txtidimg,
            'emailProducer'=>$request->emailproducer,
            'phoneProducer'=>$request->phoneproducer,
            'adressProducer'=>$request->adressproducer
        ]);
    }

    public static function updateProducer(Request $request,$pathproducer){
        $idproducer=tblproducer::where('pathProducer',$pathproducer)
            ->first()->toArray();
        $producer=tblproducer::find($idproducer['idProducer']);
        $producer->nameProducer=$request->nameproducer;
        $producer->pathProducer=$request->pathProducer;
        $producer->contentProducer=$request->contentproducer;
        $producer->idImg=$request->txtidimg;
        $producer->emailProducer=$request->emailproducer;
        $producer->phoneProducer=$request->phoneproducer;
        $producer->adressProducer=$request->adressproducer;
        $producer->save();
    }
    public static function showproducer($pathproducer){
        return tblproducer::
            join('tblimages','tblproducers.idImg','=','tblimages.idImg')
            ->where('pathProducer',$pathproducer)
            ->first()->toArray();
    }
    public function deleteproducer_by_id($idProducer){
        $listproduct=tblproduct::where('idProducer',$idProducer)->get();
        if($listproduct!=null){
            foreach ($listproduct as $product) {
                $this->deleteProduct_by_id($product['idproduct']);
            }
        }
        return tblproducer::where('idProducer',$idProducer)->delete();
    }
    public function showProductSeting(){
        
    }
}