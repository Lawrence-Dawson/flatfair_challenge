<?php

namespace Tests\Unit;

use Mockery;
use App\FeeCalculator;
use App\OrganisationUnit;
use App\OrganisationUnitConfig;
use PHPUnit\Framework\TestCase;

class FeeCalculatorTest extends TestCase {
    
    /**
    * @test
    */
    public function it_can_calculate_weekly_period_fee()
    {
        $calculator = new FeeCalculator();
        $organisationUnit = Mockery::mock(OrganisationUnit::class);
        
        $period = 'weekly';
        $rentAmount = 3000;

        $fee = $calculator->calculateMembershipFee($rentAmount, $period, $organisationUnit);
  
        $percentage = 20.0;
        $expected = $rentAmount + $rentAmount*($percentage/100);

        $this->assertEquals($expected, $fee);
    }

    /**
    * @test
    */
    public function it_can_calculate_monthly_period_fee()
    {
        $calculator = new FeeCalculator();
        $organisationUnit = Mockery::mock(OrganisationUnit::class);
        
        $period = 'monthly';
        $rentAmount = 15000;

        $fee = $calculator->calculateMembershipFee($rentAmount, $period, $organisationUnit);
        
        $weeklyCost = $rentAmount * 12 / 52;
        $percentage = 20;
        $expected = floor($weeklyCost + $weeklyCost*($percentage/100));
       
        $this->assertEquals($expected, $fee);
    }
}

