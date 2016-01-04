<?php
/**
 * @var \PHPixie\Template\Renderer\Runtime $this
 */
$async = $this->get('async') ? ' async' : '';
$defer = $this->get('defer') ? ' defer' : '';
?>
<script type="<?= $this->get('type'); ?>" src="<?= $this->get('href'); ?>"<?= $async . $defer; ?>></script>