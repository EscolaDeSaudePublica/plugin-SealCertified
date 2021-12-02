<?php

use \MapasCulturais\i;


$app = MapasCulturais\App::i();
$file_one = $entity->getFiles('sealcertifiedone');
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
<hr>
<h1>Assinatura</h1>

<p>Adicione uma ou duas assinaturas ao selo, elas serão exibidas no certificado do inscrito.</p>

<div>
<p>Selecione a imagem de sua primeira assinatura (arquivo em .png):</p> <br>

<?php if($file_one !== null):
$verified_one = $file_one->url;
if(!empty($verified_one)): ?>
<img class="js-sealcertifiedone-img" src="<?= $file_one->url ?>"  style="width: 200px !important; height: 60px !important;" /><br>
<?php endif; ?>
<?php endif; ?>
    <button class="btn btn-default add js-open-editbox hltip" data-target="#editbox-sealcertifiedone-file" href="#" title="Clique para adicionar e subir novo arquivo de validação de assinatura"> Carregar assinatura </button>
</div>

<div id="editbox-sealcertifiedone-file" class="js-editbox mc-left" title="Subir arquivo de assinatura" data-submit-label="<?= i::__("Enviar") ?>">
    <?php $this->ajaxUploader($entity, "sealcertifiedone", "image-src", "ul.js-sealcertifiedone img.js-sealcertifiedone-img", $template, "", false, false, false); ?>
</div>
<label> Escreva o nome da primeira assinatura: </label><br>
<input name="name_sealcertifiedone" id="name_sealcertifiedone" type="text" class="signature-input" placeholder="Escreva o nome aqui" size="60" value="<?= $entity->name_sealcertifiedone ?? "" ?>" /> <br>

 <button class="remove-signature btn btn-danger"><?php i::_e('remover assinatura') ?></button>
<hr>
</div>