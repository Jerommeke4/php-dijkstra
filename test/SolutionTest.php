<?php

use PHPUnit\Framework\TestCase;
use Scape\Domain\Solution\ConnectivitySolution;

/**
 *
 */
class SolutionTest extends TestCase
{

    public function testCreateConnectivitySolution()
    {
        $solution = new ConnectivitySolution();
        self::assertTrue($solution->execute());
    }
}
