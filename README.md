##  EriSitohang\TripSorter
Backend Test: TRIP SORTER

## Goals
You are given a stack of boarding cards for various transportations that will take you from a point A to point B via several stops on the way.
All of the boarding cards are out of order and you don't know where your journey starts, nor where it ends.
Each boarding card contains information about seat assignment, and means of transportation (such as flight number, bus number etc).

This package lets you sort this kind of list and present back a description of how to complete your journey.

For instance the API should be able to take an unordered set of boarding cards, provided in a format defined by you, and produce this list:

1. Take train 78A from Madrid to Barcelona. Sit in seat 45B.
2. Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
3. From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A. Baggage drop at ticket counter 344.
4. From Stockholm, take flight SK22 to New York JFK. Gate 22, seat 7B. Baggage will we automatically transferred from your last leg.
5.  You have arrived at your final destination.


## Installation

Using Composer :

```
composer install
```

If you don't have composer, you can get it from [Composer](https://getcomposer.org/)


## Tests
Run this command line to run the test

```
./vendor/phpunit/phpunit/phpunit --bootstrap tests/bootstrap.php tests
```

# Code Structure
```
├── src
│   └── TripSorter
│       ├── Exception
│       │   └── TripSorterException.php
│       ├── Transportation
│       │   ├── AbstractTransportation.php
│       │   ├── AirportBus.php
│       │   ├── Bus.php
│       │   ├── Flight.php
│       │   ├── InterfaceTransportation.php
│       │   └── Train.php
│       └── TripSorter.php
└── tests
    ├── bootstrap.php
    ├── phpunit.xml
    └── TripSorter
        └── TripSorterTest.php
```

## Usage

```php
<?php
use EriSitohang\TripSorter\Transportation\Flight;
use EriSitohang\TripSorter\Transportation\AirportBus;
use EriSitohang\TripSorter\Transportation\Train;
use EriSitohang\TripSorter\TripSorter;

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

print $trip->getResult();
```