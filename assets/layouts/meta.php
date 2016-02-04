<?php
/**
 * @var \PHPixie\Template\Renderer\Runtime $this
 */
$name = $this->get('name');
$property = $this->get('property');
$equiv = $this->get('http-equiv');
?>
<meta <?= $name ? 'name="' . $name . '"' : ''; ?><?= $property ? 'property="' . $property . '"' : ''; ?><?= $equiv ? 'http-equiv="' . $equiv . '"' : ''; ?> content="<?= $this->get(
    'content'
); ?>">