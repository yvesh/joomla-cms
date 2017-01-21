<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Service-Worker.cache
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Class PlgServiceWorkerCache
 *
 * @since  __DEPLOY_VERSION__
 */
class PlgServiceWorkerCache extends JPlugin
{
	/**
	 * Get the service workers
	 *
	 * @return  array
	 *
	 * @since  __DEPLOY_VERSION__
	 */
	public function onGetServiceWorkers()
	{
		// We only cache on frontend when user is not logged in
		if (!JFactory::getApplication()->isClient('site') && !JFactory::getUser()->guest)
		{
			return array();
		}

		return array('media/plg_service-worker_cache/sw.js');
	}
}
