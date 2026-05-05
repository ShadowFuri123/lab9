<?php

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
   public function testTrueIsTrue()
   {
       $this->assertTrue(true);
       $this->assertEquals(2, 1 + 2);
   }
}
