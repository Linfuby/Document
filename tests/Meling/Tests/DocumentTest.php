<?php
namespace Meling\Tests;

class DocumentTest extends \PHPixie\Test\Testcase
{
    /**
     * @type \Meling\Document
     */
    protected $document;

    public function setUp()
    {
        $slice             = new \PHPixie\Slice();
        $filesystem        = new \PHPixie\Filesystem();
        $locatorConfig     = $slice->arrayData(array(
            'directory' => 'layouts'
        ));
        $root              = $filesystem->root(dirname(dirname(dirname(__DIR__))) . '/assets');
        $filesystemLocator = $filesystem->buildlocator($locatorConfig, $root);
        $template          = new \PHPixie\Template($slice, $filesystemLocator, $slice->arrayData());
        $this->document    = new \Meling\Document($template);
    }

    public function testConstructor()
    {
        $this->assertInstance($this->document, '\Meling\Document');
    }

    public function testLinks()
    {
        $this->assertInstance($this->document->links(), '\Meling\Document\Links');
    }

    public function testMeta()
    {
        $this->assertInstance($this->document->meta(), '\Meling\Document\Meta');
    }

    public function testScripts()
    {
        $this->assertInstance($this->document->scripts(), '\Meling\Document\Scripts');
    }

    public function testTitle()
    {
        $this->assertInstance($this->document->title(), '\Meling\Document\Title');
    }

}
