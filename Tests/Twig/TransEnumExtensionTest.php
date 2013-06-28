<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Twig;

use NetTeam\Bundle\DDDBundle\Twig\TransEnumExtension;
use NetTeam\DDD\Enum;

/**
 * @author Krzysztof Menżyk <krzysztof.menzyk@netteam.pl>
 *
 * @group  Unit
 */
class TransEnumExtensionTest extends \PHPUnit_Framework_TestCase
{
    private $translator;
    private $extension;

    protected function setUp()
    {
        $this->translator = \Mockery::mock('Symfony\Component\Translation\TranslatorInterface');
        $this->extension  = new TransEnumExtension($this->translator);
    }

    protected function tearDown()
    {
        $this->extension  = null;
        $this->translator = null;
    }

    public function testTransEnumShouldReturnNullIfEnumIsNull()
    {
        $enum = new ExampleEnum(ExampleEnum::__NULL);

        $this->extension->transEnum($enum);
    }

    public function testTransEnumShouldTranslateWithoutPrefix()
    {
        $enum = new ExampleEnum(ExampleEnum::ONE);
        $this->translator
            ->shouldReceive('trans')
            ->with('exampleEnum.one', array(), 'messages')
            ->andReturn('translation');

        $this->assertEquals('translation', $this->extension->transEnum($enum));
    }

    public function testTransEnumShouldTranslateWithPrefix()
    {
        $enum = new ExampleEnum(ExampleEnum::ONE);
        $this->translator
            ->shouldReceive('trans')
            ->with('prefix.exampleEnum.one', array(), 'messages')
            ->andReturn('translation');

        $this->assertEquals('translation', $this->extension->transEnum($enum, 'prefix'));
    }

    public function testTransEnumShouldTranslateWithDomain()
    {
        $enum = new ExampleEnum(ExampleEnum::ONE);
        $this->translator
            ->shouldReceive('trans')
            ->with('exampleEnum.one', array(), 'domain')
            ->andReturn('translation');

        $this->assertEquals('translation', $this->extension->transEnum($enum, '', 'domain'));
    }
}

class ExampleEnum extends Enum
{
    const ONE = 1;
    const TWO = 2;
}
