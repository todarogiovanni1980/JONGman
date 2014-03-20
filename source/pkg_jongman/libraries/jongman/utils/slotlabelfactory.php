<?php
defined('_JEXEC') or die;

class SlotLabelFactory
{
	/**
	 * @static
	 * @param ReservationItemView $reservation
	 * @return string
	 */
	public static function create(RFReservationItem $reservation)
	{
		$f = new SlotLabelFactory();
		return $f->format($reservation);
	}

	/**
	 * @param ReservationItemView $reservation
	 * @return string
	 */
	public function format(RFReservationItem $reservation)
	{
		$property = JComponentHelper::getParams('com_jongman')->get('reservationBarDisplay');

		$name = $this->getFullName($reservation);

		if ($property == 'titleORuser')
		{
			if (strlen($reservation->title))
			{
				return $reservation->title;
			}
			else
			{
				return $name;
			}
		}
		if ($property == 'title')
		{
			return $reservation->title;
		}
		if ($property == 'none' || empty($property))
		{
			return '';
		}
		if ($property == 'name' || $property == 'user')
		{
			return $name;
		}
		
		if ($property == 'userANDtitle') {
			$property = '{name}@{title}';			
		}

		$label = $property;
		$label = str_replace('{name}', $name, $label);
		$label = str_replace('{title}', $reservation->title, $label);
		$label = str_replace('{description}', $reservation->description, $label);

		return $label;
	}

	protected function getFullName(RFReservationItem $reservation)
	{
		$shouldHide = JComponentHelper::getParams('com_jongman')->get('hideOwnerDetail', true);
		if ($shouldHide)
		{
			return JText::_('COM_JONGMAN_PRIVATE');
		}

		$name = $reservation->fullName;
		return $name;

	}
}

class NullSlotLabelFactory extends SlotLabelFactory
{
	public function format(ReservationItemView $reservation)
	{
		return '';
	}
}

class AdminSlotLabelFactory extends SlotLabelFactory
{
	protected function getFullName(ReservationItemView $reservation)
	{
		$name = new FullName($reservation->FirstName, $reservation->LastName);
		return $name->__toString();
	}
}