<?php
$this->layout = 'nolayout-pdf'; 
require PLUGINS_PATH.'SealCertified/vendor/autoload.php';
$plugin = $app->plugins['SealCertified'];
$relation = $app->view->relObject['relation'];
?>
<h1>
    <?php
    $message = $plugin->customCertificateText($relation);
    echo $message;
    ?>
</h1>