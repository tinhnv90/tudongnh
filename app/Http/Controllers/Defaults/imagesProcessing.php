<?php

namespace App\Http\Controllers\Defaults;

use Illuminate\Http\Request;
use App\Model\tblimage;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class imagesProcessing extends Controller
{
    function __construct()
    {
    	
    }

    public static function rmdir_recurse($path = null) {
		$path = rtrim($path, '/') . '/';
		$handle = opendir($path);

		foreach(){
			if($file != '.' and $file != '..' ) {
				$fullpath = $path.$file;
				if(is_file($fullpath)){
					echo $path."<br/>";
					unlink($fullpath);
				}
				else $this->rmdir_recurse($fullpath);
			}
		}
		closedir($handle);
		rmdir($path);
	}
}
