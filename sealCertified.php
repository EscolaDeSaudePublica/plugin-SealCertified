<?php
$plugin = $app->plugins['SealCertified'];
//$app->view->enqueueScript('app', 'sealcertified', '/js/seal-certified.js');

include 'layouts/parts/sealcertified/header.php';
?>

<div class="seal-relation-shortdescription mrg-50-left mrg-50-right">

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
    <p class="color-label-certified text-left  mrg-50-left mrg-50-right">
        <?php if (isset($msg) && $msg !== '') {
            echo $msg;
        } ?>
    </p>
</div>

<div style=" margin-top: 80px;">
    <table style="width: 100%;" class="mrg-50-left mrg-50-right">
        <tr>
            <td></td>
            <td class="assinatura-certified">
                <img src="<?php echo $relation->seal->getFiles('sealcertifiedone')->path; 
                            ?>" class="imagem"  width="50" height="50"/> <br>
                <hr size="10" width="80%">
                <?php if ($relation->seal->name_sealcertifiedone !== '') {
                    echo $relation->seal->name_sealcertifiedone;
                } ?>
            </td>
            <td></td>
            <td class="assinatura-certified">

                <img src="<?php echo $relation->seal->getFiles('sealcertifiedtwo')->path; 
                            ?>"  width="50" height="50" class="imagem" /><br>
                <hr size="10" width="80%">
                <?php if ($relation->seal->name_sealcertifiedtwo !== '') {
                    echo $relation->seal->name_sealcertifiedtwo;
                }

                ?>
            </td>
            <td style="width: 5%;"></td>
        </tr>
    </table>
</div>

<div style=" margin-top: 90px;">
    <table style="width: 100%;">
        <tr>
            <td class="td-format" >
               <span class="info-link-certified">
               Acesse o link abaixo para acessar o comprovante desta declaração:
               </span>
               <label for="">
                    <a href="<?php echo $app->createUrl('seal','printsealrelation',[$relation->id]); ?>" class="link-selo-cuidar-melhor">
                        <?php echo $app->createUrl('seal','printsealrelation',[$relation->id]); ?>
                    </a>    
               </label>
            </td>
            <td class="td-format" >

            </td>
            <td  class="td-format" >
                <p>
                    <span class="info-link-certified">
                    Escola de Saúde Pública do Ceará Paulo Marcelo Martins Rodrigues Av. Antônio Justa, 3161 - Meireles • CEP: 60.165-090 Fortaleza / CE • Fone: (85) 3101.1398
                    </span>
                </p>
            </td>
        </tr>
    </table>
</div>
</body>