<?php
// criptografando o id do layout
$cript = md5($idLayout);

?>
<div>
    <br>
    <a  id="btn-print-certificate" class="btn btn-default" title="Imprimir <?php echo $relation->seal->name; ?>"
        href="<?php echo $app->createUrl('sealCertified','gerarSelo',[$relation->id, 'layout/'.$cript]);?>"
        target="_blank">
        <i class="fa fa-print"></i> Imprimir Certificado
    </a>
</div>
