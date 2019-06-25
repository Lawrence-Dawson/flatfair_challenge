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
    public function it_can_get_organisation_unit_name()
    {
        $config = Mockery::mock(OrganisationUnitConfig::class);
        $name = 'branch';

        $unit = new OrganisationUnit($name, $config);
        
        $this->assertEquals($name, $unit->getName());
    }

    /**
    * @test
    */
    public function it_can_get_organisation_unit_config()
    {
        $config = Mockery::mock(OrganisationUnitConfig::class);
        $name = 'branch';
        
        $unit = new OrganisationUnit($name, $config);
        
        $this->assertEquals($config, $unit->getConfig());
    }

    /**
    * @test
    */
    public function it_can_get_organisation_unit_parent()
    {
        $config = Mockery::mock(OrganisationUnitConfig::class);
        $name = 'branch';

        $parent = Mockery::mock(OrganisationUnit::class);

        $unit = new OrganisationUnit($name, $config);

        $unit->setParent($parent);
        
        $this->assertEquals($parent, $unit->getParent());
    }

    /**
    * @test
    */
    public function it_gets_parents_config_when_none_present()
    {
        $config = Mockery::mock(OrganisationUnitConfig::class);
        $name = 'branch';

        $parent = Mockery::mock(OrganisationUnit::class);

        $parent->expects()
            ->getConfig()
            ->andReturns($config);

        $unit = new OrganisationUnit($name);

        $unit->setParent($parent);
        
        $this->assertEquals($config, $unit->getConfig());
    }
}

