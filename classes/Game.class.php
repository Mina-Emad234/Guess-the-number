<?php

namespace Classes;

class Game{
    
    public function guess(){
        $nums=[0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        return implode(array_unique(array_rand($nums,5)));
    }

    public function getResult($secret, $guess){
    
        if(!isset($_SESSION['results'])){
            $_SESSION['results'] = [];
        }
        $secretArr = array_map('intval', str_split($secret));
        count($secretArr)!==5? array_unshift($secretArr,0): $secretArr;
        $guessArr = array_map('intval', str_split($guess));
        
        if (count($guessArr) !== 5 || count(array_unique($guessArr)) != count($guessArr)) return;
        

        foreach ($_SESSION['results'] as $value) {
           if($value['guess']==$guess || $value['result']['asterisks'] === '*****'){
                return;
           }
        }

        $asterisks=0;
        $dots=0;
        foreach ($secretArr as $key => $value ){
            foreach ($guessArr as $gkey => $gvalue){
                if ($key===$gkey&&$value===$gvalue){
                    $asterisks++;
                }elseif ($key!==$gkey&&$value===$gvalue){
                    $dots++;
                }
            }
        }

      
      
        $_SESSION['results'][] = ['guess'=>$guess,'result'=>['asterisks'=>str_repeat('*',$asterisks),'dots'=>str_repeat('.',$dots)]];
       
    }
}