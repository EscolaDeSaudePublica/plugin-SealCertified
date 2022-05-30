<?php
    $action = preg_replace("#^(\w+/)#", "", $this->template);
    $this->bodyProperties['ng-app'] = "entity.app";
    $this->bodyProperties['ng-controller'] = "EntityController";
    $this->addEntityToJs($relation);

    if($this->isEditable()){
        $this->addEntityTypesToJs($relation);
    }

    $this->includeMapAssets();
    $this->includeAngularEntityAssets($relation);
?>

<article class="main-content seal">
    <!-- exibição dos avatares do selo e do agente -->
    <div class="row">
        <div class="column seal-avatar-esp">
            <a href="<?php echo $seal->getSingleUrl(); ?>">
                <?php $this->part('singles/avatar-seal-relation', ['entity' => $seal, 'size'=> 'avatarMedium', 'default_image' => 'img/avatar--seal.png']); ?>
            </a>
        </div>
        <div class="column agent-avatar-esp">
            <a href="<?php echo $relation->owner->getSingleUrl(); ?>" >
                <?php $this->part('singles/avatar-seal-relation', ['entity' => $relation->owner, 'size'=> 'avatarMedium', 'default_image' => 'img/avatar--seal.png']); ?>
            </a>                    
        </div>
    </div>
        <div id="seal-info-container-esp">
            <div id="seal-name-esp">
                <?php $this->applyTemplateHook('seal-name','before'); ?>
                <div class="text-center">
                    <h2>
                        <span class="js-editable" data-edit="name" data-original-title="<?php \MapasCulturais\i::esc_attr_e("Nome de exibição");?>" data-emptytext="<?php \MapasCulturais\i::esc_attr_e("Nome de exibição");?>">
                            <a href="<?php echo $app->createUrl('seal', 'single', ['id' => $seal->id])?>"><?php echo $seal->name; ?></a>
                        </span>
                    </h2>
                </div>
                <?php $this->applyTemplateHook('seal-name','after'); ?>
            </div>
            <div id="agent-name">
                <?php $this->applyTemplateHook('agent-name','before'); ?>
                <h5> Participante:
                    <span class="js-editable" data-edit="name" data-original-title="<?php \MapasCulturais\i::esc_attr_e("Nome de exibição");?>" data-emptytext="<?php \MapasCulturais\i::esc_attr_e("Nome de exibição");?>">
                        <a href="<?php echo $relation->owner->getSingleUrl(); ?>"><?php echo $relation->owner->name; ?></a>
                    </span>
                </h5>
                <?php $this->applyTemplateHook('agent-name','after'); ?>
            </div>
             <!--print seal relation -->
             <?php $this->applyTemplateHook('print-certificate','before'); ?>
            <div id="seal-print-container">
                <?php echo $printSeal ?>

                <?php //$this->part('seal-model--printCertificate--esp', ['relation' => $relation]); ?>
            </div>
            <?php $this->applyTemplateHook('print-certificate','after',[$relation]); ?>
        </div><!-- fim seal info container -->
        <!-- Data de expiração -->
        <?php if($seal->validPeriod > 0):?>
            <div id="expiration-date">
                <?php if($relation->isExpired()): ?>
                    <?php \MapasCulturais\i::_e('<b>Expirado em:</b>'); ?>
                <?php else:?>
                    <?php \MapasCulturais\i::_e('<b>Válido até:</b>'); ?>
                <?php endif;?>
                <?php echo $relation->validateDate->format('d/m/Y'); ?>
            </div>
        <?php endif; ?>
</article>
