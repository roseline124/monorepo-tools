<?php

namespace SS6\ShopBundle\Tests\Model\Product\Availability;

use PHPUnit_Framework_TestCase;
use SS6\ShopBundle\Model\Product\Availability\Availability;
use SS6\ShopBundle\Model\Product\Availability\AvailabilityData;
use SS6\ShopBundle\Model\Product\Availability\AvailabilityService;

class AvailabilityServiceTest extends PHPUnit_Framework_TestCase {

	public function testCreate() {
		$availabilityService = new AvailabilityService();

		$availabilityDataOriginal = new AvailabilityData('availabilityName');
		$availability = $availabilityService->create($availabilityDataOriginal);

		$availabilityDataNew = new AvailabilityData();
		$availabilityDataNew->setFromEntity($availability);

		$this->assertEquals($availabilityDataOriginal, $availabilityDataNew);
	}

	public function testEdit() {
		$availabilityService = new AvailabilityService();

		$availabilityDataOld = new AvailabilityData('oldAvailabilityName');
		$availabilityDataEdit = new AvailabilityData('editAvailabilityName');
		$availability = new Availability($availabilityDataOld);

		$availabilityService->edit($availability, $availabilityDataEdit);

		$availabilityDataNew = new AvailabilityData();
		$availabilityDataNew->setFromEntity($availability);

		$this->assertEquals($availabilityDataEdit, $availabilityDataNew);
	}

}
