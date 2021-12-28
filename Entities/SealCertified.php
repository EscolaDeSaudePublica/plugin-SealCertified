<?php
namespace SealCertified\Entities;

use DateTime;
use MapasCulturais\App;
use Doctrine\ORM\Mapping as ORM;


class SealCertified extends \MapasCulturais\Entity{

    public static function dateToExtensive() {

        $data = date('D');
        $mes = date('M');
        $dia = date('d');
        $ano = date('Y');
     
        $semana = array(
            'Sun' => 'Domingo',
            'Mon' => 'Segunda-Feira',
            'Tue' => 'Terca-Feira',
            'Wed' => 'Quarta-Feira',
            'Thu' => 'Quinta-Feira',
            'Fri' => 'Sexta-Feira',
            'Sat' => 'Sábado'
        );
     
        $mes_extenso = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Marco',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        );
    
     $data= "{$dia} de " . $mes_extenso["$mes"] . " de {$ano}";
    
     return $data;	
        
    }

}