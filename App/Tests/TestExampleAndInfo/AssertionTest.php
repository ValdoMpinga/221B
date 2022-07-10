<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

final class AssertionTest extends TestCase
{
    public function testNumbers(): void
    {
        assertEquals(3,3,'erro grave');
    }
}





?>