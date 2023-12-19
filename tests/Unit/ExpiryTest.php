<?php

namespace Tests\Unit;

use DTApi\Helpers\TeHelper;
use PHPUnit\Framework\TestCase;

class ExpiryTest extends TestCase
{
    public function it_calculates_expire_at()
    {
        $dueTime = '2024-01-01 12:00:00';
        $createdAt = '2023-10-31 12:00:00';

        $result = TeHelper::willExpireAt($dueTime, $createdAt);

        $this->assertEquals('2024-01-01 12:00:00', $result);
    }
}
