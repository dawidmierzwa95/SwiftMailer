<?php

use PHPUnit\Framework\TestCase;
use Src\Main;

class mainTest extends TestCase
{
    public function testPortCanBeUseAsInteger(): void
    {
        $this->assertEquals(
            25,
            Main::SMTP_PORT
        );
    }

    public function testEmailFormat(): void
    {
        $this->assertEquals(
            'dawidmierzwa95@gmail.com',
            Main::formatEmail('dawidmierzwa95@gmail.com')
        );
    }
}