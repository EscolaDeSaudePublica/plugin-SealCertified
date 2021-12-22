<?php
$cript = md5(557);
?>
<a  id="btn-print-certificate" class="btn btn-default" 

    href="<?php echo $app->createUrl('pdf','gerarSelo',[$relation->id, 'layout/'.$cript]);?>"
    target="_blank">
    <i class="fa fa-print"></i> Imprimir Certificado
</a>
