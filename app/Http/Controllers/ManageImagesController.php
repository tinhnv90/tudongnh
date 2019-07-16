<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Model\tblimage;
use Illuminate\Http\Request;
use App\Http\Controllers\Session;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Defaults\imagesProcessing;
use App\Http\Controllers\Defaults\stringProcessing;

class manageImagesController extends Controller
{
	public $data;
    public $folders;
    function __construct()
    {
    	if(Auth::check()){
            $this->data['useradmin']=Auth::user();
            $this->data['useradmin']['srcImg']=tblimage::
                where('idImg',$this->data['useradmin']['idImg'])
                ->first()->toArray()['srcImg'];
        }
    }

    public function home(Request $request){
	$this->data['scanfolder']=scandir(public_path().'/images');
		unset($this->data['scanfolder'][0]);
		unset($this->data['scanfolder'][1]);
    	return view('admins/mediaManager',$this->data);
    }

    public function homeurl($urlfolder){

    	$this->data['urlfolder']=$urlfolder;
    	if(!is_file(public_path().'/images/'.$urlfolder)){
	       $this->data['scanfolder']=scandir(public_path().'/images/'.$urlfolder);
			unset($this->data['scanfolder'][0]);
			unset($this->data['scanfolder'][1]);
    	}else $this->data['scanfolder']=[];
	
    	return view('admins/urlfolder',$this->data);
    }
    public function homeurl2($urlfolder,$urlfolder2){
    	$this->data['urlfolder']=$urlfolder;
    	$this->data['urlfolder2']=$urlfolder2;
		if(!is_file(public_path().'/images/'.$urlfolder.'/'.$urlfolder2)){
			$this->data['scanfolder']=scandir(public_path().'/images/'.$urlfolder.'/'.$urlfolder2);
			unset($this->data['scanfolder'][0]);
			unset($this->data['scanfolder'][1]);
		}else $this->data['scanfolder']=[];
    	return view('admins/urlfolder2',$this->data);
    }
    public function homeurl3($urlfolder,$urlfolder2,$urlfolder3){
    	$this->data['urlfolder']=$urlfolder;
    	$this->data['urlfolder2']=$urlfolder2;
    	$this->data['urlfolder3']=$urlfolder3;
		if(!is_file(public_path().'/images/'.$urlfolder.'/'.$urlfolder2.'/'.$urlfolder3)){
			$this->data['scanfolder']=scandir(public_path().'/images/'.$urlfolder.'/'.$urlfolder2.'/'.$urlfolder3);
			unset($this->data['scanfolder'][0]);
			unset($this->data['scanfolder'][1]);
		}else $this->data['scanfolder']=[];
    	return view('admins/urlfolder3',$this->data);
    }
    public function homeurl4($urlfolder,$urlfolder2,$urlfolder3,$urlfolder4){
    	$this->data['urlfolder']=$urlfolder;
    	$this->data['urlfolder2']=$urlfolder2;
    	$this->data['urlfolder3']=$urlfolder3;
    	$this->data['urlfolder4']=$urlfolder4;

		if(!is_file(public_path().'/images/'.$urlfolder.'/'.$urlfolder2.'/'.$urlfolder3.'/'.$urlfolder4)){
			$this->data['scanfolder']=scandir(public_path().'/images/'.$urlfolder.'/'.$urlfolder2.'/'.$urlfolder3.'/'.$urlfolder4);
			unset($this->data['scanfolder'][0]);
			unset($this->data['scanfolder'][1]);
		}else $this->data['scanfolder']=[];
    	return view('admins/urlfolder4',$this->data);
    }

    public function imagesdelete(Request $request){
        if(isset($request->idImgOpenFile)){
            $result['resuilt_delete']=1;
            $images=tblimage::where('idImg',$request->idImgOpenFile)
                ->first()->toArray();
            $path_folder=public_path().$images['srcImg'];
            unlink($path_folder);
            if(!tblimage::where('idImg',$images['idImg'])->delete())
                    $result['resuilt_delete']=0;
            return response()->json($result);
        }
        $result['resuilt_delete']='Đã xóa bản ghi thành công';
        $i=0;
        foreach ($request->listdelete_sqlpathimg as $pathImg) {
            $path_folder=public_path().$request->listpathimg_host[$i];
            if(is_file($path_folder)){
                unlink($path_folder);
                if(!tblimage::where('srcImg',$request->listpathimg_host[$i])->delete())
                    $result['resuilt_delete']='Ảnh "'.$pathImg.'" không có trên dữ liệu';
            }
            else
                $this->remove_dir($path_folder);
            $i++;   
        }
        return response()->json($result);
    }
    public function deleteimages(Request $request){
        $pathimg=public_path().$request->srcimg;
        tblimage::where('idImg',$request->idImgdelete)->delete();
        unlink($pathimg);
        return 'đã xóa file ảnh';
    }
    public function uploadfileimg(Request $request){
        for($i=0;$i<count($_FILES["namefile"]['name']);$i++){
            $namefile=stringProcessing::convert_PathUrl($_FILES["namefile"]['name'][$i]);
            $des=public_path().'/images/'.$request->txtdestination.'/'.$namefile;
            if(!is_file($des)){
                move_uploaded_file($_FILES["namefile"]['tmp_name'][$i], $des);
                tblimage::insert([
                    'altImg'=>str_replace(['.jpg','.png','.jpeg'],'',$_FILES["namefile"]['name'][$i]),
                    'pathImg'=>$namefile,
                    'srcImg'=>'/images/'.$request->txtdestination.'/'.$namefile,
                    'srcImgBig'=>'/images/'.$request->txtdestination.'/'.$namefile
                ]);
            }
        }
        return redirect('/admin/images/'.$request->txtdestination);
    }
    public function ajaxImage(Request $request){
        $filename = $request->file('file')->getClientOriginalName();
        $pathImg=stringProcessing::convert_PathUrl($filename);
        $request->file('file')->move('public'.$request->pathdes.'/', $pathImg);
        //insert tblimages
        $isimg=tblimage::where('srcImg',$request->pathdes.'/'. $pathImg)->count();
        if($isimg==0)
            tblimage::insert([
                'altImg'=>str_replace(['.jpg','.png','.jpeg'],'',$pathImg),
                'pathImg'=>$pathImg,
                'srcImg'=>$request->pathdes.'/'.$pathImg,
                'srcImgBig'=>$request->pathdes.'/'.$pathImg
            ]);
    }
    public function createfolder(Request $request){
            $result['resuilt_createfolder']='';
            $pathdir=public_path().'/images/'.$request->pathdir.'/New folder';
            if(!file_exists($pathdir)){
                if(!mkdir($pathdir))
                    $result['resuilt_createfolder']='false';
            }else $result['resuilt_createfolder']='Thư Mục Đã Tồn Tại';
        
        return response()->json($result);
    }
    public function createfolderajax(Request $request){
        $pathdir=public_path().$request->pathdir.'/New folder';
        if(!file_exists($pathdir)){
            if(!mkdir($pathdir))
                return 'false';
        }else{
            for ($i=2; $i < 10; $i++) { 
                $pathdir=public_path().$request->pathdir.'/New folder ('.$i.')';
                if(!file_exists($pathdir)){
                    mkdir($pathdir);
                    break;
                }
            }
        }
    }

    public function updatetitlefile(Request $request){
        $newaltimg=stringProcessing::convert_PathUrl($request->_newAltImg);
        if(is_file(public_path().$request->_oldSrcImg)){
            $_tblimg=tblimage::where('srcImg',$request->_oldSrcImg)->first()->toArray();
            rename(public_path().$request->_oldSrcImg, public_path().$request->_newSrcImg.$newaltimg);
            $updateImg=tblimage::find($_tblimg['idImg']);
            $updateImg->altImg=$request->_newAltImg;
            $updateImg->pathImg=$newaltimg;
            $updateImg->srcImg=$request->_newSrcImg.$newaltimg;
            $updateImg->save();
            return response()->json(['rename'=>'ok']);
        }else{ 
            $listtblimg=tblimage::where('srcImg','like',$request->_oldSrcImg.'%')->get()->toArray();
            foreach ($listtblimg as $rowupdate) {
                $linkscr=str_replace($request->_oldSrcImg, $request->_newSrcImg.$newaltimg, $rowupdate['srcImg']);
                $updateImg=null;
                $updateImg=tblimage::find($rowupdate['idImg']);
                
                $updateImg->srcImg=$linkscr;
                $updateImg->save();
            }
            rename(public_path().$request->_oldSrcImg, public_path().$request->_newSrcImg.$newaltimg);
        }
    }
    function remove_dir($dir = null) {
        $str='/home/maybom/domains/maybomhutbun.net/public_html/public';
        if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir")
                    $this->remove_dir($dir."/".$object);
                else{
                    unlink($dir."/".$object);
                    tblimage::where('srcImg',str_replace($str, '', $dir."/".$object))->delete();
                }
            }
        }
        reset($objects);
        rmdir($dir);
        }
    }
    function moveFolder($dir = null) {
        $str='/home/maybom/domains/maybomhutbun.net/public_html/public';
        if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir"){
                    $this->moveFolder($dir."/".$object); 
                }
                else{
                    $this->folders[]=$dir."/".$object;
                }
            }
        }
        reset($objects);
        $this->folders[]=$dir;
        }
    }

    public function copyclipboard(Request $request){
        $request->session()->put('listclipboard',$request->listclipboard);
        $request->session()->put('clipboardpathImg',$request->clipboardpathImg);
    }
    public function pasteclipboard(Request $request){
        $numberFolder=0;
        $listclipboard=$request->session()->get('listclipboard');
        $clipboardpathImg=$request->session()->get('clipboardpathImg');
        $ij=0;

        foreach ($listclipboard as $clipboard) {
            $this->folders=null;
            if(is_file(public_path().$clipboard)){
                $newsrcImg='/images'.$request->pathdest.'/'.$clipboardpathImg[$ij];
                $isFileExists=tblimage::where('srcImg',$newsrcImg)->first();

                if($isFileExists==null){
                    copy(public_path().$clipboard, public_path().$newsrcImg);
                    unlink(public_path().$clipboard);

                    $idimg=tblimage::where('srcImg',$clipboard)->first()->toArray();
                    $tblimage=tblimage::find($idimg['idImg']);
                    $tblimage->srcImg=$newsrcImg;
                    $tblimage->srcImgBig=$newsrcImg;
                    $tblimage->save();

                }else
                 return response()->json(['result_paste'=>
                    'Tập tin '.$clipboardpathImg[$ij].' đã tồn tại']); 
            }else{
                $this->moveFolder(public_path().$clipboard);
                $this->folders=array_reverse($this->folders);
                $i=0;
                $nameFileOrFolder=explode('/', $this->folders[0]);
                unset($nameFileOrFolder[count($nameFileOrFolder)-1]);
                $subpathdesOLD=implode('/', $nameFileOrFolder).'/';
                foreach ($this->folders as $folder) {
                    $_NEWSRCimg='/images'.$request->pathdest.'/'.
                        str_replace($subpathdesOLD, '', $folder);
                    $dest=public_path().$_NEWSRCimg;
                    $i=0;
                   if(is_file($folder)){
                        copy($folder, $dest);
                        tblimage::where('srcImg',str_replace(public_path(),'', $folder))->update(['srcImg'=>$_NEWSRCimg]);
                   }else{
                        mkdir($dest);
                   }
                   $i++;
                }
                $this->remove_dir(public_path().$clipboard);
            }
        }
        $request->session()->forget('listclipboard');
        $request->session()->forget('clipboardpathImg');

        return response()->json(['result_paste'=>'paste']);
    }
    public static function insert_images($altImg='',$pathImg='',$srcImg='',$srcImgBig=''){
        tblimage::insert([
            'altImg'=>$altImg,
            'pathImg'=>$pathImg,
            'srcImg'=>$srcImg,
            'srcImgBig'=>$srcImgBig
        ]);
    }
}
