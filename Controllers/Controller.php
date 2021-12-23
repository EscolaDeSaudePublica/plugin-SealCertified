<?php
namespace SealCertified\Controllers;

require PLUGINS_PATH.'PDFReport/vendor/autoload.php';
require PLUGINS_PATH.'PDFReport/vendor/dompdf/dompdf/src/FontMetrics.php';

use MapasCulturais\App;
use Mpdf\Mpdf;


class Controller extends \MapasCulturais\Controller
{

    function GET_gerarSelo() {
        ini_set('display_errors' , true);
        $data = $this->data;
        $app = App::i();
        $idLayout = $data[1];
        $relation = $app->repo('SealRelation')->find($this->data['id']);
      
        $term = $app->repo('Term')->findBy([
            'taxonomy' => 'seal_layout'
        ]);
        $id = 0;
        $layout = '';
        foreach ($term as $terms) {
            if($idLayout == md5($terms->id) ){
                $id = $terms->id;
                $layout = $terms->term;
            }
        }

        $confMpdf = [
            'regs' => '',
            'title' => '',
            'template' => 'sealcertified/'.$layout,
            'claimDisabled' => null,
            'pluginConf' => ['tempDir' => dirname(__DIR__) . '/vendor/mpdf/mpdf/tmp','mode' => 'utf-8',
            'format' => 'A4',
            'pagenumPrefix' => 'Página ',
            'pagenumSuffix' => '  ',
            'nbpgPrefix' => ' de ',
            'nbpgSuffix' => ''
            ]
        ];
       
        $mpdf = new Mpdf($confMpdf);
        ob_start();
         //INSTANCIA DO TIPO ARRAY OBJETO
         $app->view->relObject = new \ArrayObject;
         $app->view->relObject['relation'] = $relation;

        $content = $app->view->fetch($confMpdf['template']);

        $stylesheet = file_get_contents(PLUGINS_PATH.'SealCertified/assets/css/seal-certified--styles.css');
        $mpdf->AddPage('', // L - landscape, P - portrait 
                '', '', '', '',
                5, // margin_left
                5, // margin right
                0, // margin top
                20, // margin bottom
                0, // margin header
                3
            ); // margin footer
        $mpdf->WriteHTML(ob_get_clean());
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($content,2);
        $file_name = 'Ficha_de_inscricao.pdf';
        $mpdf->Output();
        exit;
    }

    //Método para renderizar o template
    public function renderTemplate($file_dir, $file_name){
        $app = App::i();
        $_file_name = $app->view->resolveFilename($file_dir, $file_name);        
        return file_get_contents($_file_name);
    }

}