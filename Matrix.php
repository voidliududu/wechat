<?php

/**
 * Created by PhpStorm.
 * User: liududu
 * Date: 17-3-18
 * Time: 下午10:30
 */
class Matrix
{
    private $rawMatrix;
    private $matrix;
    private $uptriMartrix;   //the up triangle matrix
    public $row;             //define the number of row
    public $col;            //define the number of column
    private $attr = [];
    public function __construct(array $arr)
    {
        $this->rawMatrix = $this->matrix = $arr;
        $this->row = count($arr);
        $this->col = count($arr[0]);
        $this->attr['det'] = $this->det();
        $this->uptriMartrix = $this->touptriMatrix();
    }
    /*
     *TODO consider to extend a param to refer to the specific matrix
     *
     * to get the value of elements
     * */

    public function get($x,$y)
    {
        if($x <= $this->col and $y <= $this->row) {
            return $this->matrix[$x - 1][$y - 1];
        }else{
            return null;
        }
    }
    //to set the value of the elements
    public function set($x,$y,$value){
        if($x <= $this->col and $y <= $this->row) {
            $this->matrix[$x - 1][$y - 1] = $value;
        }else{
            return null;
        }
    }
    //to exchange two row
    public function changeCol($i,$j)
    {
        if($i < $this->row and $j < $this->row){
            for($m = 1;$m <= $this->col;$m++){
                $temp = $this->get($i,$m);
                $this->set($i,$m,$this->get($j,$m));
                $this->set($j,$m,$temp);
            }
        }else{
            return null;
        }
    }
    /*
     * @param $i $j the column you want to exchange
     * to exchange two column
    */
    public function changeRow($i,$j)
    {
        if($i < $this->col and $j < $this->col){
            for($m = 1;$m <= $this->col;$m++){
                $temp = $this->get($m,$i);
                $this->set($m,$i,$this->get($m,$j));
                $this->set($m,$j,$temp);
            }
        }else{
            return null;
        }
    }
    /*
     * @param $i the row you want to multiply
     * @param $n the factor you want to multiply
     *
     * */
    public function multiplyRow($i,$n)
    {
        for($s = 1;$s <= $this->col;$s++){
            $this->set($i,$s,$this->get($i,$s)*$n);
        }
    }
    public function multiplyCol($i,$n)
    {
        for($s = 1;$s <= $this->row;$s++){
            $this->set($s,$i,$this->get($s,$i)*$n);
        }
    }
    /*
     * @param $i the raw row
     * @param $j the target row
     * @param $k the factor of the raw row
     * */
    public function addToRow($i,$j,$k = 1)
    {
        for($s = 1;$s <= $this->col;$s++){
            $this->set($j,$s,$this->get($j,$s) + $this->get($i,$s)*$k);
        }
    }
    public function addToCol($i,$j,$k = 1)
    {
        for($s = 1;$s <= $this->row;$s++){
            $this->set($s,$j,$this->get($s,$i)*$k);
        }
    }

    /*
     * change the matrix to up triangle matrix
     * @return $matrix
     * */
    public function touptriMatrix()
    {
        $r = $this->row;
        $c = $this->col;
        for($i = 1;$i <= $c;$i++){                       //$i is the col index
            if($this->get($i,$i) == 0){
                for($t = $i+1;$t <= $r;$t++){
                    if($this->get($t,$i) != 0){
                        $this->changeRow($i,$t);
                    }
                }
            }
            if($this->get($i,$i) == 0){
                continue;
            }
            for($j = $i+1;$j <= $r;$j++){                 //$j is the row index
                $k = -$this->get($j,$i)/$this->get($i,$i);
                $this->addToRow($i,$j,$k);
            }
        }
        return $this->matrix;
    }
    /*
     * to get the det of a square matrix
     * */
    public function det()
    {
        if($this->col == $this->row){
            $t = 1;
            for($i = 0;$i <= $this->row;$i++){
                  $t *= $this->get($i,$i);
            }
            return $t;
        }
        else{
            return false;
        }
    }

    public function __toString()
    {
        $str = [];
        foreach($this->matrix as $key => $value){
            $str[] = implode(" ",$value);
        }
        $string = implode("\n",$str);
        return $string;
    }
}