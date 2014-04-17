<?php
defined('_JEXEC') or die;

class RFReservationRuleResourceMinimumDuration implements IReservationValidationRule
{
	private $message;
	/**
	 * @see IReservationValidationRule::validate()
	 * 
	 * @param RFReservationSeries $reservationSeries
	 * @return RFReservationRuleResult
	 */
	public function validate($reservationSeries)
	{
		$resources = $reservationSeries->allResources();
		
		foreach ($resources as $resource)
		{
			JLog::add("Resource : {$resource->getId()} has minimum duration ? {$resource->hasMinLength()}", JLog::DEBUG, 'validation');
			if ($resource->hasMinLength())
			{
				JLog::add("   Minimum duration is {$resource->getMinLength()->interval()}", JLog::DEBUG, 'validation');
				$minDuration = $resource->getMinLength()->interval();
				$start = $reservationSeries->currentInstance()->startDate();
				$end = $reservationSeries->currentInstance()->endDate();
				
				$minEnd = $start->applyDifference($minDuration);
				if ($end->lessThan($minEnd))
				{
					$this->message = JText::sprintf("COM_JONGMAN_ERROR_RULE_MIN_DURATION", $minDuration);
					return new RFReservationRuleResult(false, $this->message);
				}
			}
		}
		
		return new RFReservationRuleResult();
	}
	
	public function getError()
	{
		return $this->message;	
	}		
}