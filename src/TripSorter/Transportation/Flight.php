<?php

namespace EriSitohang\TripSorter\Transportation;


class Flight extends AbstractTransportation
{
    const NAME = 'flight';
    const BAGGAGE_AUTOMATICALLY_TRANSFERRED = ' Baggage will we automatically transferred from your last leg.';
    const BAGGAGE_DROP_AT_COUNTER = ' Baggage drop at ticket counter %s.';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }

    public function __toString()
    {
        $result = sprintf(
            'From %s, take %s %s to %s.',
            $this->getDeparture(),
            $this->getName(),
            $this->getNumber(),
            $this->getArrival()
        );

        if ($this->getGate() && $this->getSeat()) {
            $result .= sprintf(' Gate %s, seat %s.', $this->getGate(), $this->getSeat());
        } else {
            $result .= static::NO_SEAT_ASSIGNMENT;
        }

        if ($this->getBaggageDropCounter()) {
            $result .= sprintf(self::BAGGAGE_DROP_AT_COUNTER, $this->getBaggageDropCounter());
        } elseif ($this->isAutoBaggage()) {
            $result .= sprintf(self::BAGGAGE_AUTOMATICALLY_TRANSFERRED);
        }

        $result = (string)str_replace('  ', ' ', $result);

        return $result;
    }
}
