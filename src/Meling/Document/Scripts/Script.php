<?php
namespace Meling\Document\Scripts;

/**
 * Скрипт
 * Class Script
 *
 * @package Meling\Document\Scripts
 */
class Script
{
    /**
     * @var bool
     * @version 1.0
     */
    protected $async;
    /**
     * @var \Meling\Document\Builder
     * @version 1.0
     */
    protected $builder;
    /**
     * @var bool
     * @version 1.0
     */
    protected $defer;
    /**
     * @var string
     * @version 1.0
     */
    protected $href;
    /**
     * @var string
     * @version 1.0
     */
    protected $type;

    /**
     * Script constructor.
     *
     * @param \Meling\Document\Builder $builder
     * @param string                   $href
     * @param string                   $type
     * @param bool                     $async
     * @param bool                     $defer
     * @version 1.0
     */
    public function __construct($builder, $href, $type, $async = false, $defer = false)
    {
        $this->builder = $builder;
        $this->href    = $href;
        $this->type    = $type;
        $this->async   = $async;
        $this->defer   = $defer;
    }

    /**
     * Возвращает шаблон Скрипта
     *
     * @return mixed
     * @version 1.0
     */
    public function render()
    {
        return $this->builder->template('script', array(
            'href' => $this->href,
            'type' => $this->type,
            'async' => $this->async,
            'defer' => $this->defer,
        ))->render();
    }

}
