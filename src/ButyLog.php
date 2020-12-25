<?php

namespace hamedsz\butylog;

use Illuminate\Support\Env;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ButyLog
{
    static $toLog = [];
    static $fileName;

    public static function log($title , $data)
    {
        if (Env::get("BUTYLOG") !== true)
            return;

        self::$toLog[] = [
            'title' => $title,
            'data' => $data
        ];

        self::setFilename();
    }

    public static function execute()
    {
        $json = json_encode(self::$toLog);

        Storage::disk('local')->put(self::$fileName , $json);
    }

    private static function setFilename()
    {
        if (is_null(self::$fileName))
        {
            self::$fileName = 'butylogs/' . base64_encode(Request::path()) . "/" . date("Y-m-d_H-i-s") . ".json";
        }
    }
}
