<?php

/**
 * Created by PhpStorm.
 * User: liududu
 * Date: 17-3-18
 * Time: 下午10:30
 */
class Matrix
{
    private $matrix;
    private $row;     //define the number of row
    private $col;     //define the number of column
    public function __construct(array $arr)
    {
        $this->matrix = $arr;
        $this->col = count($arr);
        $this->row = count($arr[0]);
    }
    //to get the value of the element
    private function get($x,$y)
    {
        if($x < $this->col and $y < $this->row) {
            return $this->matrix[$y + 1][$x + 1];
        }else{
            return null;
        }
    }
    //to set the value of the elements
    private function set($x,$y,$value){
        if($x < $this->col and $y < $this->row) {
            $this->matrix[$y + 1][$x + 1] = $value;
        }else{
            return null;
        }
    }
    //to exchange two row
    private function changeRow($i,$j)
    {
        if($i < $this->row and $j < $this->row){
            for($m = 1;$m <= $this->col;$m++){
                $temp = $this->matrix[$i][$m];
                $this->matrix[$i][$m] = $this->matrix[$j][$m];
                $this->matrix[$j][$m] = $temp;
            }
        }else{
            return null;
        }
    }
    //to exchange two column
    private function changeCol($i,$j)
    {
        if($i < $this->col and $j < $this->col){
            for($m = 1;$m <= $this->col;$m++){
                $temp = $this->matrix[$m][$i];
                $this->matrix[$m][$i] = $this->matrix[$m][$j];
                $this->matrix[$m][$j] = $temp;
            }
        }else{
            return null;
        }
    }
}