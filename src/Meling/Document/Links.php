<?php
namespace Meling\Document;

/**
 * Ссылки страницы
 * Class Links
 *
 * @package Meling\Document
 */
class Links
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
    protected $links = array();

    /**
     * Links constructor.
     *
     * @param \Meling\Document\Builder $builder
     * @version 1.0
     */
    public function __construct(\Meling\Document\Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Добавить ссылку
     *
     * @param string $rel
     * @param string $href
     * @param string $type
     * @param string $version
     * @param array  $attributes
     * @version 1.0
     */
    public function add($rel, $href, $type = null, $version = null, $attributes = array())
    {
        if (!empty($version) && strpos($href, '?') === false) {
            $href .= '?' . htmlspecialchars($version);
        }
        $this->links[$href] = $this->builder->buildLink($rel, $href, $type, $attributes);
    }

    /**
     * Добавить альтернативную ссылку
     *
     * @param string $href
     * @param string $type
     * @param array  $attributes
     * @version 1.0
     */
    public function addAlternate($href, $type, $attributes = array())
    {
        $this->links[$href] = $this->builder->buildLink('alternate', $href, $type, $attributes);
    }

    /**
     * Добавить иконку
     *
     * @param string $href
     * @param string $type
     * @param string $sizes
     * @param array  $attributes
     * @version 1.0
     */
    public function addIcon($href, $type = 'image/vnd.microsoft.icon', $sizes = '', $attributes = array())
    {
        if ($sizes) {
            $attributes = array_merge(array('sizes' => $sizes), $attributes);
        }
        $this->links[$href] = $this->builder->buildLink('shortcut icon', $href, $type, $attributes);
    }

    /**
     * Добавить ссылку стилей
     *
     * @param string $href
     * @param string $type
     * @param array  $attributes
     * @version 1.0
     */
    public function addStyleSheet($href, $type = 'text/css', $attributes = array())
    {
        $this->links[$href] = $this->builder->buildLink('stylesheet', $href, $type, $attributes);
    }

    /**
     * Возвращает все Ссылки
     *
     * @return string
     * @version 1.0
     */
    public function render()
    {
        /**
         * @var \Meling\Document\Links\Link $link
         */
        $result = '';
        foreach ($this->links as $link) {
            $result .= $link->render();
        }
        return $result;
    }

}
