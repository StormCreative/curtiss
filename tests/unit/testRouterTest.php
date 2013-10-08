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

    public function testGetUri()
    {
        $output = Route::get_uri();
        
        $this->assertTrue($output['route'] == 'test');
    }

    public function testDecipher()
    {
        $output = Route::decipher('/test/get/?code=123');

        $this->assertTrue($output['route'] == 'test');
        $this->assertTrue($output['route_0'] == 'get');
        $this->assertTrue($output['additions'] == 'code=123');
    }

}