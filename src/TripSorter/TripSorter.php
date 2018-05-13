<?php

namespace EriSitohang\TripSorter;


use EriSitohang\TripSorter\Transportation\AbstractTransportation;

class TripSorter
{
    const END_LIST = 'You have arrived at your final destination.';

    /**
     * @var AbstractTransportation[]
     */
    private $boardingCards;
    /**
     * @var AbstractTransportation[]
     */
    private $departures;

    /**
     * @var AbstractTransportation[]
     */
    private $arrivals;

    /**
     * Add boarding card
     *
     * @param AbstractTransportation $transportation
     * @return $this
     */
    public function addBoardingCard(AbstractTransportation $transportation)
    {
        $this->boardingCards[] = $transportation;
        $this->departures[] = $transportation;
        $this->arrivals[] = $transportation;
        return $this;
    }

    /**
     * Sort trips
     *
     * @return void
     */
    public function sorter()
    {
        foreach ($this->boardingCards as $boardingCard) {
            $arrival = $boardingCard->getArrival();
            $departure = $boardingCard->getDeparture();
            if (array_key_exists($arrival, $this->departures)) {
                $this->departures[$arrival]->setPrevious($boardingCard);
            }

            if (array_key_exists($departure, $this->arrivals)) {
                $this->arrivals[$departure]->setNext($boardingCard);
            }
        }
    }

    /**
     * Get Trip List
     *
     * @return string
     */
    public function getResult(): string
    {
        $result = [];

        foreach ($this->boardingCards as $i => $boardingCard) {
            $result[] = sprintf('%d. %s', $i + 1, $boardingCard);
        }

        $result[] = (count($result) + 1) . '. ' . self::END_LIST;

        return implode(PHP_EOL, $result);
    }
}
