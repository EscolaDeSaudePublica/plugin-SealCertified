<?php
require PLUGINS_PATH . 'SealCertified/Entities/SealCertified.php';
use SealCertified\Entities\SealCertified;

$this->layout = 'nolayout-pdf'; 
require PLUGINS_PATH.'SealCertified/vendor/autoload.php';
$plugin = $app->plugins['SealCertified'];
$style = $app->view->enqueueStyle('app', 'sealcertified', 'css/seal-certified--styles.css');

$relation = $app->view->relObject['relation'];
$message = $plugin->customCertificateText($relation);
//Verificações da existencia de file para pegar o caminho. 
$file_one = $relation->seal->getFiles('sealcertifiedone');
if ($file_one !== null) :
    $img_signature1 = $file_one->path;
endif;

$file_two = $relation->seal->getFiles('sealcertifiedtwo');
if ($file_two !== null) :
    $img_signature2 = $file_two->path;
endif;
 $this->part('sealcertified/headerOficial');

?>
<div class="container img-container">
    <div style="margin-top: 48px">
        <h4 class="color-label-certified-title">DECLARAÇÃO</h4>
    </div>
</div>
<div>
    <p class="color-label-certified text-left  mrg-50-left mrg-50-right" style="margin-top: 105px;">
        <!--Mensagem principal -->
        <?php if (isset($message) && $message !== '') {
            echo $message ;
            
        } ?>
    </p>
    <p  class="color-label-certified text-left  mrg-50-left mrg-50-right">
        <?php
            echo "<br/>";           
            echo 'Fortaleza. '.SealCertified::dateToExtensive();
        ?>
    </p>
</div>