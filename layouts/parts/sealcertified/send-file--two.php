<?php

use \MapasCulturais\i;


$app = MapasCulturais\App::i();
$file_two = $entity->getFiles('sealcertifiedtwo');
$url = $app->createUrl('seal', "upload", ["id" => $entity->id]);
$msg_delete = "Remover este arquivo?";
$btn_delete = "Excluir arquivo";
$template = '
<li id="file-{{id}}" class="widget-list-item">
    <a href="{{url}}" rel="noopener noreferrer">{{description}}</a> 
    <div class="botoes">
        <a href="' . $url . '?file={{id}}" class="btn btn-primary hltip js-validador-process" data-hltip-classes="hltip-ajuda" title="Clique para processar o arquivo enviado">processar</a>
        <a data-href="{{deleteUrl}}" data-target="#file-{{id}}" data-configm-message="' . $msg_delete . '" class="icon icon-close hltip js-remove-item" data-hltip-classes="hltip-ajuda" title="' . $btn_delete . '" rel="noopener noreferrer"></a>
    </div>
</li>';
?>
<p>Selecione a imagem de sua segunda assinatura (arquivo em .png):</p> <br>

        <img class="img-signature js-sealcertifiedtwo-img " src="<?= $file_two->url ?>" style="width: 200px !important;
    height: 60px !important;" />
        <div>
            <button class="btn btn-default add js-open-editbox hltip" data-target="#editbox-sealcertifiedtwo-file" href="#" title="Clique para adicionar e subir novo arquivo de validação de assinatura"> Carregar assinatura </button>
        </div>

        <div id="editbox-sealcertifiedtwo-file" class="js-editbox mc-left" title="Subir arquivo de assinatura" data-submit-label="<?= i::__("Enviar") ?>">
            <?php $this->ajaxUploader($entity, "sealcertifiedtwo", "image-src", "ul.js-sealcertifiedtwo img.js-sealcertifiedtwo-img", $template, "", false, false, false); ?>
        </div>
        <label> Escreva o nome da segunda assinatura: </label><br>
        <input name="name_sealcertifiedtwo" id="name_sealcertifiedtwo" type="text" class="signature-input" placeholder="Escreva o nome aqui" value="<?= $entity->name_sealcertifiedtwo ?? "" ?>" size="60" />
        <hr>
