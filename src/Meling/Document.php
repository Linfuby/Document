<?php
namespace Meling;

/**
 * Управление документом
 * Class Document
 *
 * @package Meling
 */
class Document
{
    /**
     * @var \Meling\Document\Builder
     * @version 1.0
     */
    protected $builder;

    /**
     * Document constructor.
     *
     * @param \PHPixie\Template $template
     * @version 1.0
     */
    public function __construct($template)
    {
        $this->builder = $this->buildBuilder($template);
    }

    /**
     * Возвращает Ссылки страницы
     *
     * @return \Meling\Document\Links
     * @version 1.0
     */
    public function links()
    {
        return $this->builder->links();
    }

    /**
     * Возвращает Мета-Тэги страницы
     *
     * @return \Meling\Document\Meta
     * @version 1.0
     */
    public function meta()
    {
        return $this->builder->meta();
    }

    /**
     * Возвращает Скрипты страницы
     *
     * @return \Meling\Document\Scripts
     * @version 1.0
     */
    public function scripts()
    {
        return $this->builder->scripts();
    }

    /**
     * Возвращает Заголовок страницы
     *
     * @return \Meling\Document\Title
     * @version 1.0
     */
    public function title()
    {
        return $this->builder->title();
    }

    /**
     * Возвращает строителя
     *
     * @param \PHPixie\Template $template
     * @return \Meling\Document\Builder
     * @version 1.0
     */
    protected function buildBuilder($template)
    {
        return new Document\Builder($template);
    }

}
