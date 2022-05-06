<?php

$this->layout = 'nolayout-pdf'; 
$plugin = $app->plugins['SealCertified'];

$relation = $app->view->relObject['relation'];
?>

<div class="name" style="padding-top:215px;text-align:center;">
    <span style="font-size: 26px;background:#fff;"><?php echo $relation->owner->name ?></span>
</div>  

