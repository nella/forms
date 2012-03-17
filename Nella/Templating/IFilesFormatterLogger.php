<?php
/**
 * This file is part of the Nella Framework.
 *
 * Copyright (c) 2006, 2011 Patrik Votoček (http://patrik.votocek.cz)
 *
 * This source file is subject to the GNU Lesser General Public License. For more information please see http://nella-project.org
 */

namespace Nella\Templating;

/**
 * @author	Patrik Votočke
 */
interface IFilesFormatterLogger
{
	/**
	 * @param string
	 * @param string
	 * @param array
	 */
	public function logFiles($name, $view, array $files);
}
