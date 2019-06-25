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
        if($rentAmount == 'weekly') {
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