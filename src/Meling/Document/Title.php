<?php
namespace Meling\Document;

/**
 * Заголовок страницы
 * Class Title
 *
 * @package Meling\Document
 */
class Title
{
    /**
     * @var string
     * @version 1.0
     */
    protected $title;

    /**
     * Возвращает заголовок
     *
     * @return string
     * @version 1.0
     */
    public function get()
    {
        return $this->title;
    }

    /**
     * Установить заголовок.
     *
     * @param $title
     * @version 1.0
     */
    public function set($title)
    {
        $this->title = htmlspecialchars($title);
    }

}
