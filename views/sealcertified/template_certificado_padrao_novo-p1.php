<?php
require PLUGINS_PATH . 'SealCertified/Entities/SealCertified.php';
use SealCertified\Entities\SealCertified;

$this->layout = 'nolayout-pdf'; 
require PLUGINS_PATH.'PDFReport/vendor/autoload.php';
$plugin = $app->plugins['SealCertified'];

$relation = $app->view->relObject['relation'];
$message = $plugin->customCertificateText($relation);
?>
<div>
    <img src="<?php echo PLUGINS_PATH . 'SealCertified/assets/img/sealcertified/retangule_top.png'; ?>" class="sealcertified-img-green" />
    <img src="<?php echo PLUGINS_PATH . 'SealCertified/assets/img/sealcertified/img-header.png'; ?>" class="img-header"/>
</div>

<div class="container img-container">
    <div>
        <h4 class="certified-title">CERTIFICADO</h4>
    </div>
</div>

<div class="mensagem">
    <p class="color-label-certified">
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

<table class="table-assinatura">
    <tr>
        <td class="assinatura-certified">
            <?php if (file_exists($relation->seal->getFiles('sealcertifiedone')->path)): ?>
                <img src="<?php echo $relation->seal->getFiles('sealcertifiedone')->path;?>" width="80" height="80" /><br>
            <?php endif ?>
            <?php if ($relation->seal->name_sealcertifiedone !== '') : ?>
                <?php echo nl2br($relation->seal->name_sealcertifiedone); ?>
            <?php endif ?>
        </td>
        <td class="assinatura-certified">
            <?php if (file_exists($relation->seal->getFiles('sealcertifiedtwo')->path)): ?>
                <img src="<?php echo $relation->seal->getFiles('sealcertifiedtwo')->path; ?>" width="80" height="80" /><br>
            <?php endif ?>
            <?php if ($relation->seal->name_sealcertifiedtwo !== '') : ?>
                <?php echo nl2br($relation->seal->name_sealcertifiedtwo); ?>
            <?php endif ?>
        </td>
    </tr>
</table>
