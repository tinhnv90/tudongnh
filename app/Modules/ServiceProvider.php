<?php
namespace App\Modules;
use File;
use Illuminate\Support\Facades\View;

class ServiceProvider extends  \Illuminate\Support\ServiceProvider{
    public function boot(){
        $listModule = array_map('basename', File::directories(__DIR__));
        foreach ($listModule as $module) {
            if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
                include __DIR__.'/'.$module.'/routes.php';
            }
            if(is_dir(__DIR__.'/'.$module.'/Views')) {
                $this->loadViewsFrom(__DIR__.'/'.$module.'/Views', $module);
            }
        }
        $domain=asset('/public');
        View::share('style',$domain.'/css/local/');
        View::share('styleAdmin',$domain.'/css/admin/');
        View::share('script',$domain.'/js/local/');
        View::share('scriptAdmin',$domain.'/js/admin/');
        View::share('icons',$domain.'/images/icons/');
    }
    public function register(){}
}
?>