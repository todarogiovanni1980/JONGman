<?php
/**
* @package     JONGman Package
*
* @copyright   Copyright (C) 2005 - 2017 Prasit Gebsaap, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
defined('_JEXEC') or die;

class RFReservationConflictDelete extends RFReservationConflictResolution
{
	/**
	 * @var IReservationRepository
	 */
	private $repository;

	public function __construct(IReservationRepository $repository)
	{
		$this->repository = $repository;
	}
	/**
	 * @param RFReservationItemView $existingReservation
	 * @return bool
	 */
	public function Handle(ReservationItemView $existingReservation)
	{
		$reservation = $this->repository->loadById($existingReservation->GetId());
		$reservation->applyChangesTo(RFReservationSeriesUpdateScope::ThisInstance);
		$reservation->delete(JFactory::getUser());
		$this->repository->delete($reservation);

		return true;
	}
}