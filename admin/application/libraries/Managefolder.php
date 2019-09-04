<?php

/*
 * Class name : Managefolder
 * Author : Sakchai Kantada
 * Mail : sakchaiwebmaster@gmail.com
 */

class Managefolder {

    public function getRootPath() {
        $str = "";
        $str = str_replace("index.php", "", $_SERVER['SCRIPT_FILENAME']);
        $str = str_replace("index.html", "", $str);
        return $str;
//        if(!empty($_SERVER['DOCUMENT_ROOT'])){
//            $_SERVER['DOCUMENT_ROOT']=rtrim($_SERVER['DOCUMENT_ROOT']);
//            if(substr($_SERVER['DOCUMENT_ROOT'],strlen($_SERVER['DOCUMENT_ROOT'])-1,1)!="/"){
//                $_SERVER['DOCUMENT_ROOT'].="/";
//            }
//        }
//        return $_SERVER['DOCUMENT_ROOT'];
    }

    // ไม่ต้องส่ง ROOTPATH มา
    public function createfolder($_path = "") {
        $rootPath = $this->getRootPath();

        $folderPath = "";
        if (!empty($_path)) {
            $tmp = explode("/", $_path);
            foreach ($tmp as $val) {
                if (!empty($val)) {
                    $folderPath.=$val . "/";
                    if (!is_dir($rootPath . $folderPath)) {
                        @mkdir($rootPath . $folderPath, 0777);
                    }
                }
            }
        }
    }

    // ไม่ต้องส่ง ROOTPATH มา
    public function removefolder($_path = "") {
        $rootPath = $this->getRootPath();

        if (!empty($_path)) {
            if (is_dir($rootPath . $_path)) {
                @rmdir($rootPath . $_path);
            }
        }
    }

    public function convert_path($path) {
        $this->createfolder($path . '/' . date('Y') . '/' . date('m'));
        return $path . '/' . date('Y') . '/' . date('m');
    }

    public function convert_namefile($str) {
        $temp = explode('/', $str);
        $count = count($temp);
        return $temp[$count - 5] . '/' . $temp[$count - 4] . '/' . $temp[$count - 3] . '/' . $temp[$count - 2] . '/' . $temp[$count - 1];
    }

    public function convert_namefile2($str) {
        $temp = explode('/', $str);
        $count = count($temp);
        return $temp[$count - 3] . '/' . $temp[$count - 2] . '/' . $temp[$count - 1];
    }

}
