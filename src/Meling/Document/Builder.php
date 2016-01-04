<?php
namespace Meling\Document;

/**
 * Строитель классов
 * Class Builder
 *
 * @package Meling\Document
 */
class Builder
{
    /**
     * @var array
     * @version 1.0
     */
    protected $instances = array();
    /**
     * @var \PHPixie\Template
     * @version 1.0
     */
    protected $template;

    /**
     * Builder constructor.
     *
     * @param \PHPixie\Template $template
     * @version 1.0
     */
    public function __construct($template)
    {
        $this->template = $template;
    }

    /**
     * Конвертация массива в строку
     *
     * @param array  $array   Массив значений
     * @param string $inGlue  Соединение Ключа и Значения
     * @param string $outGlue Соединение всех пар (Ключ+Значение)
     * @param string $glue    Обертка для Значения
     * @return string
     *
     * @example : $builder->arrayToString(array('id' => 1, 'name' => 'Имя'))
     * @result  : id="1" name="Имя"
     *
     * @version 1.0
     */
    public function arrayToString($array = array(), $inGlue = '=', $outGlue = ' ', $glue = '"')
    {
        $result = array();

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result[] = $this->arrayToString($value, $inGlue, $outGlue);
            } else {
                $result[] = $key . $inGlue . $glue . $value . $glue;
            }
        }

        return $outGlue . implode($outGlue, $result);
    }

    /**
     * Создание Кодировки страницы
     *
     * @param $charset
     * @return \Meling\Document\Meta\Charset
     * @version  1.0
     */
    public function buildCharset($charset)
    {
        return new Meta\Charset($this, $charset);
    }

    /**
     * Создание Ссылки страницы
     *
     * @param string $rel
     * @param string $href
     * @param string $type
     * @param array  $attributes
     * @return \Meling\Document\Links\Link
     * @version 1.0
     */
    public function buildLink($rel, $href, $type = null, $attributes = array())
    {
        return new Links\Link($this, $rel, $href, $type, $attributes);
    }

    /**
     * Создание Мета-Тэга страницы
     *
     * @param string $name
     * @param string $content
     * @param bool   $equiv
     * @return \Meling\Document\Meta\Element
     * @version 1.0
     */
    public function buildMetaElement($name, $content, $equiv = false)
    {
        return new Meta\Element($this, $equiv ? null : $name, $equiv ? $name : null, $content);
    }

    /**
     * Создание Скрипта страницы
     *
     * @param string $href
     * @param string $type
     * @param bool   $async
     * @param bool   $defer
     * @return \Meling\Document\Scripts\Script
     * @version  1.0
     */
    public function buildScript($href, $type, $async = false, $defer = false)
    {
        return new Scripts\Script($this, $href, $type, $async, $defer);
    }

    /**
     * Возвращает Ссылки страницы
     *
     * @return \Meling\Document\Links
     * @version 1.0
     */
    public function links()
    {
        return $this->instance('links');
    }

    /**
     * Возвращает Мета-Тэги страницы
     *
     * @return \Meling\Document\Meta
     * @version 1.0
     */
    public function meta()
    {
        return $this->instance('meta');
    }

    /**
     * Возвращает Скрипты страницы
     *
     * @return \Meling\Document\Scripts
     * @version 1.0
     */
    public function scripts()
    {
        return $this->instance('scripts');
    }

    /**
     * Возвращает контейнер шаблона
     *
     * @param string $name
     * @param array  $data
     * @return \PHPixie\Template\Container
     * @version 1.0
     */
    public function template($name, $data = array())
    {
        return $this->template->get($name, $data);
    }

    /**
     * Возвращает Заголовок страницы
     *
     * @return \Meling\Document\Title
     * @version 1.0
     */
    public function title()
    {
        return $this->instance('title');
    }

    /**
     * @return \Meling\Document\Links
     * @version 1.0
     */
    protected function buildLinks()
    {
        return new Links($this);
    }

    /**
     * @return \Meling\Document\Meta
     * @version 1.0
     */
    protected function buildMeta()
    {
        return new Meta($this);
    }

    /**
     * @return \Meling\Document\Scripts
     * @version 1.0
     */
    protected function buildScripts()
    {
        return new Scripts($this);
    }

    /**
     * @return \Meling\Document\Title
     * @version 1.0
     */
    protected function buildTitle()
    {
        return new Title($this);
    }

    /**
     * @param string $name
     * @return mixed
     * @version 1.0
     */
    protected function instance($name)
    {
        if (!array_key_exists($name, $this->instances)) {
            $method                 = 'build' . ucfirst($name);
            $this->instances[$name] = $this->$method();
        }

        return $this->instances[$name];
    }

}
