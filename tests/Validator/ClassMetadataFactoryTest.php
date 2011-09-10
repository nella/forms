<?php
/**
 * This file is part of the Nella Framework.
 *
 * Copyright (c) 2006, 2011 Patrik Votoček (http://patrik.votocek.cz)
 *
 * This source file is subject to the GNU Lesser General Public License. For more information please see http://nella-project.com
 */

namespace NellaTests\Validator;

class ClassMetadataFactoryTest extends \Nella\Testing\TestCase
{
	/** @var \Nella\Validator\ClassMetadataFactory */
	private $factory;

	public function setup()
	{
		$this->factory = new \Nella\Validator\ClassMetadataFactory;
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testGetInvalidClassMetadataException()
	{
		$this->factory->getClassMetadata('Test');
	}

	public function testGetClassMetadata()
	{
		$this->assertInstanceOf(
			'Nella\Validator\ClassMetadata',
			$this->factory->getClassMetadata('NellaTests\Validator\ClassMetadataFactory\Foo'),
			"->getClassMetadata('..') instance of ClassMetadata");

		$this->assertInstanceOf(
			'Nella\Validator\ClassMetadata',
			$this->factory->getClassMetadata('NellaTests\Validator\ClassMetadataFactory\Foo'),
			"->getClassMetadata('..') - from registry - instance of ClassMetadata");
	}
}

namespace NellaTests\Validator\ClassMetadataFactory;

class Foo
{
	/**
	 * @validate(url,minlength=20)
	 * @var mixed
	 */
	private $foo;
}