<?php
/**
 * @var \PHPixie\Template\Renderer\Runtime $this
 */
$name  = $this->get('name');
$equiv = $this->get('http-equiv');
?>
<meta <?= $name ? 'name="' . $name . '"' : ''; ?><?= $equiv ? 'http-equiv="' . $equiv . '"' : ''; ?> content="<?= $this->get('content'); ?>">