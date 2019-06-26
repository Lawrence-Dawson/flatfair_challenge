<?php

namespace Tests\Unit;

use Mockery;
use App\FeeCalculator;
use App\OrganisationUnit;
use App\OrganisationUnitConfig;
use PHPUnit\Framework\TestCase;

class MembershipFeeCalculationTest extends TestCase 
{
    private $structureConfig;

    public function setUp(): void
    {
        parent::setUp();

        $this->weekly = 'weekly';
        $this->monthly = 'monthly';

        $this->structureConfig = json_decode('[
            { "name": "client", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "division_a", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "division_b", "config": {"has_fixed_membership_fee": true, "fixed_membership_fee_amount": 35000} }, { "name": "area_a", "config": {"has_fixed_membership_fee": true, "fixed_membership_fee_amount": 45000} },
            { "name": "area_b", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "area_c", "config": {"has_fixed_membership_fee": true, "fixed_membership_fee_amount": 45000} },
            { "name": "area_d", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_a", "config": null },
            { "name": "branch_b", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_c", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_d", "config": null },
            { "name": "branch_e", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_f", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_g", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_h", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_i", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_j", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_k", "config": {"has_fixed_membership_fee": true, "fixed_membership_fee_amount": 25000} }, { "name": "branch_l", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_m", "config": null },
            { "name": "branch_n", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_o", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} },
            { "name": "branch_p", "config": {"has_fixed_membership_fee": false, "fixed_membership_fee_amount": 0} }
            ]', true);
    }

    public function buildOrganisation()
    {
        foreach ($this->structureConfig as $key => $value) {
            $config = new OrganisationUnitConfig($value['config']['has_fixed_membership_fee'], $value['config']['fixed_membership_fee_amount']);
            $this->{$value['name']} = new OrganisationUnit($value['name'], $config);
        }
        $this->branch_a->setParent($this->area_a)->setParent($this->division_a)->setParent($this->client);
        $this->branch_b->setParent($this->area_a)->setParent($this->division_a)->setParent($this->client);
        $this->branch_c->setParent($this->area_a)->setParent($this->division_a)->setParent($this->client);
        $this->branch_d->setParent($this->area_a)->setParent($this->division_a)->setParent($this->client);

        $this->branch_e->setParent($this->area_b)->setParent($this->division_a)->setParent($this->client);
        $this->branch_f->setParent($this->area_b)->setParent($this->division_a)->setParent($this->client);
        $this->branch_g->setParent($this->area_b)->setParent($this->division_a)->setParent($this->client);
        $this->branch_h->setParent($this->area_b)->setParent($this->division_a)->setParent($this->client);

        $this->branch_i->setParent($this->area_c)->setParent($this->division_b)->setParent($this->client);
        $this->branch_j->setParent($this->area_c)->setParent($this->division_b)->setParent($this->client);
        $this->branch_k->setParent($this->area_c)->setParent($this->division_b)->setParent($this->client);
        $this->branch_l->setParent($this->area_c)->setParent($this->division_b)->setParent($this->client);

        $this->branch_m->setParent($this->area_d)->setParent($this->division_b)->setParent($this->client);
        $this->branch_n->setParent($this->area_d)->setParent($this->division_b)->setParent($this->client);
        $this->branch_o->setParent($this->area_d)->setParent($this->division_b)->setParent($this->client);
        $this->branch_p->setParent($this->area_d)->setParent($this->division_b)->setParent($this->client);
    }

    /**
    * @test
    */
    public function it_can_calculate_weekly_period_fee()
    {
        $this->buildOrganisation();

        $calculator = new FeeCalculator();
        $rentAmount = 12000;

        $fee = $calculator->calculateMembershipFee($rentAmount, $this->weekly, $this->branch_e);
  
        $percentage = 20.0;
        $expected = $rentAmount + $rentAmount*($percentage/100);

        $this->assertEquals($expected, $fee);
    }

    /**
    * @test
    */
    public function it_can_calculate_monthly_period_fee()
    {
        $this->buildOrganisation();

        $calculator = new FeeCalculator();
        $rentAmount = 52000;

        $fee = $calculator->calculateMembershipFee($rentAmount, $this->monthly, $this->branch_e);
  
        $weeklyCost = $rentAmount * 12 / 52;
        $percentage = 20;
        $expected = floor($weeklyCost + $weeklyCost*($percentage/100));

        $this->assertEquals($expected, $fee);
    }

     /**
    * @test
    */
    public function it_can_calculate_weekly_period_fee_when_config_in_parent()
    {
        $this->buildOrganisation();

        $calculator = new FeeCalculator();
        $rentAmount = 12000;

        $fee = $calculator->calculateMembershipFee($rentAmount, $this->weekly, $this->branch_m);
  
        $percentage = 20.0;
        $expected = $rentAmount + $rentAmount*($percentage/100);

        $this->assertEquals($expected, $fee);
    }

     /**
    * @test
    */
    public function it_can_calculate_monthly_period_fee_when_config_in_parent()
    {
        $this->buildOrganisation();

        $calculator = new FeeCalculator();
        $rentAmount = 52000;

        $fee = $calculator->calculateMembershipFee($rentAmount, $this->monthly, $this->branch_m);
  
        $weeklyCost = $rentAmount * 12 / 52;
        $percentage = 20;
        $expected = floor($weeklyCost + $weeklyCost*($percentage/100));

        $this->assertEquals($expected, $fee);
    }
}

