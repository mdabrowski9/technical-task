<?php

declare(strict_types=1);

namespace App\Tests\GeoCode\Infrastructure\Factory;

use App\GeoCode\Domain\Entity\ResolvedAddress;
use App\GeoCode\Domain\ValueObject\Coordinates;
use App\GeoCode\Infrastructure\Factory\CoordinatesFactory;
use App\Tests\AbstractUnitKernelTestCase;
use PHPUnit\Framework\MockObject\MockObject;

use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;

class CoordinatesFactoryTest extends AbstractUnitKernelTestCase
{
    private MockObject & ResolvedAddress $resolvedAddress;
    private MockObject & Coordinates $coordinates;
    private CoordinatesFactory $coordinatesFactory;
    protected function setUp(): void
    {
        parent::setUp();

        $this->resolvedAddress = $this->createMock(ResolvedAddress::class);
        $this->resolvedAddress->method('getLng')->willReturn('2.360417');
        $this->resolvedAddress->method('getLat')->willReturn('48.861221');
        $this->coordinatesFactory = new CoordinatesFactory();
    }

    public function testPrepareCoordinatesFromResolvedAddress(): void
    {
        $coordinates = $this->coordinatesFactory->prepareCoordinatesFromResolvedAddress($this->resolvedAddress);
        assertInstanceOf(Coordinates::class, $coordinates);
        assertEquals($this->resolvedAddress->getLng(), $coordinates->getLng());
        assertEquals($this->resolvedAddress->getLat(), $coordinates->getLat());
    }
}
