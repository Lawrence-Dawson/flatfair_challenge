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
}

