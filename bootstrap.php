<?php
require_once(cockpit("less")->_dir.'/Less.php');

$this->module("less")->extend([
    'compile' => function($path, $compress = false) use($app) {
        if (!$this->app->path("cache:less")) mkdir($this->app->path("cache:")."less", 0700);
        $less_files = [$this->app->path("site:{$path}") => $this->app["site_url"]];
        $options = ['cache_dir' => $this->app->path("cache:less"), 'compress'=>$compress];
        $output = $this->app->path("cache:less/".Less_Cache::Get($less_files, $options));
        $output = $this->app->pathToUrl($output);
        return $output;
    }
]);

if (!function_exists('less')) {
    function less($path) {
        return cockpit('less')->compile($path);
    }
}
?>