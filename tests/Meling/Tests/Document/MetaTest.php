<?php
namespace Meling\Tests\Document;

class MetaTest extends \PHPixie\Test\Testcase
{
    /**
     * @var \Meling\Document\Builder
     */
    protected $builder;
    /**
     * @type \Meling\Document\Meta
     */
    protected $meta;

    public function setUp()
    {
        $slice             = new \PHPixie\Slice();
        $filesystem        = new \PHPixie\Filesystem();
        $locatorConfig     = $slice->arrayData(array(
            'directory' => 'layouts'
        ));
        $root              = $filesystem->root(dirname(dirname(dirname(dirname(__DIR__)))) . '/assets');
        $filesystemLocator = $filesystem->buildlocator($locatorConfig, $root);
        $template          = new \PHPixie\Template($slice, $filesystemLocator, $slice->arrayData());
        $this->builder     = new \Meling\Document\Builder($template);
        $this->meta        = new \Meling\Document\Meta($this->builder);
    }

    public function testAdd()
    {
        $this->meta->add('robots', 'all');
        $this->meta->add('content-type', 'text/html; charset=utf-8', true);
        $meta  = new \Meling\Document\Meta\Element($this->builder, 'robots', null, 'all');
        $equiv = new \Meling\Document\Meta\Element($this->builder, null, 'content-type', 'text/html; charset=utf-8');
        $this->assertInstance($this->meta, '\Meling\Document\Meta', array(
            'meta' => array(
                'robots' => $meta,
                'content-type' => $equiv
            )
        ));
    }

    public function testCharset()
    {
        $charset = new\Meling\Document\Meta\Charset($this->builder, 'UTF-8');
        $this->meta->charset('UTF-8');
        $this->assertAttributeEquals(array('charset' => $charset), 'meta', $this->meta);
    }

    public function testConstructor()
    {
        $this->assertInstance($this->meta, '\Meling\Document\Meta', array(
            'meta' => array()
        ));
    }

    public function testRender()
    {
        $this->meta->charset('UTF-8');
        $this->meta->add('robots', 'all');
        $this->meta->add('content-type', 'text/html; charset=utf-8', true);
        $this->assertEquals(
            '<meta charset="UTF-8"><meta name="robots" content="all"><meta http-equiv="content-type" content="text/html; charset=utf-8">',
            $this->meta->render()
        );
    }
}
