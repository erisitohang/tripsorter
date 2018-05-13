<?php

namespace EriSitohang\TripSorter\Transportation;


class AirportBus extends AbstractTransportation
{
    const NAME = 'the airport bus';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }
}
