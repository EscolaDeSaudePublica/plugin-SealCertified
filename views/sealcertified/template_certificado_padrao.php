<?php
require PLUGINS_PATH . 'SealCertified/Entities/SealCertified.php';
use SealCertified\Entities\SealCertified;

$this->layout = 'nolayout-pdf'; 
require PLUGINS_PATH.'PDFReport/vendor/autoload.php';
$plugin = $app->plugins['SealCertified'];
$style = $app->view->enqueueStyle('app', 'sealcertified', 'css/seal-certified--styles.css');

$relation = $app->view->relObject['relation'];
$message = $plugin->customCertificateText($relation);

$this->part('sealcertified/headerOficial');
// URL DE LINK DE VALIDAÇÃO - MESMA URL
$url = $app->view->relObject['url'];
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
    <p class="color-label-certified">
        <?php
            echo "<br/>";           
            echo 'Fortaleza, '.SealCertified::dateToExtensive().'.';
        ?>
    </p>
</div>

<?php  $this->part('sealcertified/signature'); ?>
