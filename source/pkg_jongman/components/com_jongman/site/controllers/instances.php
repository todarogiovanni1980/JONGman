<?php

defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class JongmanControllerInstances extends JControllerAdmin
{
	protected $view_list = 'schedule';
	
	public function getModel($name = 'Instance', $prefix = 'JongmanModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}	
	
	public function delete()
	{
		parent::delete();
		$this->setRedirect(
			JRoute::_('index.php?option=' . $this->option . '&view=' . $this->view_list
				.$this->getRedirectToListAppend(), false)
		);
	}
	
	protected function getRedirectToListAppend()
	{
		$app = JFactory::getApplication();
		$append = '&layout=calendar';
		
		$schedule_id = $app->input->getInt('schedule_id', null);
		if (!empty($schedule_id)) {
			$append .= '&id='.$schedule_id;
		}
	
		return $append;
	
	}	
}