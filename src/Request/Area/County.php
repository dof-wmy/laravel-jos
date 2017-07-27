<?php
namespace Wmy\Jos\Request\Area;

class County
{
    private $apiParas = [];
    public $parentId;
    public $data_key = 'jingdong_areas_county_get_responce.baseAreaServiceResponse.data';

    public function getApiMethodName(){
        return "jingdong.areas.county.get";
    }

    public function getApiParas(){
        return empty($this->apiParas) ? '{}' : json_encode($this->apiParas);
    }

    public function setParentId($parentId){
        $this->parentId = $parentId;
        $this->apiParas["parent_id"] = $parentId;
    }

    public function getParentId(){
        return $this->parentId;
    }
}