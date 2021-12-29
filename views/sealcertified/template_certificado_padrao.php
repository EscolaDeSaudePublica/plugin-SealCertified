<?php
require PLUGINS_PATH . 'SealCertified/Entities/SealCertified.php';
use SealCertified\Entities\SealCertified;

$this->layout = 'nolayout-pdf'; 
require PLUGINS_PATH.'SealCertified/vendor/autoload.php';
$plugin = $app->plugins['SealCertified'];
$style = $app->view->enqueueStyle('app', 'sealcertified', 'css/seal-certified--styles.css');

$relation = $app->view->relObject['relation'];
$message = $plugin->customCertificateText($relation);

 $this->part('sealcertified/headerOficial');

?>
<div class="container img-container">
    <div style="margin-top: 48px">
        <h4 class="color-label-certified-title">DECLARAÇÃO</h4>
    </div>
</div>

<div class="text-left" style="margin-left: 80px; margin-right: 80px;">
    <p class="color-label-certified " style="margin-top: 50px;">
        <!--Mensagem principal -->
        <?php if (isset($message) && $message !== '') {
            echo $message ;            
        } ?>
    </p>
    <p class="color-label-certified mrg-50-left mrg-50-right">
        <?php
            echo "<br/>";           
            echo 'Fortaleza, '.SealCertified::dateToExtensive();
        ?>
    </p>
</div>

<?php  $this->part('sealcertified/signature'); ?>

<div class="sealcertified-div-link">
    <p>
        Acesse o link para acessar o comprovante desta declaração:
        <label for="">
            <a href="<?php echo $app->createUrl('seal', 'printsealrelation', [$relation->id]); ?>"
                class="sealcertified-link">
                <?php echo $app->createUrl('seal', 'printsealrelation', [$relation->id]); ?>
            </a>
        </label>
    </p>

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