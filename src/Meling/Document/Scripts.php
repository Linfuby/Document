<?php
namespace Meling\Document;

/**
 * Скрипты страницы
 * Class Scripts
 *
 * @package Meling\Document
 */
class Scripts
{
    /**
     * @var \Meling\Document\Builder
     * @version 1.0
     */
    protected $builder;

    /**
     * @var array
     * @version 1.0
     */
    protected $scripts = array();

    /**
     * Scripts constructor.
     *
     * @param \Meling\Document\Builder $builder
     * @version 1.0
     */
    public function __construct(\Meling\Document\Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Добавить Скрипт
     *
     * @param string $href
     * @param string $type
     * @param bool   $async
     * @param bool   $defer
     * @param string $version
     * @version 1.0
     */
    public function add($href, $type = 'text/javascript', $async = false, $defer = false, $version = null)
    {
        if (!empty($version) && strpos($href, '?') === false) {
            $href .= '?' . (string)$version;
        }
        $this->scripts[$href] = $this->builder->buildScript($href, $type, $async, $defer);
    }

    /**
     * Возвращает все Скрипты
     *
     * @return string
     * @version 1.0
     */
    public function render()
    {
        /**
         * @var \Meling\Document\Scripts\Script $script
         */
        $result = '';
        foreach ($this->scripts as $script) {
            $result .= $script->render();
        }

        return $result;
    }

}
