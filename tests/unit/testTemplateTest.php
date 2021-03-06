<?php
use Codeception\Util\Stub;

class testTemplateTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
        $_SERVER['REQUEST_URI'] = '/test';
    }

    public function testRenderIsNotFalse()
    {
        $output = Template::render('/test', 'test.php');

        $this->assertTrue($output);
    }

    public function testRenderIsFalse()
    {
        $output = Template::render('/test_false', 'test.php');

        $this->assertFalse($output);
    }

}