<?php
/**
 * This file is part of the Nella Framework.
 *
 * Copyright (c) 2006, 2011 Patrik Votoček (http://patrik.votocek.cz)
 *
 * This source file is subject to the GNU Lesser General Public License. For more information please see http://nella-project.org
 */

namespace Nella\Config\Extensions;

/**
 * Nella Framework extension
 *
 * Registering default dao services
 *
 * @author	Patrik Votoček
 */
class NellaExtension extends \Nette\Config\CompilerExtension
{
	/** @var array */
	public $defaults = array(
		'namespaces' => array(),
		'template' => array(
			'dirs' => array(
				'%appDir%' => 2,
			),
			'debugger' => TRUE,
		),
	);

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config = $this->getConfig($this->defaults);

		if ($builder->hasDefinition('nette.presenterFactory')) {
			$def = $builder->getDefinition('nette.presenterFactory');
			$def->setClass('Nella\Application\PresenterFactory', array("@container"));

			foreach ($config['namespaces'] as $namespace => $priority) {
				if (\Nette\Utils\Validators::isNumericInt($namespace)) {
					$def->addSetup('addNamespace', array($priority));
				} else {
					$def->addSetup('addNamespace', array($namespace, $priority));
				}
			}
		}

		$def = $builder->addDefinition($this->prefix('templateFilesFormatter'));
		$def->setClass('Nella\Templating\TemplateFilesFormatter');
		foreach ($config['template']['dirs'] as $dir => $priority) {
			if (\Nette\Utils\Validators::isNumericInt($dir)) {
				$def->addSetup('addDir', array($priority));
			} else {
				$def->addSetup('addDir', array($dir, $priority));
			}
		}
		if ($config['template']['debugger']) {
			$logger = $builder->addDefinition($this->prefix('templateFilesFormatterLogger'));
			$logger->setClass('Nella\Templating\Diagnostics\FilesPanel');
			$logger->addSetup('Nette\Diagnostics\Debugger::$bar->addPanel(?)', array('@self'));
			$def->addSetup('setLogger', array($logger));
		}

		if ($builder->hasDefinition('router') && $builder->hasDefinition('doctrine.console')) {
			$builder->addDefinition($this->prefix('consoleRoute'))
				->setClass('Nella\Application\Routers\CliRouter', array($builder->getDefinition('doctrine.console')))
				->setAutowired(FALSE);

			$builder->getDefinition('router')
				->addSetup('offsetSet', array(NULL, $builder->getDefinition($this->prefix('consoleRoute'))));
		}
	}
}
