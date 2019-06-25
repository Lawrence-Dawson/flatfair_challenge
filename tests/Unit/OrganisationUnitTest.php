<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\OrganisationUnitConfig;

class OrganisationUnitTest extends TestCase {
    
    /**
    * @test
    */
    public function it_can_get_organisation_config()
    {
        $config = $this->createMock(OrganisationUnitConfig::class);

        $unit = new OrganisationUnit($config);
        
        $this->assertEquals($config, $unit->getConfig());
    }
}

