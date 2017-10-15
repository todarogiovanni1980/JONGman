<?php
/**
* @package     Joomla Extensions
* @subpackage  JONGman
*
* @copyright   Copyright (C) 2005 - 2017 Prasit Gebsaap, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
defined('_JEXEC') or die;

interface ISeriesUpdateScope
{
	/**
	 * @param ExistingReservationSeries $series
	 * @return Reservation[]
	 */
	function getInstances($series);

	/**
	 * @return bool
	 */
	function requiresNewSeries();

	/**
	 * @return string
	 */
	function getScope();

	/**
	 * @param ExistingReservationSeries $series
	 * @return IRepeatOptions
	 */
	function getRepeatOptions($series);

	/**
	 * @param ExistingReservationSeries $series
	 * @param IRepeatOptions $repeatOptions
	 * @return bool
	 */
	function canChangeRepeatTo($series, $repeatOptions);

	/**
	 * @param ExistingReservationSeries $series
	 * @param Reservation $instance
	 * @return bool
	 */
	function shouldInstanceBeRemoved($series, $instance);
}