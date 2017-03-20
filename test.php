<?php
/**
 * Created by PhpStorm.
 * User: liududu
 * Date: 17-3-18
 * Time: 下午10:03
 */
require_once ('functions.php');
require_once ('tools.php');
$request = "cet4 430021162127726 刘都都";
$result = cet4($request);
//var_dump(fliter($request));
var_dump($result);
