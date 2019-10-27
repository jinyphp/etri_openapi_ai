<?php
/**
 * Etri OpenAI package
 * hojinlee(infohojin@naver.com)
 * https://github.com/jinyphp/etri_openapi_ai
 */
namespace Etri\OpenAi\Object;

class Detection
{
    const API_URL = "http://aiopen.etri.re.kr:8000/ObjectDetect";

    private $Request;
    public function __construct($key)
    {
        $this->Request = new \Etri\OpenAi\Object\Request($key);
        // echo __CLASS__;
    }

    public function setFile($filename)
    {
        $this->Request->setArgument($filename);
        return $this;
    }

    public function execute($cache=true)
    {
        // return $this->curl($this->Request, self::API_URL);
        if($cache) {
            // 케쉬 확인
            $path = "../../../../cache";
            if( !is_dir($path)) mkdir($path);

            $path .= DIRECTORY_SEPARATOR."Etri";
            if( !is_dir($path)) mkdir($path);

            $path .= DIRECTORY_SEPARATOR."Object";
            if( !is_dir($path)) mkdir($path);

            $hash = sha1($this->Request->argument["file"]);

            $path .= DIRECTORY_SEPARATOR.$hash[0].$hash[0];
            if( !is_dir($path)) mkdir($path);
             

            if(file_exists($path.DIRECTORY_SEPARATOR.$hash.".json")) {
                return file_get_contents($path.DIRECTORY_SEPARATOR.$hash.".json");
            } else {
                $result = $this->curl($this->Request, self::API_URL);
                file_put_contents($path.DIRECTORY_SEPARATOR.$hash.".json",$result);
                return $result;
            } 
        } else {
            // 비활성 캐쉬
            $result = $this->curl($this->Request, self::API_URL);
            file_put_contents($path.DIRECTORY_SEPARATOR.$hash.".json",$result);
            return $result;
        }
    }

    private function curl($request, $url)
    {
        try {
            $server_output = "";
            $ch = curl_init();
            $header = array(
                "Content-Type:application/json; charset=UTF-8",
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode ( $request) );
        
            $server_output = curl_exec($ch);
            
            if($server_output === false) {
                echo "Error Number:".curl_errno($ch)."\n";
                echo "Error String:".curl_error($ch)."\n";
            }            
        
            curl_close($ch);
        } catch ( Exception $e ) {
            echo $e->getMessage ();
        }
        
        return $server_output;
    }


}