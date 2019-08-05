<?php

namespace App\Http\Controllers;

use DB;
use App\Model\tblpost;
use App\Model\tblhtml;
use App\Http\Requests;
use App\Model\tblimage;
use App\Model\tblcategory;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $data;
    public function __construct()
    {
        $this->middleware('auth');
        if(!Auth::check() || Auth::user()->type!=68){
            Auth::logout();
            return redirect('admin/login');
        }
            $this->data['useradmin']=Auth::user();
            $this->data['useradmin']['srcImg']=tblimage::
                where('idImg',$this->data['useradmin']['idImg'])
                ->first()->toArray()['srcImg'];
    }

    public function logout(){
        Auth::logout();
    }
    public function infohome(){
        $this->data['listwarpper']=[];
        $listwarpper=tblhtml::where('properties','like','warpper%')->get();
        if($listwarpper!=null){
            $this->data['listwarpper']=$listwarpper->toArray();
        }

        $this->data['leftMain']=[];
        $leftMain=tblhtml::where('properties','like','leftMain%')->get();
        if($leftMain!=null){
            $this->data['leftMain']=$leftMain->toArray();
        }

        $this->data['idcategory']=0;
        $idcategory=tblhtml::where('properties','listproduct')->first();
        if($idcategory!=null){
            $this->data['idcategory']=$idcategory->toArray()['value'];
        }

        $this->data['typelistproduct']='';
        $typelistproduct=tblhtml::where('properties','typelistproduct')->first();
        if($typelistproduct!=null){
            $this->data['typelistproduct']=$typelistproduct->toArray()['value'];
        }

        $this->data['idcategorymain']=0;
        $idcategorymain=tblhtml::
            where('properties','listProductOfCategoryInHome')->first();
        if($idcategorymain!=null){
            $this->data['idcategorymain']=$idcategorymain->toArray()['value'];
        }

        $this->data['postType']='';
        $postType=tblhtml::where('properties','postType')->first();
        if($postType!=null){
            $this->data['postType']=$postType->toArray()['value'];
        }
        $this->data['listpost']=[];
        $listpost=tblpost::orderBy('titlePost','ASC')->get();
        if($listpost!=null){
            $this->data['listpost']=$listpost->toArray();
        }

        $specialPost=tblhtml::where('properties','like','specialPost%')->get();
        if($specialPost!=null){
            $this->data['specialPost']=$specialPost->toArray();
        }
        return view('admins.home',$this->data);
    }
    public function savewarpper(Request $request){
        $ischeck=tblhtml::where('properties','warpper-1')->first();
        if($ischeck==null){
            tblhtml::insert([
                'properties'=>'warpper-1',
                'descript'=>$request->war1_top,
                'value'=>$request->war1_bottom
            ]);
            tblhtml::insert([
                'properties'=>'warpper-2',
                'descript'=>$request->war2_top,
                'value'=>$request->war2_bottom
            ]);
            tblhtml::insert([
                'properties'=>'warpper-3',
                'descript'=>$request->war3_top,
                'value'=>$request->war3_bottom
            ]);
            tblhtml::insert([
                'properties'=>'warpper-4',
                'descript'=>$request->war4_top,
                'value'=>$request->war4_bottom
            ]);
            $result='insert';
        }else{
            DB::table('tblhtmls')->where('properties','warpper-1')
                ->update([
                    'descript'=>$request->war1_top,
                    'value'=>$request->war1_bottom
                ]);
            DB::table('tblhtmls')->where('properties','warpper-2')
                ->update([
                    'descript'=>$request->war2_top,
                    'value'=>$request->war2_bottom
                ]);
            DB::table('tblhtmls')->where('properties','warpper-3')
                ->update([
                    'descript'=>$request->war3_top,
                    'value'=>$request->war3_bottom
                ]);
            DB::table('tblhtmls')->where('properties','warpper-4')
                ->update([
                    'descript'=>$request->war4_top,
                    'value'=>$request->war4_bottom
                ]);
            $result='update';
        }
        return response()->json(['result'=>$result]);
    }
    public function saveContentLeft(Request $request){
        $ischeck=tblhtml::where('properties','leftMain-1')->first();
        if($ischeck==null){
            tblhtml::insert([
                'properties'=>'leftMain-1',
                'descript'=>$request->leftMain1T,
                'value'=>$request->leftMain1B
            ]);
            tblhtml::insert([
                'properties'=>'leftMain-2',
                'descript'=>$request->leftMain2T,
                'value'=>$request->leftMain2B
            ]);
            tblhtml::insert([
                'properties'=>'leftMain-3',
                'descript'=>$request->leftMain3T,
                'value'=>$request->leftMain3B
            ]);
            tblhtml::insert([
                'properties'=>'leftMain-4',
                'descript'=>$request->leftMain4T,
                'value'=>$request->leftMain4B
            ]);
            tblhtml::insert([
                'properties'=>'leftMain-5',
                'descript'=>$request->leftMain5T,
                'value'=>'img'
            ]);
            $result='insert';
        }else{
            DB::table('tblhtmls')->where('properties','leftMain-1')
                ->update([
                    'descript'=>$request->leftMain1T,
                    'value'=>$request->leftMain1B
                ]);
            DB::table('tblhtmls')->where('properties','leftMain-2')
                ->update([
                    'descript'=>$request->leftMain2T,
                    'value'=>$request->leftMain2B
                ]);
            DB::table('tblhtmls')->where('properties','leftMain-3')
                ->update([
                    'descript'=>$request->leftMain3T,
                    'value'=>$request->leftMain3B
                ]);
            DB::table('tblhtmls')->where('properties','leftMain-4')
                ->update([
                    'descript'=>$request->leftMain4T,
                    'value'=>$request->leftMain4B
                ]);
            DB::table('tblhtmls')->where('properties','leftMain-5')
            ->update(['descript'=>$request->leftMain5T]);
            $result='update';
        }
        return response()->json(['result'=>$result]);
    }
    public function saveListProduct(Request $request){
        if($request->has('idcategory')){
            $ischeck=tblhtml::
                where('properties','listproduct')->first();
            if($ischeck==null){
                tblhtml::insert([
                    'descript'=>'danh sách sản phẩm xem nhiều',
                    'properties'=>'listproduct',
                    'value'=>$request->idcategory
                ]);
                $result='insert category';
            }else{
                DB::table('tblhtmls')
                ->where('properties','listproduct')
                ->update(['value'=>$request->idcategory]);
                $result='update category';
            }
        }else{
            $ischeck=tblhtml::
                where('properties','typelistproduct')->first();
            if($ischeck==null){
                tblhtml::insert([
                    'descript'=>'sắp xếp sản phẩm theo',
                    'properties'=>'typelistproduct',
                    'value'=>$request->productType
                ]);
                $result='insert type display';
            }else{
                DB::table('tblhtmls')
                ->where('properties','typelistproduct')
                ->update(['value'=>$request->productType]);
                $result='update type display';
            }
        }
        return response()->json(['result'=>$result]);
    }
    public function saveProductMain(Request $request){
        $ischeck=tblhtml::where('properties','productMain')->first();
        if($ischeck==null){
            tblhtml::insert([
                'descript'=>'8 sản phẩm chính của website hiển thị trên trang home',
                'properties'=>'listProductOfCategoryInHome',
                'value'=>$request->productMain
            ]);
            $result='insert productMain';
        }else{
            DB::table('tblhtmls')
                ->where('properties','listProductOfCategoryInHome')
                ->update(['value'=>$request->productMain]);
            $result='update productMain';
        }
        return response()->json(['result'=>$result]);
    }
    public function savePostType(Request $request){
       $ischeck=tblhtml::where('properties','postType')->first();
        if($ischeck==null){
            tblhtml::insert([
                'descript'=>'sắp xếp bài đăng theo',
                'properties'=>'postType',
                'value'=>$request->postType
            ]);
            $result='insert postType';
        }else{
            DB::table('tblhtmls')
                ->where('properties','postType')
                ->update(['value'=>$request->postType]);
            $result='update postType';
        }
        return response()->json(['result'=>$result]);
    }
    public function savespecialPost(Request $request){
        $ischeck=tblhtml::where('properties','specialPost1')->first();
        if($ischeck==null){
            tblhtml::insert([
                'properties'=>'specialPost1',
                'value'=>$request->idPost
            ]);
            $result='insert specialPost1';
        }else{
            DB::table('tblhtmls')
                ->where('properties','specialPost1')
                ->update(['value'=>$request->idPost]);
            $result='update specialPost1';
        }
        return response()->json(['result'=>$result]);
    }

    public function savepost2(Request $request){
        $ischeck=tblhtml::where('properties','specialPost2')->first();
        if($ischeck==null){
            tblhtml::insert([
                'properties'=>'specialPost2',
                'value'=>$request->idPost
            ]);
            $result='insert specialPost2';
        }else{
            DB::table('tblhtmls')
                ->where('properties','specialPost2')
                ->update(['value'=>$request->idPost]);
            $result='update specialPost2';
        }
        return response()->json(['result'=>$result]);
    }

    public function savepost3(Request $request){
        $ischeck=tblhtml::where('properties','specialPost3')->first();
        if($ischeck==null){
            tblhtml::insert([
                'properties'=>'specialPost3',
                'value'=>$request->idPost
            ]);
            $result='insert specialPost3';
        }else{
            DB::table('tblhtmls')
                ->where('properties','specialPost3')
                ->update(['value'=>$request->idPost]);
            $result='update specialPost3';
        }
        return response()->json(['result'=>$result]);
    }
}
