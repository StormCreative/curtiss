<?php
use Codeception\Util\Stub;

class testRouterTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
        $_SERVER['REQUEST_URI'] = '/test';
    }

    public function testMatchIsTrue()
    {
        $output = Route::match( '/test' );

        $this->assertTrue( $output );
    }

    public function testMatchIsFalse()
    {
        $output = Route::match( '/banana' );

        $this->assertFalse($output);
    }

}