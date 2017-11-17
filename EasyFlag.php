<?php
//example

// $flag=new EasyFlag(5);

// echo(json_encode($flag->zuhe(1)))."\n";
// echo(json_encode($flag->zuhe(2)))."\n";
// echo(json_encode($flag->zuhe(3)))."\n";
// echo(json_encode($flag->zuhe(4)))."\n";
// echo(json_encode($flag->zuhe(5)))."\n";
// echo(json_encode($flag->search([2])))."\n";
// echo(json_encode($flag->encode([1,2,4,8])))."\n";
// echo(json_encode($flag->decode(15)))."\n";


class EasyFlag{
    private $src=[],
    $flagMaxBits=32,
    $dataAll=[];
    /**
     * binary,bits count:1 1 0 1 1 0 1 1 1 0 1 1 1 
     * bits count equal to types count
     */
    function __construct($bits){
        if ($bits>$this->flagMaxBits){
            throw new Exception("bits count max 32");
        }
        for($i=1;$i<=$bits;$i++){
            $this->src[]=1<<$i-1;
        }
        for($i=1;$i<=count($this->src);$i++){
            $tmp=$this->zuhe($i);
            foreach($tmp as $v){
                $total=0;
                foreach($v as $vv){
                    $total|=$vv;
                }
                $this->dataAll[]=$total;
            }
        }
    }
    /**
     * __construct(4)
     * input:[1,2,4,8]
     * output:15
     */
    static function encode($arr){
        $total=0;
        foreach($arr as $v){
            $total|=$v;
        }
        return $total;
    }
        /**
     * __construct(4)
     * input:15
     * output:[1,2,4,8]
     */
    function decode($total){
        $all=[];
        for($i=0;$i<=$this->flagMaxBits;$i++){
            $v=1<<$i;
            if(($v&$total)==$v){
                $all[]=$v;
            }
        }
        return $all;
    }
    function search($search){
        $all=[];
        $searchTotal=0;
        foreach($search as $v){
            $searchTotal|=$v;
        }
        foreach($this->dataAll as $total){
            if(($searchTotal&$total)==$searchTotal){
                $all[]=$total;
            }
        }
        return $all;
    }
    /**
     * input:[1,2,4,8],2
     * output:[[2,1],[4,1],[8,1],[4,2],[8,2],[8,4]]
     */
     function zuhe($count){
        $t=$this->pailie($count);
        $data=[];
        $ret=[];
        foreach($t as $v){
            $item=[];
            foreach($v as $k=>$vv){
                $item[]=$k;
            }
            $data[]=$item;
        }
        foreach($data as  $m){
            $found=false;
            $t1=0;
            foreach($m as $vv){
                $t1|=$vv;
            }
            foreach($ret as $n){ 
                $t2=0;
                foreach($n as $vv){
                    $t2|=$vv;
                }
                if($t1==$t2){
                    $found=true;
                    break;
                }
            }
            if(!$found){
                $ret[]=$m;
            }
        }
        return $ret;
    }
    /**
     * input:[1,2,4],2
     * output:[{"2":0,"1":0},{"4":0,"1":0},{"8":0,"1":0},{"1":0,"2":0},{"4":0,"2":0},{"8":0,"2":0},{"1":0,"4":0},{"2":0,"4":0},{"8":0,"4":0},{"1":0,"8":0},{"2":0,"8":0},{"4":0,"8":0}]
     */
     private function pailie($count){
        static $src;
        if(empty($src)){
            foreach($this->src as $v){
                $src[$v]=0;
            }
        }
        $return=[];
        if($count==1){
            foreach($src as $m=>$v){
                $return[]=[$m=>0];
            }
            return $return;
        }
        foreach($src as $n=>$v){
            foreach($this->pailie($count-1) as $m){
                if(isset($m[$n])){
                    continue;
                }
                $m[$n]=0;
                $return[]=$m;
            }
        }
        return $return;
    }
}
