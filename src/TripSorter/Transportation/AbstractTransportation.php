<?php

namespace EriSitohang\TripSorter\Transportation;


abstract class AbstractTransportation implements InterfaceTransportation
{
    const NO_SEAT_ASSIGNMENT = " No seat assignment.";
    const SIT_IN_SEAT = " Sit in seat ";
    const TAKE_FROM_TO = 'Take %s %s from %s to %s.';

    /**
     * @var string
     */
    private $departure;

    /**
     * @var string
     */
    private $arrival;

    /**
     * @var string
     */
    private $number;

    /**
     * @var string
     */
    private $seat;

    /**
     * @var string
     */
    private $gate;

    /**
     * @var string
     */
    private $baggageDropCounter;

    private $autoBaggage = false;

    /**
     * @var AbstractTransportation
     */
    private $previous;

    /**
     * @var AbstractTransportation
     */
    private $next;

    /**
     * AbstractTransportation constructor.
     * @param string $departure
     * @param string $arrival
     *
     * @return $this
     */

    public function __construct(string $departure, string $arrival)
    {
        $this->departure = trim($departure);
        $this->arrival = trim($arrival);

        return $this;
    }

    /**
     * @return string
     */
    public function getDeparture(): string
    {
        return $this->departure;
    }

    /**
     * @return string
     */
    public function getArrival(): string
    {
        return $this->arrival;
    }

    /**
     * @return string
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return AbstractTransportation
     */
    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeat(): ?string
    {
        return $this->seat;
    }

    /**
     * @param string $seat
     * @return AbstractTransportation
     */
    public function setSeat(string $seat): self
    {
        $this->seat = $seat;

        return $this;
    }

    /**
     * @return string
     */
    public function getGate(): string
    {
        return $this->gate;
    }

    /**
     * @param string $gate
     * @return AbstractTransportation
     */
    public function setGate(string $gate): self
    {
        $this->gate = $gate;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAutoBaggage(): bool
    {
        return $this->autoBaggage;
    }

    /**
     * @param bool $autoBaggage
     * @return $this
     */
    public function setAutoBaggage(bool $autoBaggage): self
    {
        $this->autoBaggage = $autoBaggage;

        return $this;
    }

    /**
     * @return string
     */
    public function getBaggageDropCounter(): ?string
    {
        return $this->baggageDropCounter;
    }

    /**
     * @param string $baggageDropCounter
     * @return $this
     */
    public function setBaggageDropCounter(string $baggageDropCounter): self
    {
        $this->baggageDropCounter = $baggageDropCounter;

        return $this;
    }

    /**
     * @param AbstractTransportation $previous
     */
    public function setPrevious(AbstractTransportation $previous): void
    {
        $this->previous = $previous;
    }

    /**
     * @param AbstractTransportation $next
     */
    public function setNext(AbstractTransportation $next)
    {
        $this->next = $next;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $result = sprintf(
            self::TAKE_FROM_TO,
            $this->getName(),
            $this->getNumber(),
            $this->getDeparture(),
            $this->getArrival()
        );

        if ($this->getSeat()) {
            $result .= self::SIT_IN_SEAT . "{$this->getSeat()}.";
        } else {
            $result .= self::NO_SEAT_ASSIGNMENT;
        }

        return (string)str_replace("  ", " ", $result);
    }
}
