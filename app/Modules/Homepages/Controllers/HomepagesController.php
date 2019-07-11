<?php
namespace App\Modules\Homepages\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomepagesController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }
    public function index(Request $request){
        return view('Homepages::index');
    }
}

?>