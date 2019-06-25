<?php

namespace App;

use App\OrganisationUnit;

class FeeCalculator 
{
    private $minFee;

    public function __construct(int $minFee)
    {
        $this->minFee = $minFee;
    }

    public function calculateMembershipFee(int $rentAmount, string $period, OrganisationUnit $unit)
    {
	    $weeksRent = $this->calculateWeeksRent($rentAmount, $period);
        $fee = $this->addTax($weeksRent);

        if ($fee > $this->minFee) {
            return $fee;
        }
    
	    return $this->minFee;
    }

    private function calculateWeeksRent(int $rentAmount, string $period): int
    {
        if($period == 'weekly') {
            return $rentAmount;
        }
        
        return $rentAmount * 12 / 52;
    }

    private function addTax(int $weeksRent): int
    {
        $percentage = 20.0;
        $weeksRent += $weeksRent*($percentage/100);

        return $weeksRent;
    }
}