<?php
/**
 * This file is part of the Nella Project (http://nella-project.org).
 *
 * Copyright (c) Patrik Votoček (http://patrik.votocek.cz)
 *
 * For the full copyright and license information,
 * please view the file LICENSE.md that was distributed with this source code.
 */

namespace Nella\Forms;

/**
 * @author Patrik Votoček
 */
class Container extends \Nette\Forms\Container
{

	/**
	 * @param string
	 * @return \Nella\Forms\Container
	 */
	public function addContainer($name)
	{
		$container = new static($this, $name);
		$container->currentGroup = $this->currentGroup;
		return $container;
	}

	/**
	 * @param bool
	 * @return \Nella\Forms\Form
	 */
	public function getForm($need = TRUE)
	{
		return parent::getForm($need);
	}

}
