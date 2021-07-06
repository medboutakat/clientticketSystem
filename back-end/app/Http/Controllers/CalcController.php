<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;



class CalcController extends Controller
{ 
    private function int2str11($a)
    { 
    
       $arrayString=  explode(".",$a );

       $verg=$this->int2str($arrayString[0]);
       $second=$this->int2str($arrayString[1]);
       
       echo   $verg.' dirhams et '. $second ;
    }
    private function int2string1($a)
    {  
       $arrayString=explode(".",$a ); 
       return $this->int2str($arrayString[0]); 
    }
    private function int2str($a)
    {
        if ($a < 0) {
            return 'moins ' . $this->int2str(-$a);
        }

        if ($a < 17) {
            switch ($a) {
                case 0:return '';
                case 1:return 'un';
                case 2:return 'deux';
                case 3:return 'trois';
                case 4:return 'quatre';
                case 5:return 'cinq';
                case 6:return 'six';
                case 7:return 'sept';
                case 8:return 'huit';
                case 9:return 'neuf';
                case 10:return 'dix';
                case 11:return 'onze';
                case 12:return 'douze';
                case 13:return 'treize';
                case 14:return 'quatorze';
                case 15:return 'quinze';
                case 16:return 'seize';
            }
        } else if ($a < 20) {
            return 'dix-' .  $this->int2str($a - 10);
        } else if ($a < 100) {
            if ($a % 10 == 0) {
                switch ($a) {
                    case 20:return 'vingt';
                    case 30:return 'trente';
                    case 40:return 'quarante';
                    case 50:return 'cinquante';
                    case 60:return 'soixante';
                    case 70:return 'soixante-dix';
                    case 80:return 'quatre-vingt';
                    case 90:return 'quatre-vingt-dix';
                }
            } else if ($a < 70) {
                return  $this->int2str($a - $a % 10) . ' ' .  $this->int2str($a % 10);
            } else if ($a < 80) {
                return  $this->int2str(60) . ' ' .  $this->int2str($a % 20);
            } else {
                return  $this->int2str(80) . ' ' .  $this->int2str($a % 20);
            }
        } else if ($a == 100) {
            return 'cent';
        } else if ($a < 200) {
            return  $this->int2str(100) . ' ' .  $this->int2str($a % 100);
        } else if ($a < 1000) {
            return  $this->int2str((int) ($a / 100)) . ' ' .  $this->int2str(100) . ' ' .  $this->int2str($a % 100);
        } else if ($a == 1000) {
            return 'mille';
        } else if ($a < 2000) {
            return  $this->int2str(1000) . ' ' .  $this->int2str($a % 1000) . ' ';
        } else if ($a < 1000000) {
            return $this->int2str((int) ($a / 1000)) . ' ' .  $this->int2str(1000) . ' ' .  $this->int2str($a % 1000);
        }
        //on pourrait pousser pour aller plus loin, mais c'est sans interret pour ce projet, et pas interessant, c'est pacybers non plus compliqué...
    } 

    public function toLetter($value){ 
   
       return response()->json($this->int2str($value), 201);
    }
    public function toLetter2($value){ 

       return response()->json($this->int2string1($value), 201);
    }
}
 