<?php
require PLUGINS_PATH.'SealCertified/vendor/autoload.php';
$plugin = $app->plugins['SealCertified'];


use Mpdf\Mpdf;


$mpdf = new Mpdf([
    'tempDir' => dirname(__DIR__) . '/SealCertified/vendor/mpdf/tmp',
    'mode' => 'utf-8',
    'format' => 'A4',
    'default_font' => 'arial']);
  
//$mpdf->showImageErrors = true;

    ob_start();

    $mpdf->SetTitle('Mapa da Saúde - Relatório');
    $stylesheet = file_get_contents(PLUGINS_PATH.'SealCertified/assets/css/seal-certified--styles.css');  
   
include "sealCertified.php";
$html = ob_get_clean();
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output();
exit;

?>
