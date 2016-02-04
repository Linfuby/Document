<?php
namespace Meling\Document;

/**
 * Мета-Тэги страницы
 * Class Meta
 * @package Meling\Document
 */
class Meta
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
    protected $meta = array();

    /**
     * Meta constructor.
     * @param \Meling\Document\Builder $builder
     * @version 1.0
     */
    public function __construct(\Meling\Document\Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Добавить Мета-Тэг
     * @param string $name
     * @param string $content
     * @param bool   $equiv
     * @version 1.0
     */
    public function add($name, $content, $equiv = false)
    {
        if(is_array($name)) {
            $this->meta[current($name)] = $this->builder->buildMetaElement($name, $content, $equiv);
        } else {
            $this->meta[$name] = $this->builder->buildMetaElement($name, $content, $equiv);
        }
    }

    /**
     * Установить Кодировку
     * @param string $charset
     * @version 1.0
     */
    public function charset($charset = 'UTF-8')
    {
        $this->meta['charset'] = $this->builder->buildCharset($charset);
    }

    /**
     * Возвращает все Мета-Тэги
     * @return string
     * @version 1.0
     */
    public function render()
    {
        /**
         * @var \Meling\Document\Meta\Element $meta
         */
        $result = '';
        foreach($this->meta as $meta) {
            $result .= $meta->render();
        }

        return $result;
    }

}
