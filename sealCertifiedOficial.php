<?php
$plugin = $app->plugins['SealCertified'];

include 'layouts/parts/sealcertified/headerOficial.php';

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
<!--Descrição curta -->

<div class="container img-container">
    <div>
        <h4 class="color-label-certified-title">DECLARAÇÃO</h4>
    </div>
</div>

<div>
    <p class="color-label-certified text-left  mrg-50-left mrg-50-right">
        <!--Mensagem principal -->
        <?php if (isset($msg) && $msg !== '') {
            echo $msg;
        } ?>
    </p>
</div>

<!--Verifica se todas imagens de assinaturas estão vazias -->
<?php if (empty($img_signature1) && empty($img_signature2)) : ?>

<!--Verifica se apenas a imagem de assinatura 1 está vazia e exibe a imagem 2 -->
<?php elseif (empty($img_signature1) && !empty($img_signature2)) : ?>

    <div style="width: 100%; margin-top: 10%;" class="mrg-50-left mrg-50-right">

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
    <div style="width: 100%; margin-top: 10%;" class="mrg-50-left mrg-50-right">

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
    <div>
        <table style="width: 100%; margin-top: 15%;" class="mrg-50-left mrg-50-right">
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
<div style="position: fixed; bottom:3cm;">
                <p style="text-align: center; font-size: 10px">
                    Acesse o link para acessar o comprovante desta declaração:
                <label for="">
                    <a href="<?php echo $app->createUrl('seal', 'printsealrelation', [$relation->id]); ?>" class="link-selo-cuidar-melhor">
                        <?php echo $app->createUrl('seal', 'printsealrelation', [$relation->id]); ?>
                    </a>
                </label>
                </p>
           
</div>

<div style="position: fixed; bottom:2cm;">
                <p style="text-align: center; font-size: 8px">
                    <span class="">
                    Credenciada para ministrar Cursos de Pós-Graduação Lato Sensu – Especialização, Parecer no 0454/2019, de 24/09/2019, expedido pela Câmara da Educação Superior e Profissional do Conselho Estadual de Educação do Ceará – CEE, de acordo com o Inciso IV, do Artigo 10, da Lei CNE/MEC no 9.394, de 20 de dezembro de 1996,
                    </span>
                </p>
</div>
</body>