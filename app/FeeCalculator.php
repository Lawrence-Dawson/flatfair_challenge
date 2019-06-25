<?php

namespace App;

use App\OrganisationUnit;

class FeeCalculator {

    public function calculateMembershipFee(int $rentAmount, string $period, OrganisationUnit $unit)
    {
	    $weeksRent = $this->calculateWeeksRent($rentAmount);
	    $fee = $this->addTax($weeksRent);
	
	    return $fee;
    }

    private function calculateWeeksRent(int $rentAmount): int
    {
        return $rentAmount;
    }

    private function addTax(int $weeksRent): int
    {
        $percentage = 20.0;
        $weeksRent += $weeksRent*($percentage/100);
        
        return $weeksRent;
    }
}