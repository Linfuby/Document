<?php
namespace Meling\Document\Meta;

/**
 * Мета-Тэг
 * Class Element
 * @package Meling\Document\Meta
 */
class Element
{
    /**
     * @var \Meling\Document\Builder
     * @version 1.0
     */
    protected $builder;

    /**
     * @var string
     * @version 1.0
     */
    protected $content;

    /**
     * @var string
     * @version 1.0
     */
    protected $equiv;

    /**
     * @var string
     * @version 1.0
     */
    protected $name;

    /**
     * Element constructor.
     * @param \Meling\Document\Builder $builder
     * @param string                   $name
     * @param string                   $equiv
     * @param string                   $content
     * @version 1.0
     */
    public function __construct($builder, $name, $equiv, $content)
    {
        $this->builder = $builder;
        $this->name    = $name;
        $this->equiv   = $equiv;
        $this->content = $content;
    }

    /**
     * Возвращает шаблон Мета-Тэга
     * @return mixed
     * @version 1.0
     */
    public function render()
    {
        if(!is_array($this->name)) {
            $name = array('name' => $this->name);
        } else {
            $name = $this->name;
        }

        return $this->builder->template(
            'meta', array_merge(
            $name, array(
            'http-equiv' => $this->equiv,
            'content'    => $this->content,
        )
        )
        )->render();
    }

}
