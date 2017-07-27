<?php
include('../vendor/autoload.php');

use Wmy\Jos\Client;
use Wmy\Jos\Request\Area\Province;
use Wmy\Jos\Request\Area\City;
use Wmy\Jos\Request\Area\County;
use Wmy\Jos\Request\Area\Town;

$client = new Client([
    'app_key'    => '',
    'app_secret' => ''
]);
//$province_data = $client->execute(new Province());
//dd($province_data);

//$req = new City();
//$req->setParentId(7);
//$city_data = $client->execute($req);
//dd($city_data);

//$req = new County();
//$req->setParentId(412);
//$county_data = $client->execute($req);
//dd($county_data);

//$req = new Town();
//$req->setParentId(416);
//$town_data = $client->execute($req);
//dd($town_data);
