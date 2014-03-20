<?php
defined('_JEXEC') or die;

class RFEventInstanceRemoved extends RFSeriesEvent
{
	/**
	 * @var Reservation
	 */
	private $instance;

	/**
	 * @return Reservation
	 */
	public function Instance()
	{
		return $this->instance;
	}

	public function __construct(Reservation $reservationInstance, ExistingReservationSeries $series)
	{
		$this->instance = $reservationInstance;
		parent::__construct($series, SeriesEventPriority::Highest);
	}

	public function __toString()
	{
		return sprintf("%s%s", get_class($this), $this->instance->ReferenceNumber());
	}
}