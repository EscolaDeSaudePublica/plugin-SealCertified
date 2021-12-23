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
        $data = $this->data;
        $app = App::i();
        $idLayout = $data[1];
        $relation = $app->repo('SealRelation')->find($this->data['id']);
      
        $term = $app->repo('Term')->findBy([
            'taxonomy' => 'seal_layout'
        ]);
        $id = 0;
        $layout = '';
        foreach ($term as $terms) {
            if($idLayout == md5($terms->id) ){
                $id = $terms->id;
                $layout = $terms->term;
            }
        }
        $this->render($layout, ['relation' => $relation]);
        // dump($layout);
        // dump($relation);
    }

    //Método para renderizar o template
    public function renderTemplate($file_dir, $file_name){
        $app = App::i();
        $_file_name = $app->view->resolveFilename($file_dir, $file_name);        
        return file_get_contents($_file_name);
    }

}