<?php
/**
* @package     JONGman Package
*
* @copyright   Copyright (C) 2005 - 2017 Prasit Gebsaap, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
defined('_JEXEC') or die;

abstract class RFReservationRepeatAbstract implements IRepeatOptions
{
	/**
	 * @var int
	 */
	protected $_interval;

	/**
	 * @var Date
	 */
	protected $_terminationDate;

	/**
	 * @return Date
	 */
	public function terminationDate()
	{
		return $this->_terminationDate;
	}

	/**
	 * @param int $interval
	 * @param Date $terminationDate
	 */
	protected function __construct($interval, $terminationDate)
	{
		$this->_interval = $interval;
		$this->_terminationDate = $terminationDate;
	}

	public function configurationString()
	{
		$obj = new JRegistry();
		$obj->set('repeat_interval', $this->_interval);
		$obj->set('repeat_terminated', $this->_terminationDate->toDatabase());
		
		return $obj->toString();
	}

	public function equals(IRepeatOptions $repeatOptions)
	{
		return $this->configurationString() == $repeatOptions->configurationString();
	}

	public function hasSameConfigurationAs(IRepeatOptions $repeatOptions)
	{
		return get_class($this) == get_class($repeatOptions) && $this->_interval == $repeatOptions->_interval;
	}
}
