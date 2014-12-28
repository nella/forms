<?php
/**
 * Test: Nella\Forms\Form
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

class FormTest extends \Tester\TestCase
{

	public function testAddContainer()
	{
		$form = $this->create();

		$container = $form->addContainer('test');
		Assert::type('Nella\Forms\Container', $container);
		Assert::same($container, $form->getComponent('test'));
		Assert::same($form, $container->getParent());
	}

	public function testGetForm()
	{
		$form = $this->create();

		Assert::same($form, $form->getForm());
	}

	/**
	 * @return \Nella\Forms\Container
	 */
	private function create()
	{
		return new Form;
	}

}

id(new FormTest)->run(isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : NULL);
