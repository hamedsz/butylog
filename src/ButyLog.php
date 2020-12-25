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
        self::execute();
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

    public static function getAllDirs()
    {
        $dirs = Storage::disk('local')->directories('butylogs');

        $i = 0;
        foreach ($dirs as $dir)
        {
            $dirs[$i] = [];
            $dirs[$i]['name'] = str_replace("butylogs/" , '' , $dir);
            $dirs[$i]['key'] = $dirs[$i]['name'];
            $dirs[$i]['name'] = base64_decode($dirs[$i]['name']);
            $dirs[$i]['count'] = count(Storage::files($dir));

            $i++;
        }

        return $dirs;
    }

    public static function getDir($dir)
    {
        $files = Storage::disk('local')->files('butylogs/'. $dir);


        $i = 0;
        foreach ($files as $file)
        {
            $files[$i] = [];
            $files[$i]['name'] = str_replace("butylogs/" . $dir .'/' , '' , $file);
            $files[$i]['name'] = str_replace('.json' , '' , $files[$i]['name']);

            $i++;
        }

        return $files;
    }

    public static function getFile($dir , $file)
    {
        $data = Storage::disk('local')->get("butylogs/" . $dir . "/" . $file . ".json");

        return json_decode($data);
    }
}
