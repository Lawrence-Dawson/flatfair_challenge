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
        $isFixedFee = false;
        $fixedFee = 0;

        $config = new OrganisationUnitConfig($isFixedFee, $fixedFee);

        $this->assertEquals($isFixedFee, $config->isFixedFee());
    }

    /**
    * @test
    */
    public function it_can_return_fixed_membership_fee()
    {
        $isFixedFee = true;
        $fixedFee = 25000;
        
        $config = new OrganisationUnitConfig($isFixedFee, $fixedFee);

        $this->assertEquals($fixedFee, $config->getFixedFee());
    }
}

