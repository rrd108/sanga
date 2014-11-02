<?php
namespace RBruteForce\Test\TestCase\Controller\Component;

use RBruteForce\Controller\Component\RBruteForceComponent;
use Cake\TestSuite\TestCase;
use Cake\Controller\Controller;
use Cake\Controller\ComponentRegistry;
use Cake\Network\Request;
use Cake\Network\Response;

class RBruteForceComponentTest extends TestCase {

    public $component = null;
    public $controller = null;

    public function setUp() {
        parent::setUp();
        // Setup our component and fake test controller
        $collection = new ComponentRegistry();
        $this->component = new RBruteForceComponent($collection);

        $request = new Request();
        $response = new Response();
        $this->controller = $this->getMock(
            'Cake\Controller\Controller',
            [],
            [$request, $response]
        );
    }

    public function testIncrementExpire() {
        $this->component->check();
        $this->assertEquals($expected, $actual);
    }

    public function tearDown() {
        parent::tearDown();
        // Clean up after we're done
        unset($this->component, $this->controller);
    }
}
?>