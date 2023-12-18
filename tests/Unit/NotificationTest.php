<?php

use Pest\TestCase;
use Mockery;

class NotificationTest extends TestCase
{
    protected $userId;

    public function setUp(): void
    {
        $this->userId = 1;
    }

    /**
     * @test
     */
    public function it_checks_if_push_notification_should_be_sent()
    {
        $helperMock->shouldReceive('getUserMeta')
            ->with($this->userId, 'not_get_notification')
            ->andReturn(false);

        $notificationService = new NotificationService();

        $result = $notificationService->isNeedToSendPush($this->userId);
        $this->assertTrue($result);
    }
}

