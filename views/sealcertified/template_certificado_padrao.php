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

<div class="text-left" style="margin-left: 80px; margin-right: 80px;">
    <p class="color-label-certified " style="margin-top: 50px;">
        <!--Mensagem principal -->
        <?php if (isset($message) && $message !== '') {
            echo $message ;            
        } ?>
    </p>
    <p  class="color-label-certified mrg-50-left mrg-50-right">
        <?php
            echo "<br/>";           
            echo 'Fortaleza, '.SealCertified::dateToExtensive();
        ?>
    </p>
</div>

    <!--Verifica se todas imagens de assinaturas estão vazias -->
<?php if (empty($img_signature1) && empty($img_signature2)) : ?>

<!--Verifica se apenas a imagem de assinatura 1 está vazia e exibe a imagem 2 -->
<?php elseif (empty($img_signature1) && !empty($img_signature2)) : ?>

    <div style="width: 100%; margin-top: 110px;" class="mrg-50-left mrg-50-right">

        <div class="assinatura-certified">

            <img src="<?php echo $relation->seal->getFiles('sealcertifiedtwo')->path;
                        ?>" width="50" height="50" class="imagem" /><br>
            <hr size="10" style="width: 50%;">
            <?php if ($relation->seal->name_sealcertifiedtwo !== '') {
                echo $relation->seal->name_sealcertifiedtwo;
            }
            ?>
        </div>
    </div>
<!--Verifica se apenas a imagem de assinatura 2 está vazia e exibe a imagem 1 -->
<?php elseif (!empty($img_signature1) && empty($img_signature2)) : ?>
    <div style="width: 100%;margin-top: 110px; " class="mrg-50-left mrg-50-right">

        <div class="assinatura-certified">
            <img src="<?php echo $relation->seal->getFiles('sealcertifiedone')->path;
                        ?>" width="50" height="50" class="imagem" /><br>
            <hr size="10" style="width: 50%;">
            <?php if ($relation->seal->name_sealcertifiedone !== '') {
                echo $relation->seal->name_sealcertifiedone;
            }
            ?>
        </div>
    </div>
<!--Exibe as duas assinaturas -->
<?php else : ?>
    <div style="margin-top: 110px;">
        <table style="width: 100%;" class="mrg-50-left mrg-50-right">
            <tr>
                <td></td>
                <td class="assinatura-certified">
                    <img src="<?php echo $relation->seal->getFiles('sealcertifiedone')->path;
                                ?>" class="imagem"  width="50" height="50" /> <br>
                    <hr size="10" style="width: 80%;">
                    <?php if ($relation->seal->name_sealcertifiedone !== '') {
                        echo $relation->seal->name_sealcertifiedone;
                    } ?>
                </td>
                <td></td>
                <td class="assinatura-certified">
                    <img src="<?php echo $relation->seal->getFiles('sealcertifiedtwo')->path;
                                ?>" width="50" height="50" class="imagem" /><br>
                    <hr size="10" style="width: 80%;">
                    <?php if ($relation->seal->name_sealcertifiedtwo !== '') {
                        echo $relation->seal->name_sealcertifiedtwo;
                    }
                    ?>
                </td>
                <td style="width: 5%;"></td>
            </tr>
        </table>
    </div>
<?php endif ?>
</div>
<div class="sealcertified-div-link">
    <p>
        Acesse o link para acessar o comprovante desta declaração:
        <label for="">
            <a href="<?php echo $app->createUrl('seal', 'printsealrelation', [$relation->id]); ?>" class="sealcertified-link">
                <?php echo $app->createUrl('seal', 'printsealrelation', [$relation->id]); ?>
            </a>
        </label>
    </p>          
    
</div>
<div class="sealcertified-accredited">
    <p>
    Credenciada para ministrar Cursos de Pós-Graduação Lato Sensu – Especialização, Parecer no 0454/2019, de 24/09/2019, expedido pela Câmara da Educação Superior e
     Profissional do Conselho Estadual de Educação do Ceará – CEE, de acordo com o Inciso IV, do Artigo 10, da Lei CNE/MEC no 9.394, de 20 de dezembro de 1996, que 
     Estabelece as Diretrizes e Bases da Educação Nacional.
    </p> 
</div>
