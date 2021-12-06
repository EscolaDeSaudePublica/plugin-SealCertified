<?php

namespace SealCertified;

use Doctrine\ORM\Query\Expr\Func;
use \MapasCulturais\App;
use \MapasCulturais\Definitions\FileGroup;

class Plugin extends \SealModelTab\SealModelTemplatePlugin
{
    function __construct($config = [])
    {
        $config += [
            'logo-site' => 'img/logo-saude.png'
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
            'preview' => 'seal-certified--preview.jpg'
        ];
    }

    public function _init()
    {
        parent::_init();


        $app = App::i();
        $data = $this->getModelData();
        $plugin = $this;
        $plugin->enqueueAssets();
    

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

            if (
                $app->isEnabled('seals') &&
                $relation->seal->seal_model &&
                !$app->user->is('guest') &&
                ($app->user->is('superAdmin') ||
                    $app->user->is('admin') ||
                    $app->user->profile->id == $relation->owner->id)
            ) {

                $this->part('sealcertified/seal-model--printCertificate', ['relation' => $relation]);
            }
        });

        $app->hook('template(seal.edit.tabs-content):end', function () use ($app, $plugin) {

            $plugin->enqueueAssets();

            $entity = $this->controller->requestedEntity;

            $this->part('sealcertified/send-file--one', ['entity' => $entity]);
            $this->part('sealcertified/send-file--two', ['entity' => $entity]);
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
    }

    public function enqueueAssets(){
        $app = App::i();
        $app->view->enqueueScript('app', 'sealcertified', 'js/seal-certified.js', ['mapasculturais']);
    }
}
