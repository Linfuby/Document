<?php
namespace Meling\Tests\Document;

class ScriptsTest extends \PHPixie\Test\Testcase
{
    /**
     * @var \Meling\Document\Builder
     */
    protected $builder;
    /**
     * @type \Meling\Document\Scripts
     */
    protected $scripts;

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
        $this->scripts     = new \Meling\Document\Scripts($this->builder);
    }

    public function testAddScript()
    {
        $script = new \Meling\Document\Scripts\Script($this->builder, 'script.js?1.0', 'text/javascript', true, true);
        $this->scripts->add('script.js', 'text/javascript', true, true, '1.0');
        $this->assertInstance($this->scripts, 'Meling\Document\Scripts', array(
            'scripts' => array(
                'script.js?1.0' => $script
            )
        ));
    }

    public function testConstruct()
    {
        $this->assertInstance($this->scripts, 'Meling\Document\Scripts', array(
            'scripts' => array()
        ));
    }

    public function testRender()
    {
        $this->scripts->add('script.js', 'text/javascript', true, true, '1.0');
        $this->assertEquals(
            '<script type="text/javascript" src="script.js?1.0" async defer></script>',
            $this->scripts->render()
        );
    }
}
