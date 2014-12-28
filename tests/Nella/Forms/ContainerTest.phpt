<?php
/**
 * Test: Nella\Forms\Container
 * @testCase
 *
 * This file is part of the Nella Project (http://nella-project.org).
 *
 * Copyright (c) Patrik Votoček (http://patrik.votocek.cz)
 *
 * For the full copyright and license information,
 * please view the file LICENSE.md that was distributed with this source code.
 */

namespace Nella\Forms;

use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

class ContainerTest extends \Tester\TestCase
{

	public function testAddContainer()
	{
		$container = $this->create();

		$subcontainer = $container->addContainer('test');
		Assert::type('Nella\Forms\Container', $subcontainer);
		Assert::same($subcontainer, $container->getComponent('test'));
		Assert::same($container, $subcontainer->getParent());
	}

	public function testGetForm()
	{
		$container = $this->create();

		Assert::type('Nella\Forms\Form', $container->getForm());
	}

	/**
	 * @return \Nella\Forms\Container
	 */
	private function create()
	{
		$form = new Form;
		$container = new Container($form, 'container');
		return $container;
	}

}

id(new ContainerTest)->run(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : NULL);
