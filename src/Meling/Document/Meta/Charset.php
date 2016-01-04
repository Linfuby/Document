<?php
namespace Meling\Document\Meta;

/**
 * Кодировка страницы
 * Class Charset
 *
 * @package Meling\Document\Meta
 */
class Charset
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
    protected $charset;

    /**
     * Charset constructor.
     *
     * @param \Meling\Document\Builder $builder
     * @param string                   $charset
     * @version 1.0
     */
    public function __construct($builder, $charset)
    {
        $this->builder = $builder;
        $this->charset = $charset;
    }

    /**
     * Возвращает шаблон Кодировки
     *
     * @return mixed
     * @version 1.0
     */
    public function render()
    {
        return $this->builder->template('charset', array(
            'charset' => $this->charset
        ))->render();
    }

}
