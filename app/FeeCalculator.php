<?php

namespace App;

use App\OrganisationUnit;

class FeeCalculator 
{
    const MIN_FEE = 14400;
    const PERIOD_RULES = [
        'weekly' => [
            'min' => 2500,
            'max' => 200000,
        ],
        'monthly' => [
            'min' => 11000,
            'max' => 866000,
        ],
    ];

    public function calculateMembershipFee(int $rentAmount, string $period, OrganisationUnit $unit)
    {
        $this->validateRentAmount($rentAmount, $period);
        $unitConfig = $unit->getConfig();
        
        if ($fixedFee = $unitConfig->isFixedFee()) {
            return $fixedFee;
        }

	    $weeksRent = $this->calculateWeeksRent($rentAmount, $period);
        $fee = $this->addTax($weeksRent);

        if ($fee > self::MIN_FEE) {
            return $fee;
        }
    
	    return self::MIN_FEE;
    }

    public function validateRentAmount(int $rentAmount, string $period)
    {
        $rules = self::PERIOD_RULES[$period];
        
        if ($rentAmount < $rules['min']) {
            throw new \Exception("Invalid rent amount, it must be above " . $rules['min']);
        }

        if ($rentAmount > $rules['max']) {
            throw new \Exception("Invalid rent amount, it must be below " . $rules['max']);
        }
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