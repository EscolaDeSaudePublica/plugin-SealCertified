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
   
include "sealCertifiedOficial.php";

//$footer = '<img src="'.PLUGINS_PATH.'SealCertified/assets/img/sealcertified/rodape.png'.'" style="width: 795px;">';

$footer = '<img src="'.PLUGINS_PATH.'SealCertified/assets/img/sealcertified/rodapeOficial.png'.'" style="width: 795px;">';

$header = '<div style="border-top: 32px solid #4CAF50; width: 547px; left: 20%; margin-left: 15%"></div>';

$mpdf->SetHTMLFooter($footer);
$mpdf->SetHTMLFooter($footer, 'E');
$mpdf->writingHTMLfooter = true;

$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLHeader($header, 'E');
$mpdf->writingHTMLheader = true;
$mpdf->AddPage('', // L - landscape, P - portrait 
                '', '', '', '',
                0, // margin_left
                0, // margin right
                15, // margin top
                0, // margin bottom
                0, // margin header
                0
            ); // margin footer
$html = ob_get_clean();
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output();
exit;

?>
