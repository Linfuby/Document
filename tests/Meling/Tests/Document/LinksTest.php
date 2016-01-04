<?php
namespace Meling\Tests\Document;

class LinksTest extends \PHPixie\Test\Testcase
{
    /**
     * @var \Meling\Document\Builder
     */
    protected $builder;
    /**
     * @type \Meling\Document\Links
     */
    protected $links;

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
        $this->links       = new \Meling\Document\Links($this->builder);
    }

    public function testAdd()
    {
        $link = new \Meling\Document\Links\Link($this->builder, 'author license', 'license.html?1.0');
        $this->links->add('author license', 'license.html', null, '1.0');
        $this->assertInstance($this->links, '\Meling\Document\Links', array(
            'links' => array(
                'license.html?1.0' => $link
            )
        ));
    }

    public function testAddAlternate()
    {
        $link = new \Meling\Document\Links\Link($this->builder, 'alternate', 'http://webref.ru/rss.xml',
            'application/rss+xml');
        $this->links->addAlternate('http://webref.ru/rss.xml', 'application/rss+xml');
        $this->assertInstance($this->links, '\Meling\Document\Links', array(
            'links' => array(
                'http://webref.ru/rss.xml' => $link
            )
        ));
    }

    public function testAddIcon()
    {
        $link = new \Meling\Document\Links\Link($this->builder, 'shortcut icon', 'favicon.ico',
            'image/x-icon', array('sizes' => '48x48'));
        $this->links->addIcon('favicon.ico', 'image/x-icon', '48x48');
        $this->assertInstance($this->links, '\Meling\Document\Links', array(
            'links' => array(
                'favicon.ico' => $link
            )
        ));
    }

    public function testAddStyleSheet()
    {
        $link = new \Meling\Document\Links\Link($this->builder, 'stylesheet', 'stylesheet.css', 'text/css');
        $this->links->addStyleSheet('stylesheet.css');
        $this->assertInstance($this->links, '\Meling\Document\Links', array(
            'links' => array(
                'stylesheet.css' => $link
            )
        ));
    }

    public function testConstructor()
    {
        $this->assertInstance($this->links, '\Meling\Document\Links', array(
            'links' => array()
        ));
    }

    public function testRender()
    {
        $this->links->addStyleSheet('stylesheet.css', 'text/css', array(array('id' => true)));
        $this->assertEquals('<link rel="stylesheet" href="stylesheet.css" type="text/css"  id="1"/>',
            $this->links->render());
    }
}
