<?php
namespace Crud\Test\TestCase\Action;

use Cake\Routing\DispatcherFactory;
use Cake\Routing\Router;
use Crud\TestSuite\ControllerTestCase;
use Crud\Test\App\Controller\BlogsController;

/**
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 */
class ViewActionTest extends ControllerTestCase {

/**
 * fixtures property
 *
 * @var array
 */
	public $fixtures = ['plugin.crud.blog'];

/**
 * Controller class to mock on
 *
 * @var string
 */
	public $controllerClass = '\Crud\Test\App\Controller\BlogsController';

/**
 * Table class to mock on
 *
 * @var string
 */
	public $tableClass = 'Crud\Test\App\Model\Table\BlogsTable';

/**
 * Setup dispatcher filter and routes
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		DispatcherFactory::add('Routing');
		DispatcherFactory::add('ControllerFactory');

		Router::scope('/', function($routes) {
			$routes->fallbacks();
		});
	}

/**
 * Data provider with all HTTP verbs
 *
 * @return array
 */
	public function allHttpMethodProvider() {
		return [
			['get'],
			['post'],
			['put'],
			['delete']
		];
	}

/**
 * Test the normal HTTP flow for all HTTP verbs
 *
 * @dataProvider allHttpMethodProvider
 * @return void
 */
	public function testGet($method) {
		$controller = $this->generate($this->controllerClass);
		$this->_subscribeToEvents();

		$result = $this->_testAction('/blogs/view/1', compact('method'));

		$this->assertEvents(['beforeFind', 'afterFind',	'beforeRender']);
		$this->assertEquals(['viewVar', 'blog','success'], array_keys($this->vars));
	}

/**
 * Test that changing the viewVar reflects in controller::$viewVar
 *
 * @return void
 */
	public function testGetWithViewVar() {
		$controller = $this->generate($this->controllerClass);
		$controller->Crud->action('view')->viewVar('item');
		$this->_subscribeToEvents();

		$result = $this->_testAction('/blogs/view/1', compact('method'));
		$this->assertEvents(['beforeFind', 'afterFind',	'beforeRender']);
		$this->assertEquals(['viewVar', 'item','success'], array_keys($this->vars));
	}

}
