<?php
    function filtraVector($arrayOrigin, $max, $min) {
        $indice = 0;
        $arrayFinal = [];
        while($indice<count($arrayOrigin) ){
            if ($arrayOrigin[$indice] <= $max 
                            && $arrayOrigin[$indice] >= $min ){
                $arrayFinal[]=$arrayOrigin[$indice];
            }
            $indice++;
        } 
        return $arrayFinal;
    }
            
     function printArray ($arrayFinal){
         foreach ($arrayFinal as $value) {
             echo "$value";
         }
     }       
?>
