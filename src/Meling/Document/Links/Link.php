<?php
namespace Meling\Document\Links;

/**
 * Ссылка
 * Class Link
 *
 * @package Meling\Document\Links
 */
class Link
{
    /**
     * @var array
     * @version 1.0
     */
    protected $attributes = array();
    /**
     * @var \Meling\Document\Builder
     * @version 1.0
     */
    protected $builder;
    /**
     * @var string
     * @version 1.0
     */
    protected $href;
    /**
     * @var string
     * @version 1.0
     */
    protected $rel;
    /**
     * @var string
     * @version 1.0
     */
    protected $type;

    /**
     * Link constructor.
     *
     * @param \Meling\Document\Builder $builder
     * @param string                   $rel
     * @param string                   $href
     * @param string                   $type
     * @param array                    $attributes
     * @version 1.0
     */
    public function __construct($builder, $rel, $href, $type = null, $attributes = array())
    {
        $this->builder    = $builder;
        $this->rel        = $rel;
        $this->href       = $href;
        $this->type       = $type;
        $this->attributes = $attributes;
    }

    /**
     * Возвращает шаблон Ссылки
     *
     * @return mixed
     * @version 1.0
     */
    public function render()
    {
        return $this->builder->template('link', array(
            'rel' => $this->rel,
            'href' => $this->href,
            'type' => $this->type ? $this->builder->arrayToString(array('type' => $this->type)) : null,
            'attributes' => $this->builder->arrayToString($this->attributes),
        ))->render();
    }

}
