<?php
/**
 * Etri OpenAI package
 * hojinlee(infohojin@naver.com)
 * https://github.com/jinyphp/etri_openapi_ai
 */
namespace Etri\OpenAi\Object;

class Request
{
    public $access_key;
    public $argument=[];
    public function __construct($key)
    {
        $this->access_key = $key;
    } 

    // 전달 인수 설정
    public function setArgument($filename)
    {
        if(file_exists($filename)) {
            $imageContents = base64_encode( file_get_contents($filename) );
            $type = pathinfo($filename, PATHINFO_EXTENSION);
            $this->argument = array (
                "type" => $type,
                "file" => $imageContents
            );
        } else {
            echo "파일이 존재하지 않습니다.";
            exit;
        }
    }

    /**
     * 
     */
}