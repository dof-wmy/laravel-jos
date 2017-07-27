<?php
namespace Wmy\Jos;
use Wmy\Curl;

class Client{
    public $serverUrl = "https://api.jd.com/routerjson";
    public $accessToken;
    public $connectTimeout = 0;
    public $readTimeout = 0;
    public $appKey;
    public $appSecret;
    public $version = "2.0";
    public $format = "json";
    private $charset_utf8 = "UTF-8";
    private $json_param_key = "360buy_param_json";

    public function __construct($config = [])
    {
        $this->appKey = array_get($config, 'app_key', env('WMY_JOS_APP_KEY'));
        $this->appSecret = array_get($config, 'app_secret', env('WMY_JOS_APP_SECRET'));
    }

    public function execute($request, $access_token = null)
    {
        $res = [];
        //组装系统参数
        $sysParams["v"] = $this->version;
        $sysParams["method"] = $request->getApiMethodName();
        $sysParams["app_key"] = $this->appKey;
        $sysParams["timestamp"] = full_date();
        if (null != $access_token)
        {
            $sysParams["access_token"] = $access_token;
        }
        //获取业务参数
        $apiParams = $request->getApiParas();
        $sysParams[$this->json_param_key] = $apiParams;
        //签名
        $sysParams["sign"] = $this->generateSign($sysParams);
        //系统参数放入GET请求串
        $requestUrl = $this->serverUrl . "?";
        foreach ($sysParams as $sysParamKey => $sysParamValue)
        {
            $requestUrl .= "{$sysParamKey}=" . urlencode($sysParamValue) . "&";
        }
        //发起HTTP请求
        $curl_res = Curl::execute($requestUrl, [
            'form_params' => $sysParams
        ]);

        if($curl_res['http_code'] == 200){
            if ("json" == $this->format){
                $res = json_decode($curl_res['body'], true);
            }
            else if("xml" == $this->format){
                $res = @simplexml_load_string($res);
            }
            else{
//
            }
        }
        return empty($request->data_key) ? $res : array_get($res, $request->data_key);
    }

    protected function generateSign($params)
    {
        ksort($params);
        $stringToBeSigned = $this->appSecret;
        foreach ($params as $k => $v)
        {
            if("@" != substr($v, 0, 1))
            {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $this->appSecret;
        return strtoupper(md5($stringToBeSigned));
    }

}