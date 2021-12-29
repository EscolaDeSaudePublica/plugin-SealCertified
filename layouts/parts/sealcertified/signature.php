<?php
$relation = $app->view->relObject['relation'];

//Verificações da existencia de file para pegar o caminho. 
$file_one = $relation->seal->getFiles('sealcertifiedone');
if ($file_one !== null) :
    $img_signature1 = $file_one->path;
endif;

$file_two = $relation->seal->getFiles('sealcertifiedtwo');
if ($file_two !== null) :
    $img_signature2 = $file_two->path;
endif;
?>

<div>
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
                                ?>" class="imagem" width="50" height="50" /> <br>
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