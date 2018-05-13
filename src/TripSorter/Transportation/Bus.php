<?php

namespace EriSitohang\TripSorter\Transportation;


class Bus extends AbstractTransportation
{
    const NAME = 'bus';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }
}
