<?php

namespace Tests\Unit;

use Mockery;
use App\OrganisationUnit;
use App\OrganisationUnitConfig;
use PHPUnit\Framework\TestCase;

class OrganisationUnitTest extends TestCase {
    
    /**
    * @test
    */
    public function it_can_get_organisation_config()
    {
        $config = Mockery::mock(OrganisationUnitConfig::class);

        $unit = new OrganisationUnit($config);
        
        $this->assertEquals($config, $unit->getConfig());
    }
}

