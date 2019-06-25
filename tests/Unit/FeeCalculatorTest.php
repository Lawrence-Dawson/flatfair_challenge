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
        $rentAmount = 12000;

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
        $rentAmount = 52000;

        $fee = $calculator->calculateMembershipFee($rentAmount, $period, $organisationUnit);
        
        $weeklyCost = $rentAmount * 12 / 52;
        $percentage = 20;
        $expected = floor($weeklyCost + $weeklyCost*($percentage/100));
       
        $this->assertEquals($expected, $fee);
    }

    /**
    * @test
    */
    public function it_will_use_minimun_fee_when_fee_calculated_to_below_minimun()
    {
        $minimumFee = 14400;
        $calculator = new FeeCalculator();
        $organisationUnit = Mockery::mock(OrganisationUnit::class);
        
        $period = 'weekly';
        $rentAmount = 11520;

        $fee = $calculator->calculateMembershipFee($rentAmount, $period, $organisationUnit);
        
        $this->assertEquals($minimumFee, $fee);
    }

    /**
    * @test
    */
    public function it_will_throw_exception_when_weekly_rent_amount_too_small()
    {
        $calculator = new FeeCalculator();
        $organisationUnit = Mockery::mock(OrganisationUnit::class);
        
        $period = 'weekly';
        $rentAmount = 2499;

        $this->expectExceptionMessage('Invalid rent amount, it must be above 2500');

        $fee = $calculator->calculateMembershipFee($rentAmount, $period, $organisationUnit);
    }
}

