<?php

if (! function_exists('cdn')) {
    /**
     * CDNのURLを生成する
     *
     * @param  string  $path
     * @param  bool    $secure
     * @return string
     */
    function cdn($path, $secure = null)
    {
        $root = config('recipes.cdn_url');
        return app('url')->assetFrom($root, $path, $secure);
    }
}
