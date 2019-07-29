<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\tblproduct;
use App\Http\Requests;
use App\Model\tblimage;

class BaseControllers extends Controller
{
    public function add_cart(Request $request){
        if($request->session()->has('productInTheCart') && 
                $request->session()->has('productInTheCart.'.$request->idproduct)){
            $request->session()->forget('productInTheCart.'.$request->idproduct);
            if(count($request->session()->get('productInTheCart'))==0)
                $request->session()->forget('productInTheCart');
        	$result='Đã Hủy Chọn Hàng';
        }else{
            $request->session()->push('productInTheCart.'.$request->idproduct,$request->productNumber);
            $result='Đã Chọn Hàng';
        }
        return response()->json(['result'=>$result]);
    }

    public function add_wishlist(Request $request){
        if($request->session()->has('productInTheWishlist') && 
                $request->session()->has('productInTheWishlist.'.$request->idproduct)){
            $request->session()->forget('productInTheWishlist.'.$request->idproduct);
            if(count($request->session()->get('productInTheWishlist'))==0)
                $request->session()->forget('productInTheWishlist');
            $result='Đã Hủy Chọn Hàng';
        }else{
            $request->session()->push('productInTheWishlist.'.$request->idproduct,1);
            $result='Đã Chọn Hàng';
        }
        return response()->json(['result'=>$result]);
    }

    public function add_compare(Request $request){
        if($request->session()->has('productInTheCompare') && 
                $request->session()->has('productInTheCompare.'.$request->idproduct)){
            $request->session()->forget('productInTheCompare.'.$request->idproduct);
            if(count($request->session()->get('productInTheCompare'))==0)
                $request->session()->forget('productInTheCompare');
            $result='Đã Hủy Chọn Hàng';
        }else{
            $request->session()->push('productInTheCompare.'.$request->idproduct,1);
            $result='Đã Chọn Hàng';
        }
        return response()->json(['result'=>$result]);
    }

    public function imagesProduct(){
    	$listproduct=tblproduct::query()->with('getParent.parentcategory')
    		->where('contentPro','like','%src="http://vinakitchen.net%')
    		->get()->toArray();
    	foreach($listproduct as $product){
		    echo $product['idproduct'].' - '.$product['pathPro'].'<br/>';
		    $arr=[42];
		    if($product['idproduct']>0){
    		$count=substr_count($product['contentPro'], '<img');
    		$content=$product['contentPro'];
    		for($i=0;$i<$count;$i++){
    			$startindex = strpos($content, '<img');
	    		$content=substr($content, $startindex,-1);
	    		$img=substr($content,0 ,strpos($content, '>')+1);
	    		$content=str_replace($img, '', $content).'suffixes';

	    		$startindex=strpos($img, 'src=');
	    		$img1=substr($img,$startindex+5,-1);
	    		$src=substr($img1,0,strpos($img1, '"'));

	    		$pathimages='/images/san-pham/';
	    		if($product['get_parent']['parentcategory']==null){
	    			$pathimages.=$product['get_parent']['pathCt'];
	    		}else{
	    			$pathimages.=$product['get_parent']['parentcategory']['pathCt'];
	    			$pathimages.='/'.$product['get_parent']['pathCt'];
	    		}
	    		$nameimg=explode('/', $src);
	    		$altImg=$nameimg[count($nameimg)-1];
	    		unset($nameimg);
	    		$pathimages.='/'.$altImg;

	    		$headers = @get_headers($src);
	    		$ischeck=strpos($headers[count($headers)-1], 'text/html');
	    		if(!$ischeck){
		    		if(!is_file(public_path().$pathimages) && $src!=false){
			            $image=file_get_contents(str_replace(' ','%20',$src));
			            $savefile = fopen(public_path().$pathimages, 'w');
			            fwrite($savefile, $image);
			            fclose($savefile);

			            $last_idImg=tblimage::orderBy('idImg','DESC')
			            	->first()->toArray()['idImg'];
			            tblimage::insert([
			                'idImg'=>++$last_idImg,
			                'pathImg'=>str_replace(['.jpeg','.png'], '', $altImg),
			                'altImg'=>$product['namePro'],
			                'srcImg'=>$pathimages,
			                'srcImgBig'=>$pathimages
			            ]);
			        }
			        $newimg=str_replace('alt=""','alt="'.$product['namePro'].'"', $img);
			        $newimg=str_replace($src, asset('/public'.$pathimages), $newimg);
			        $product['contentPro']=str_replace($img, $newimg, $product['contentPro']);
		    	}else{
		    		$product['contentPro']=str_replace($img,'', $product['contentPro']);
		    	}
    		}

    		$tblpro=tblproduct::find($product['idproduct']);
    		$tblpro->contentPro=$product['contentPro'];
    		$tblpro->save();
    	}
    	}
    }
}
