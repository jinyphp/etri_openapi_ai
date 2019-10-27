<?php
/**
 * Etri OpenAI package
 * hojinlee(infohojin@naver.com)
 * https://github.com/jinyphp/etri_openapi_ai
 */
namespace Etri\OpenAi\ASR;

class Request
{
    public $access_key;
    public $argument=[];
    public function __construct($key)
    {
        $this->access_key = $key;
    }

    public function setArgument($code, $filename)
    {
        if(file_exists($filename)) {
            $audioContents = base64_encode( file_get_contents($filename) );

            $this->argument = array (
                "language_code" => $code,
                "audio" => $audioContents
            );
        } else {
            echo "파일이 존재하지 않습니다.";
            exit;
        }
        
        
    }
}