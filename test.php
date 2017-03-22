<?php
/**
 * Created by PhpStorm.
 * User: liududu
 * Date: 17-3-18
 * Time: 下午10:03
 */
/*require_once ('functions.php');
require_once ('tools.php');
$request = "cet4 430021162127726 刘都都";
$result = cet4($request);
//var_dump(fliter($request));
var_dump($result);*/



/*require_once ('Matrix.php');
$martix  = array(
    0 => array(1,1,1),
    1 => array(1,2,1),
    2 => array(31,32,33)
);

$m = new Matrix($martix);
//$t = $m->get(3,2);
//$c = $m->col;
//$z = $m->row;
//$m->addToRow(1,2);
//echo $c;
//echo $z;
//echo $t;
echo $m;*/


require_once ("functions.php");
require_once 'tools.php';
$request = "matrix
1 2 3
5 6 7
4 2 3";
echo fliter($request);
echo matrixCaculator($request);