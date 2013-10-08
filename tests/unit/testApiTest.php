<?php
use Codeception\Util\Stub;

class testApiTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
        $_SERVER['REQUEST_URI'] = '/table/get?code=4281';
    }

    public function testFetch()
    {
        $result = API::fetch('/table', false);

        $this->assertNotEmpty($result);
        $this->assertTrue($result['data'][0]['code'] == 4281);
        $this->assertTrue($result['status'] == 200);
    }

    public function testFetchFalse()
    {
        $_SERVER['REQUEST_URI'] = '/table/get?code=1234';   

        $result = API::fetch('/table', false);

        $this->assertEmpty($result['data']);

        $this->assertTrue($result['status'] == 401);
    }

    /**
     * Without specifying an action the API should throw
     * an exception notifying that there isn't an action
     */
    public function testFetchWithoutAction()    
    {
        $_SERVER['REQUEST_URI'] = '/table/?code=1234';   

        try {   
            $result = API::fetch('/table', false);
        } catch( Exception $e ) {
            $this->assertTrue($e->getMessage() == 'An action for the API has not been defined.');
        }
    }

}