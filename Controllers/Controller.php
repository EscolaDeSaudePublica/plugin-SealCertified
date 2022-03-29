<?php
namespace SealCertified\Controllers;

require PLUGINS_PATH.'PDFReport/vendor/autoload.php';
require PLUGINS_PATH.'PDFReport/vendor/dompdf/dompdf/src/FontMetrics.php';

use MapasCulturais\App;
use Mpdf\Mpdf;


class Controller extends \MapasCulturais\Controller
{
    function GET_gerarSelo() {

        $app = App::i();

        $data = $this->data;

        $idLayout = $data[1];

        $relation = $app->repo('SealRelation')->find($this->data['id']);

        $term = $app->repo('Term')->findBy([
            'taxonomy' => 'seal_layout'
        ]);

        $layout = 'template_certificado_padrao';

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

        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";

        $url .= $_SERVER['HTTP_HOST'].''.$_SERVER['REQUEST_URI'];

        $mpdf = new Mpdf($confMpdf);
        
        $app->view->relObject = new \ArrayObject;
        $app->view->relObject['relation'] = $relation;
        $app->view->relObject['url'] = $url;

        $stylesheet = file_get_contents(PLUGINS_PATH.'SealCertified/assets/css/seal-certified--styles.css');

        $footer = '
        <div class="sealcertified-div-link">
            <p>Acesse o link do comprovante desta declaração: <a href='.$url.' class="sealcertified-link">'.$url.'</a></p>
        </div>
        <div class="sealcertified-accredited">
            <p>
                Credenciada para ministrar Cursos de Pós-Graduação Lato Sensu – Especialização, Parecer no 0454/2019, de
                24/09/2019, expedido pela Câmara da Educação Superior e
                Profissional do Conselho Estadual de Educação do Ceará – CEE, de acordo com o Inciso IV, do Artigo 10, da Lei
                CNE/MEC no 9.394, de 20 de dezembro de 1996, que
                Estabelece as Diretrizes e Bases da Educação Nacional.
            </p>
        </div>
        <img src="'.PLUGINS_PATH.'SealCertified/assets/img/sealcertified/rodape.png'.'" style="width: 795px; heigh: 63px">';

        $content = $app->view->fetch($confMpdf['template']);

        $mpdf->writingHTMLfooter = true;
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->SetTitle('Mapa da Saúde - Relatório');

        $mpdf->AddPage(
            '', // L - landscape, P - portrait 
            '',
            '',
            '',
            '',
            5, // margin_left
            5, // margin right
            10, // margin top
            20, // margin bottom
            0, // margin header
            3
        ); // margin footer
        
        $mpdf->SetHTMLFooter($footer);
        $mpdf->SetHTMLFooter($footer, 'E');
        $mpdf->WriteHTML($stylesheet,1);
        $mpdf->WriteHTML($content, 2);

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