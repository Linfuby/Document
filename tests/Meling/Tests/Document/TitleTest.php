<?php
namespace Meling\Tests\Document;

class TitleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @type \Meling\Document\Title
     */
    protected $title;

    public function setUp()
    {
        $this->title = new \Meling\Document\Title();
    }

    public function testConstruct()
    {
        $this->assertInstanceOf('\Meling\Document\Title', $this->title);
        $this->assertAttributeEquals(null, 'title', $this->title);
    }

    public function testGet()
    {
        $title = 'Title';
        $this->title->set($title);
        $this->assertEquals($title, $this->title->get());
    }

    public function testSet()
    {
        $title = 'Title';
        $this->title->set($title);
        $this->assertAttributeEquals($title, 'title', $this->title);
    }
}
