<?php
/**
* @package     JONGman Package
*
* @copyright   Copyright (C) 2005 - 2017 Prasit Gebsaap, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt

*/
defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;

/**
 * Instance table.
 *
 * @since       2.0
 */
class Instance extends Table
{
	/**
	 * Constructor.
	 *
	 * @param   JDatabaseDriver $db  A database connector object.
	 *
	 * @return  Instance
	 * @since   2.0
	 */
	public function __construct(\JDatabaseDriver $db)
	{
		parent::__construct('#__jongman_reservation_instances', 'id', $db);
	}


	/**
	 * Overloaded check method to ensure data integrity.
	 *
	 * @return  boolean  True on success.
	 * @since   2.0
	 */
	public function check()
	{
		// Check for valid reference number.
		if (trim($this->reference_number) === '') {
			$this->setError(JText::_('COM_JONGMAN_ERROR_INSTANCE_REFERNECE_NUMBER'));
			return false;
		}
		
		// Check for valid reservation id.
		if (empty($this->reservation_id)) {
			$this->setError(JText::_('COM_JONGMAN_ERROR_INSTANCE_RESERVATION_ID'));
			return false;
		}		

		// Check for valid start_date
		if (trim($this->start_date) === '') {
			$this->setError(JText::_('COM_JONGMAN_ERROR_INSTANCE_START_DATE'));
			return false;
		}			
		
		// Check for valid end date.
		if (trim($this->end_date) === '' ) {
			$this->setError(JText::_('COM_JONGMAN_ERROR_INSTANCE_END_DATE'));
			return false;
		}	
		return true;
	}
	
	public function setDuration(RFDateRange $daterange)
	{
			
	}
}