<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\OrganisationUnitConfig;

class OrganisationUnitConfigTest extends TestCase {
    
    /**
    * @test
    */
    public function it_can_return_if_fixed_membership_fee()
    {
        $hasFixedMembershipFee = false;
        $config = new OrganisationUnitConfig($hasFixedMembershipFee);

        $this->assertEquals($hasFixedMembershipFee, $config->isFixedMembershipFee());
    }

    /**
    * @test
    */
    public function it_can_return_fixed_membership_fee()
    {
        $hasFixedMembershipFee = true;
        $fixedFee = 25000;
        $config = new OrganisationUnitConfig($hasFixedMembershipFee, $fixedFee);

        $this->assertEquals($fixedFee, $config->getFixedFee());
    }
}

