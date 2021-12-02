<?php
$plugin = $app->plugins['SealCertified'];
//$app->view->enqueueScript('app', 'sealcertified', '/js/seal-certified.js');

include 'layouts/parts/sealcertified/header.php';
?>

<div class="seal-relation-shortdescription">

    <p>
        <?php echo $relation->seal->shortDescription; ?>
    </p>

</div>

<div class="container img-container">
    <div>
        <h4 class="color-label-certified-title">DECLARAÇÃO</h4>
    </div>
    <div class="seal-certifiedclass">
        <span class="">
            <!-- Inline parent element -->
            <img src="<?php echo PLUGINS_PATH . 'SealCertified/assets/img/sealcertified/cil_badge.png'; ?>" alt="">
        </span>
    </div>
</div>

<div>
    <p class="color-label-certified text-left">
        <?php if (isset($msg) && $msg !== '') {
            echo $msg;
        } ?>
    </p>
</div>

<div style=" margin-top: 80px;">
    <table style="width: 100%;">
        <tr>
            <td></td>
            <td class="assinatura-certified">
                <img src="<?php echo PLUGINS_PATH.'SealCertified/assets/img/sealcertified/assinatura.png'; ?>" alt="">
                <hr size="10" width="80%">
                <?php if ($relation->seal->name_sealcertifiedone!== ''){
                echo $relation->seal->name_sealcertifiedone; 
                }?>
            </td>
            <td></td>
            <td class="assinatura-certified">
               
                <img src="<?php echo PLUGINS_PATH.'SealCertified/assets/img/sealcertified/assinatura.png'; ?>" alt="">
                <hr size="10" width="80%">
                <?php if ($relation->seal->name_sealcertifiedtwo !== ''){
                echo $relation->seal->name_sealcertifiedtwo; 
                }
                
                ?>
            </td>
            <td  style="width: 5%;"></td>
        </tr>
    </table>
</div>
<?php
include 'layouts/parts/sealcertified/footer.php';
?>
<div class="holder">
    <img src=" <?php echo $relation->seal->getFiles('sealcertifiedone')->url; 
                ?>" style="width: 200px !important;
    height: 60px !important;" class="imagem" /> <br>
    <hr size="10" width="20%">
    <?php echo $relation->seal->name_sealcertifiedone; 
    ?><br>
    <img src=" <?php echo $relation->seal->getFiles('sealcertifiedtwo')->url; 
                ?>" style="width: 200px !important;
    height: 60px !important;" class="imagem" /><br>
    <hr size="10" width="20%">
    <?php echo $relation->seal->name_sealcertifiedtwo; 

    echo $relation->seal->getFiles('sealcertifiedtwo')->url; 
    ?>
