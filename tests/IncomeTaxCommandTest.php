<?php

namespace Tests;

use App\IncomeTaxCommand;
use PHPUnit\Framework\TestCase;

class IncomeTaxCommandTest extends TestCase
{
    public function testCalculateTaxFirstBracket()
    {
        $command = new IncomeTaxCommand();
        $result = $command->calculateTax(75000000);
        $this->assertEquals(6250000, $result);
    }

    public function testCalculateTaxLastBracket()
    {
        $command = new IncomeTaxCommand();
        $result = $command->calculateTax(750000000);
        $this->assertEquals(170000000, $result);
    }

}