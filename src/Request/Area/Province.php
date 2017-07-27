<?php
namespace Wmy\Jos\Request\Area;

class Province
{
    private $apiParas = [];
    public $data_key = 'jingdong_areas_province_get_responce.baseAreaServiceResponse.data';

    public function getApiMethodName(){
        return "jingdong.areas.province.get";
    }

    public function getApiParas(){
        return empty($this->apiParas) ? '{}' : json_encode($this->apiParas);
    }

}