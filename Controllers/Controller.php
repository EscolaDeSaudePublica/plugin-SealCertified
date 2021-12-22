<?php

namespace SealCertified\Controllers;

use MapasCulturais\App;


/**
 * Registration Controller
 *
 * By default this controller is registered with the id 'registration'.
 *
 *  @property-read \MapasCulturais\Entities\Registration $requestedEntity The Requested Entity
 */
// class extends \MapasCulturais\Controllers\EntityController {
class Controller extends \MapasCulturais\Controller
{

    function GET_gerarSelo() {
        dump('gerarSelo');
        dump($this->data);
        $data = $this->data;
        $app = App::i();
        foreach ($data as $key => $value) {
            dump($value);
        }
        $relation = $app->repo('SealRelation')->find($this->data['id']);
      
        $layout = $app->repo('SealMeta')->findBy([
            'owner' => $relation->seal,
            'key' => 'layout'
        ]);
        dump($layout);
        dump($relation);
    }

    //Método para renderizar o template
    public function renderTemplate($file_dir, $file_name){
        $app = App::i();
        $_file_name = $app->view->resolveFilename($file_dir, $file_name);        
        return file_get_contents($_file_name);
    }

}