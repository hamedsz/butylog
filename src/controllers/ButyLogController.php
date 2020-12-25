<?php

namespace hamedsz\butylog\controllers;

use hamedsz\butylog\ButyLog;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;

class ButyLogController extends Controller
{
    public function main()
    {
        $dirs = ButyLog::getAllDirs();

        return view("butylog::main" , [
            'dirs' => $dirs
        ]);
    }

    public function url(Request $request , $url)
    {
        $page_count = $request->page_count ?? 25;

        $dirs = ButyLog::getDir($url);
        $c = Collection::make($dirs);

        $c = $c->sortBy('name' , SORT_REGULAR , true);

        $data = [
            'dirs' => $c
                ->skip(($request->offset ?? 0) * $page_count)
                ->take($page_count),
            'total_count' => $c->count(),
            'pages' => ceil($c->count() / $page_count),
            'key' => $url,
            'this_page' => $request->offset ?? 0
        ];

        return view("butylog::url" , $data);
    }

    public function log(Request $request , $url , $file)
    {
        $logs = ButyLog::getFile($url , $file);

        return view("butylog::log" , [
            'logs' => $logs
        ]);
    }
}
