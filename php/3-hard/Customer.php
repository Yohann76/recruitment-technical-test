<?php

declare(strict_types=1);

namespace App;

class Customer
{
    // replace variables at the top of the file to respect conventions
    private $name;
    private $rentals = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental): void
    {
        $this->rentals[] = $rental;
    }

    public function getName(): string
    {
        return $this->name;
    }

    // in this function, I moved the logic into two other functions to make it less complex
    public function statement(): string
    {
        $totalAmount = 0.0;
        $frequentRenterPoints = 0;
        $result = "Rental Record for " . $this->getName() . "\n";

        foreach ($this->rentals as $rental) {
            $thisAmount = $this->calculateAmount($rental);
            $frequentRenterPoints += $this->calculateFrequentRenterPoints($rental);

            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . number_format($thisAmount, 1) . "\n";
            $totalAmount += $thisAmount;
        }

        $result .= "You owed " . number_format($totalAmount, 1) . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points\n";

        return $result;
    }

    // added this function to move initial logic
    private function calculateAmount(Rental $rental): float
    {
        $amount = 0.0;

        switch ($rental->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $amount += 2;
                if ($rental->getDaysRented() > 2) {
                    $amount += ($rental->getDaysRented() - 2) * 1.5;
                }
                break;

            case Movie::NEW_RELEASE:
                $amount += $rental->getDaysRented() * 3;
                break;

            case Movie::CHILDREN:
                $amount += 1.5;
                if ($rental->getDaysRented() > 3) {
                    $amount += ($rental->getDaysRented() - 3) * 1.5;
                }
                break;
        }

        return $amount;
    }

    // added this function to move initial logic
    private function calculateFrequentRenterPoints(Rental $rental): int
    {
        $frequentRenterPoints = 1;

        if ($rental->getMovie()->getPriceCode() == Movie::NEW_RELEASE && $rental->getDaysRented() > 1) {
            $frequentRenterPoints++;
        }

        return $frequentRenterPoints;
    }
}