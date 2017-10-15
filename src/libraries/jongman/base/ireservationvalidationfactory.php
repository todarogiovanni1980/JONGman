<?php
/**
* @package     Joomla Extensions
* @subpackage  JONGman
*
* @copyright   Copyright (C) 2005 - 2017 Prasit Gebsaap, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
interface IReservationValidationFactory
{
	/**
	 * @param ReservationAction $reservationAction
	 * @param UserSession $userSession
	 * @return IReservationValidationService
	 */
	function create($reservationAction, $userSession);
}