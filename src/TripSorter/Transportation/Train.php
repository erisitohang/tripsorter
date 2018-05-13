<?php

namespace EriSitohang\TripSorter\Transportation;


class Train extends AbstractTransportation
{
    const NAME = 'train';

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::NAME;
    }
}
