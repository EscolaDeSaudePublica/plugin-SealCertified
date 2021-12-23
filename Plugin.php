<?php

namespace SealCertified;

use MapasCulturais\Entities\SealMeta;
use \MapasCulturais\App;
use \MapasCulturais\Definitions\FileGroup;


class Plugin extends \SealModelTab\SealModelTemplatePlugin
{

    function __construct($config = [])
    {
        $config += [
            'logo-site' => 'img/logo-saude.png',
            'ids_enabled_seal' => [
                7
            ]
        ];
        parent::__construct($config);
    }

    function getModelData()
    {
        return [
            'label' => 'Declaração ESP',
            'name' => 'SealCertified',
            'css' => 'seal-certified--styles.css',
            'js' => 'seal-certified.js',
            'background' => 'meu-certificado--bg.jpg',
            'preview' => 'sealcertified/seal-certified--preview.jpg'
        ];
    }

    public function _init()
    {
        
        parent::_init();


        $app = App::i();
        $data = $this->getModelData();
        $plugin = $this;
        $plugin->enqueueAssets();


        $app->hook('sealRelation.certificateText', function(&$message, $sealRelation) use($plugin){

            $message = $plugin->customCertificateText($sealRelation);
            
        });

        $app->hook('POST(seal.saveSignatureNames)', function() use($app, $plugin){
            App::i()->log->debug(json_encode($this->data));
            
            if (
                $app->isEnabled('seals') &&
                !$app->user->is('guest') &&
                ($app->user->is('superAdmin') ||
                    $app->user->is('admin') ||
                    $app->user->profile->id == $this->requestedEntity->owner->id)
            ){
        

            $seal = $app->repo('Seal')->find(['id'=>$this->data['id']]);

            if(isset($this->data["signature_one"])){
                $seal->name_sealcertifiedone = $this->data['signature_one'];
            }else{

                $seal->name_sealcertifiedone = null;

                $file_one = $this->requestedEntity->getFile('sealcertifiedone');

                if(!empty($file_one)){

                    $file_one->delete(true);

                }
            }
           
            if(isset($this->data["signature_two"])){
                $seal->name_sealcertifiedtwo = $this->data['signature_two'];
            }else{

                $seal->name_sealcertifiedtwo = null;

                $file_two = $this->requestedEntity->getFile('sealcertifiedtwo');


                if(!empty($file_two)){

                    $file_two->delete(true);
            
                }
            }

            $seal->save(true);
            }
            
        });
        

        $app->hook('template(seal.sealrelation.print-certificate):after', function ($relation) use ($app, $data) {
            
            //Adicionando arquivos de estilo
            $app->view->enqueueStyle('app', $data['name'], 'css/' . $data['css']);
            // CONSULTANDO O LAYOUT EM SEAL_META    
            $sealMeta = $app->repo('SealMeta')->findOneBy([
                'key'   => 'seal_layout',
                'owner' =>  $this->data['seal']->id
            ]);
            // LAYOUT PADRAO
            $idLayout = 0;
            // SE TIVER ALGUM RETORNO CONSULTA QUAL O LAYOUT PELO ID
            if(!is_null($sealMeta)){
                $idLayout = $sealMeta->value;
            }
            if (
                $app->isEnabled('seals') &&
                $relation->seal->seal_model &&
                !$app->user->is('guest') &&
                ($app->user->is('superAdmin') ||
                    $app->user->is('admin') ||
                    $app->user->profile->id == $relation->owner->id)
            ) {

                $this->part('sealcertified/seal-model--printCertificate', ['relation' => $relation, 'idLayout' => $idLayout]);
            }
        });

        $app->hook('template(seal.edit.tabs-content):end', function () use ($app, $plugin) {

            $plugin->enqueueAssets();

            $entity = $this->controller->requestedEntity;

            $this->part('sealcertified/send-file--one', ['entity' => $entity]);
            $this->part('sealcertified/send-file--two', ['entity' => $entity]);
        });

        $app->hook('template(seal.<<create|edit>>.selo-layout):begin', function () use ($app, $plugin, $data) {
            //CONSULTA COM O SELO ATUAL
            $sealMeta = $app->repo('SealMeta')->findOneBy([
                'key'   => 'seal_layout',
                'owner' =>  $this->data['entity']->id
            ]);
            
            // LAYOUT PADRAO
            $idLayout = 0;
            // SE TIVER ALGUM RETORNO CONSULTA QUAL O LAYOUT PELO ID
            if(!is_null($sealMeta)){
                $idLayout = $sealMeta->value;
            }
            
            //CONSULTANDO TODOS OS TEMPLATES
            $layouts = $app->repo('Term')->findBy(['taxonomy' => 'seal_layout']);
           
            $this->part('sealcertified/select-layout', ['selects' => $layouts, 'layoutSeal' => $idLayout]);
          
        });

        $app->hook('POST(seal.saveLayout)', function() use($app, $plugin){
            //dump($this->data);
            $seal = $app->repo('Seal')->find($this->data['id_seal']);
            //CONSULTANDO PARA SABER SE TEM ALGUM LAYOUT CADASTRADO
            $layoutSeal = $app->repo('SealMeta')->findOneBy([
                'key'   => 'seal_layout',
                'owner' =>  $this->data['id_seal']
            ]);
           
            if($layoutSeal){
                //EDITA O VALOR EXISTENTE
                $layoutSeal->value = $this->data['id_layout'];
                $layoutSeal->save(true);
            }else{
                $sealMeta = new SealMeta;
                $sealMeta->key = 'seal_layout';
                $sealMeta->value = $this->data['id_layout'];
                $sealMeta->owner = $seal;
                $app->em->persist($sealMeta);    
                $app->em->flush();
                $this->json(['title' => 'Sucesso', 'message' => 'Confirmado', 'type' => 'success', 'status' => 200], 200);
            }
        });



    }

    public function register()
    {
        $app = App::i();
        $file_group_definition_one = new FileGroup('sealcertifiedone', ['^image/(jpeg|png)$'], \MapasCulturais\i::__('O arquivo enviado para a assinatura 1 não é uma imagem válida.'), true);
        $app->registerFileGroup('seal', $file_group_definition_one);

        $file_group_definition_two = new FileGroup('sealcertifiedtwo', ['^image/(jpeg|png)$'], \MapasCulturais\i::__('O arquivo enviado para a assinatura 2 não é uma imagem válida.'), true);
        $app->registerFileGroup('seal', $file_group_definition_two);

        $this->registerMetadata('MapasCulturais\Entities\Seal', 'name_sealcertifiedone', [
            'label' => 'Nome da assinatura 1',
            'type' => 'string',
            'private' => false,
        ]);

        $this->registerMetadata('MapasCulturais\Entities\Seal', 'name_sealcertifiedtwo', [
            'label' => 'Nome da assinatura 2',
            'type' => 'string',
            'private' => false,
        ]);

        $app->registerController('sealCertified', 'SealCertified\Controllers\Controller');

    }

    public function customCertificateText($sealRelation, $addLinks = false){
     
        function generateLink($url, $texto){
            return '<a href=' . $url . ' rel="noopener noreferrer"><i>' . $texto .'</i></a>';
        }
        
        $app = App::i();
        $mensagem = $sealRelation->seal->certificateText;
        $entity = $sealRelation->seal;
        $nomeSelo = $addLinks ? generateLink($app->createUrl('seal', 'single', ['id'=>$sealRelation->seal->id], 
        $sealRelation->seal->name), $sealRelation->seal->name) : $sealRelation->seal->name;

        $donoSelo = $addLinks ? generateLink($sealRelation->seal->owner->getSingleUrl(), 
        $sealRelation->seal->owner->name) : $sealRelation->owner->name;

        $nomeEntidade = $addLinks ? generateLink($sealRelation->owner->getSingleUrl(), 
        $sealRelation->owner->nomeCompleto) : $sealRelation->owner->nomeCompleto;

        $nomeCompleto = $addLinks ? generateLink($sealRelation->owner->getSingleUrl(), 
        $sealRelation->owner->nomeCompleto) : $sealRelation->owner->nomeCompleto;


        $dateInicio = $sealRelation->createTimestamp->format("d/m/Y");
        $seloExpira = isset($expirationDate);
        
        
        if($entity->validPeriod > 0){
            $dateFim = $sealRelation->validateDate->format('d/m/Y');
        }

        $nomeEntidade = empty($nomeCompleto) ? $nomeEntidade : $nomeCompleto;

        if(!empty($mensagem)){
            $mensagem = str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp",$mensagem);
            $mensagem = str_replace("[sealName]",$nomeSelo,$mensagem);
            $mensagem = str_replace("[sealOwner]",$donoSelo,$mensagem);
            $mensagem = str_replace("[sealShortDescription]",$sealRelation->seal->shortDescription,$mensagem);
            $mensagem = str_replace("[sealRelationLink]",$app->createUrl('seal','printsealrelation',[$sealRelation->id]),$mensagem);
            $mensagem = str_replace("[entityDefinition]",$sealRelation->owner->entityTypeLabel,$mensagem);
            $mensagem = str_replace("[entityName]",$nomeEntidade,$mensagem);

            if($entity->validPeriod > 0){
                $mensagem = str_replace("[dateFin]",$dateFim,$mensagem);
            }
            
            $mensagem = preg_replace('/\v+|\\\r\\\n/','<br/>',$mensagem);
            
        }
        else{
            $mensagem = '<p>' . \MapasCulturais\i::__('<b>Nome do Selo</b>') . ': ' . $nomeSelo .'</p>';
            $mensagem = $mensagem . '<p>' . \MapasCulturais\i::__('<b>Dono do Selo</b>') . ': ' . $donoSelo . '</p>';
            $mensagem = $mensagem . '<p>' . \MapasCulturais\i::__('<b>Descrição Curta</b>') . ': ' . $sealRelation->seal->shortDescription .'</p>';
            $mensagem = $mensagem . '<p>' . \MapasCulturais\i::__('<b>Tipo de Entidade</b>') . ': ' . $sealRelation->owner->entityTypeLabel .'</p>';
            $mensagem = $mensagem . '<p>' . \MapasCulturais\i::__('<b>Nome da Entidade</b>') . ': ' . $nomeEntidade .'</p>';
            $mensagem = $mensagem . '<p>' . \MapasCulturais\i::__('<b>Data de Criação</b>') . ': ' . $dateInicio .'</p>';

        }

        return $mensagem;
    }
    

    public function enqueueAssets(){
        $app = App::i();
        $app->view->enqueueScript('app', 'sealcertified', 'js/seal-certified.js', ['mapasculturais']);
    }

}
