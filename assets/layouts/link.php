<?php
/**
 * @var \PHPixie\Template\Renderer\Runtime $this
 */
$type       = $this->get('type') ? $this->get('type') : '';
$attributes = $this->get('attributes') ? $this->get('attributes') : '';
?>
<link rel="<?= $this->get('rel'); ?>" href="<?= $this->get('href'); ?>"<?= $type . $attributes; ?>/>