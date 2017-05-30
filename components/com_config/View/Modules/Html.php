<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_config
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Config\Site\View\Modules;

defined('_JEXEC') or die;

use \Joomla\CMS\View\HtmlView;
use Joomla\Component\Config\Site\Model\Modules;

/**
 * View to edit a module.
 *
 * @package     Joomla.Site
 * @subpackage  com_config
 * @since       3.2
 */
class Html extends HtmlView
{
	/**
	 * The module to be rendered
	 *
	 * @var   array
	 * @since 3.2
	 */
	public $item;

	/**
	 * The form object
	 *
	 * @var   \JForm
	 * @since 3.2
	 */
	public $form;

	/**
	 * Display the view
	 *
	 * @return  string  The rendered view.
	 *
	 * @since   3.2
	 */
	public function display($tpl = null)
	{
		$lang = \JFactory::getApplication()->getLanguage();
		$lang->load('', JPATH_ADMINISTRATOR, $lang->getTag());
		$lang->load('com_modules', JPATH_ADMINISTRATOR, $lang->getTag());

		// TODO Move and clean up
		$module = (new \Joomla\Component\Modules\Administrator\Model\Module)->getItem(\JFactory::getApplication()->input->getInt('id'));

		$moduleData = $module->getProperties();
		unset($moduleData['xml']);

		/** @var Modules $model */
		$model = $this->getModel();

		// Need to add module name to the state of model
		$model->getState()->set('module.name', $moduleData['module']);

		/** @var \JForm form */
		$this->form      = $this->get('form');
		$this->positions = $this->get('positions');
		$this->item      = $moduleData;

		if ($this->form)
		{
			$this->form->bind($moduleData);
		}

		return parent::display($tpl);
	}
}
