<?php

namespace NetTeam\Bundle\DDDBundle\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Testy funkcjonalne dla serwisu Clock
 *
 * @author Piotr Walków <piotr.walkow@netteam.pl>
 */
class ClockServiceTest extends WebTestCase
{
    /**
     * Sprawdzenie czy serwis został utworzony poprawnie
     */
    public function testIfServiceExists()
    {
        $client = static::createClient(array(
            'environment' => 'test',
            'debug' => false,
        ));

        $clock = $client->getContainer()->get('clock');

        $this->assertInstanceOf('NetTeam\DDD\Time\ClockInterface', $clock);
    }
}
