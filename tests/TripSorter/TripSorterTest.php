<?php

namespace EriSitohang\TripSorter\Test;


use EriSitohang\TripSorter\Transportation\Flight;
use EriSitohang\TripSorter\Transportation\AirportBus;
use EriSitohang\TripSorter\Transportation\Train;
use EriSitohang\TripSorter\TripSorter;
use PHPUnit\Framework\TestCase;

class TripSorterTest  extends TestCase
{
    public function testSorter(): void
    {
        $trip = new TripSorter();

        $train = (new Train('Madrid', 'Barcelona'))
            ->setNumber('78A')
            ->setSeat('45B');
        $trip->addBoardingCard($train);

        $airportBus = new AirportBus('Barcelona', 'Gerona Airport');
        $trip->addBoardingCard($airportBus);

        $flight = (new Flight('Gerona Airport', 'Stockholm'))
            ->setNumber('SK455')
            ->setGate('45B')
            ->setSeat('3A')
            ->setBaggageDropCounter('344');
        $trip->addBoardingCard($flight);

        $flight = (new Flight('Stockholm', 'New York JFK'))
            ->setNumber('SK22')
            ->setGate('22')
            ->setSeat('7B')
            ->setAutoBaggage(true);
         $trip->addBoardingCard($flight);

        $trip->sorter();
        $actual = $trip->getResult();

        $excepted = "1. Take train 78A from Madrid to Barcelona. Sit in seat 45B.\n";
        $excepted .= "2. Take the airport bus from Barcelona to Gerona Airport. No seat assignment.\n";
        $excepted .= "3. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.\n";
        $excepted .= "4. From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.\n";
        $excepted .= "5. You have arrived at your final destination.";

        $this->assertEquals($excepted, $actual);
    }
}
