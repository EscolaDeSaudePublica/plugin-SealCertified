<?php
namespace SealCertified;
use \MapasCulturais\App;

class Plugin extends \SealModelTab\SealModelTemplatePlugin
{
    function __construct($config = []) {
      $config += [
         'logo-site' => 'img/logo-saude.png'
      ];
      parent::__construct($config);
   }

    function getModelData(){
        return [
            'label'=> 'Declaração ESP',
            'name' => 'SealCertified',
            'css' => 'seal-certified--styles.css',
            'js' => 'seal-certified.js',
            'background' => 'meu-certificado--bg.jpg',
            'preview' => 'seal-certified--preview.jpg'
        ];
    }

    public function _init() {
        parent::_init();

        $app = App::i();
        $data = $this->getModelData();

        $app->hook('template(seal.sealrelation.print-certificate):after', function($relation) use($app, $data){
            //Adicionando arquivos de estilo
            $app->view->enqueueStyle('app', $data['name'], 'css/' . $data['css']);
            
            if($app->isEnabled('seals') && 
                $relation->seal->seal_model &&
                !$app->user->is('guest') &&
                (   $app->user->is('superAdmin') || 
                    $app->user->is('admin') || 
                    $app->user->profile->id == $relation->owner->id
                )
            ) {
                
                $this->part('sealcertified/seal-model--printCertificate', ['relation' => $relation]);
            }
        });
    }
}