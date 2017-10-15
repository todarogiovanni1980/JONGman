<?php
/**
* @package     Joomla Extensions
* @subpackage  JONGman
*
* @copyright   Copyright (C) 2005 - 2017 Prasit Gebsaap, Inc. All rights reserved.
* @license     GNU General Public License version 2 or later; see LICENSE.txt
*/
defined('_JEXEC') or die;

interface IUpdateReservationPersistenceService extends IReservationPersistenceService
{
	/**
	 * @param int $reservationInstanceId
	 * @return RFReservationExistingSeries
	 */
	public function loadByInstanceId($reservationInstanceId);

	/**
	 * @param string $referenceNumber
	 * @return RFReservationExistingSeries
	*/
	public function loadByReferenceNumber($referenceNumber);
}

class RFReservationPersistenceServiceUpdate implements IUpdateReservationPersistenceService
{
	/**
	 * @var IReservationRepository
	 */
	private $_repository;

	public function __construct(IReservationRepository $repository)
	{
		$this->_repository = $repository;
	}

	public function LoadByInstanceId($reservationInstanceId)
	{
		return $this->_repository->loadById($reservationInstanceId);
	}

	public function persist($existingReservationSeries)
	{
		$this->_repository->update($existingReservationSeries);
	}

	public function loadByReferenceNumber($referenceNumber)
	{
		return $this->_repository->loadByReferenceNumber($referenceNumber);
	}
}