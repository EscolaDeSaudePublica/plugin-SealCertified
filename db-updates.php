<?php
$app = MapasCulturais\App::i();
$em = $app->em;
$conn = $em->getConnection();

return array(
    'template certificados' => function () use($conn){
        $conn->executeQuery("INSERT INTO public.term (taxonomy, term, description) VALUES('seal_layout', 'template_certificado_padrao' , 'Certificado padrão da ESP');");
        $conn->executeQuery("INSERT INTO public.term (taxonomy, term, description) VALUES('seal_layout', 'template_declaracao_cuidar_melhor' , 'Certificado padrão do Cuidar Melhor');");
    }
);