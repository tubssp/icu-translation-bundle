<?php

namespace Webfactory\TranslatorBundle\Tests\Translator\Formatting;

/**
 * Tests the abstract formatter decorator.
 */
class AbstractFormatterDecoratorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * System under test.
     *
     * @var \Webfactory\TranslatorBundle\Translator\Formatting\AbstractFormatterDecorator
     */
    protected $decorator = null;

    /**
     * The simulated inner formatter.
     *
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $innerFormatter = null;

    protected function setUp()
    {
        parent::setUp();
        $formatterInterface   = 'Webfactory\TranslatorBundle\Translator\Formatting\FormatterInterface';
        $this->innerFormatter = $this->getMock($formatterInterface);
        $decoratorClass  = 'Webfactory\TranslatorBundle\Translator\Formatting\AbstractFormatterDecorator';
        $this->decorator = $this->getMockForAbstractClass($decoratorClass, array($this->innerFormatter));
    }

    protected function tearDown()
    {
        $this->decorator      = null;
        $this->innerFormatter = null;
        parent::tearDown();
    }

    /**
     * Checks if the decorator implements the formatter interface.
     */
    public function testImplementsInterface()
    {
        $formatterInterface = 'Webfactory\TranslatorBundle\Translator\Formatting\FormatterInterface';
        $this->assertInstanceOf($formatterInterface, $this->decorator);
    }

    /**
     * Checks if the decorator delegates format() calls to the inner formatter.
     */
    public function testFormatDelegatesToInnerFormatter()
    {
        $this->innerFormatter->expects($this->once())->method('format');

        $this->decorator->format('de_DE', 'test message', array());
    }

}