<?php
// criptografando o id do layout
$cript = md5($idLayout);
?>
<a  id="btn-print-certificate" class="btn btn-default" 
    href="<?php echo $app->createUrl('sealCertified','gerarSelo',[$relation->id, 'layout/'.$cript]);?>"
    target="_blank">
    <i class="fa fa-print"></i> Imprimir Certificado
</a>
