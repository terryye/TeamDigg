<?php namespace App\Libs;

/**
 * Class Storage
 * @package App\Libs
 *
 * 用于本地和SAE上传的抽象
 *
 */
class Storage {

    private static function _getBasePath($domain){

        return __DIR__  . "/../../storage/$domain/";
    }

    private static function _getBaseUrl($domain){

        return "http://localhost/web/teamdigg/2/laravel/storage/$domain/";
    }

    public static function getUrl($domain, $name){
        return self::_getBaseUrl($domain) . $name;
    }

    public static function saveUrl($domain, $destFileName, $url, $refer = null, $cookie = null){
        if($refer === null){
            $refer = $url;
        }

        if(is_array($cookie))
        {
            $str = '';
            foreach ($cookie as $key => $value){
                $str .= $key.'='.$value.';';
            }
            $cookie = substr($str,0,-1);
        }

        $option = array(
            'http' => array(
                'header' => "Referer:$refer\r\n".
                    "Cookie: ".$cookie."\r\n" .
                    "\r\n",
            )
        );

        //$refer就是伪造的HTTP_REFERER信息URL。
        $data = file_get_contents($url, FILE_BINARY, stream_context_create($option));
        if($data !== false){
            return self::write($domain, $destFileName, $data);
        }else{
            throw new Exception("save file error", -70003);
        }
    }

    public static function upload ($domain, $destFileName, $srcFileName){
        if(defined("SAE_ACCESSKEY")){
            $s = new SaeStorage();
            $result = $s->upload ($domain, $destFileName, $srcFileName);
        }else{
            $basePath = self::_getBasePath ($domain);
            $ret = move_uploaded_file( $srcFileName, $basePath . $destFileName );
            if($ret === true){
                $result = self::_getBaseUrl($domain) . $destFileName;
            }else{
                $result = false;
            }
        }

        if($result === false){
            throw new Exception("upload file to storage error", -70002);
        }
        return $result;
    }

    public static function write($domain, $destFileName, $data){
        if(defined("SAE_ACCESSKEY")){
            $s = new SaeStorage();
            $result = $s->write ($domain, $destFileName, $data);
        }else{
            $basePath = self::_getBasePath ($domain);
            $ret = file_put_contents( $basePath . $destFileName, $data );
            if($ret !== false){
                $result = self::_getBaseUrl($domain) . $destFileName;
            }else{
                $result = false;
            }
        }
        if($result === false){
            throw new Exception("write file to storage error", -70001);
        }
        return $result;
    }

    public static function read($domain, $filename){
        if(defined("SAE_ACCESSKEY")){
            $s = new SaeStorage();
            $result = $s->read ($domain, $filename);
        }else{
            $basePath = self::_getBasePath ($domain);
            $result = file_get_contents( $basePath . $filename );
        }

        if($result === false){
            throw new Exception("write file to storage error", -70001);
        }

        return $result;
    }


}

?>