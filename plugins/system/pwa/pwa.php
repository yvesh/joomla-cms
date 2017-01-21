<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.pwa
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Class PlgSystemPwa
 *
 * @since  __DEPLOY_VERSION__
 */
class PlgSystemPwa 
{
	/**
	 * Load the progressive web app and it's web workers
	 *
	 * @return  bool
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	public function onAfterRender()
	{
		$dispatcher = JEventDispatcher::getInstance();
		$plugins = $dispatcher->trigger('onGetServiceWorkers');

		// Manifest JSON



		// Service Workers
		if (!count($plugins))
		{
			return true;
		}
	}
}
