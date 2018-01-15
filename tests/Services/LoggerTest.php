<?php

namespace Smcrow\SlackLog\Services\Tests;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Notification;
use Smcrow\SlackLog\Constants\LogLevel;
use Smcrow\SlackLog\Exceptions\WebhookNotDefined;
use Smcrow\SlackLog\Messages\Debug;
use Smcrow\SlackLog\Messages\Error;
use Smcrow\SlackLog\Messages\Info;
use Smcrow\SlackLog\Messages\Trace;
use Smcrow\SlackLog\Messages\Warn;
use Smcrow\SlackLog\Notifiables\Channel;
use Smcrow\SlackLog\Notifications\LogMessageRequested;
use Smcrow\SlackLog\Services\Logger;
use Tests\TestCase;

class LoggerTest extends TestCase
{
    /**
     * @var Logger $logger
     */
    private $logger;

    const DUMMY_URL = 'http://example.org';
    const DUMMY_CHANNEL = '#example';

    public function setUp()
    {
        parent::setUp();
        $this->logger = app(Logger::class);
    }

    public function testAllLogLevelsDisabledWhenLogLevelIsNone()
    {
        $this->setLogLevel(LogLevel::NONE);
        $this->assertFalse($this->logger->isErrorEnabled());
        $this->assertFalse($this->logger->isWarnEnabled());
        $this->assertFalse($this->logger->isInfoEnabled());
        $this->assertFalse($this->logger->isTraceEnabled());
        $this->assertFalse($this->logger->isDebugEnabled());
    }

    public function testErrorLogLevelIsEnabledWhenLogLevelIsError()
    {
        $this->setLogLevel(LogLevel::ERROR);
        $this->assertTrue($this->logger->isErrorEnabled());
        $this->assertFalse($this->logger->isWarnEnabled());
        $this->assertFalse($this->logger->isInfoEnabled());
        $this->assertFalse($this->logger->isTraceEnabled());
        $this->assertFalse($this->logger->isDebugEnabled());
    }

    public function testErrorAndWarnLogLevelsAreEnabledWhenLogLevelIsWarn()
    {
        $this->setLogLevel(LogLevel::WARN);
        $this->assertTrue($this->logger->isErrorEnabled());
        $this->assertTrue($this->logger->isWarnEnabled());
        $this->assertFalse($this->logger->isInfoEnabled());
        $this->assertFalse($this->logger->isTraceEnabled());
        $this->assertFalse($this->logger->isDebugEnabled());
    }

    public function testErrorAndWarnAndInfoLogLevelsAreEnabledWhenLogLevelIsInfo()
    {
        $this->setLogLevel(LogLevel::INFO);
        $this->assertTrue($this->logger->isErrorEnabled());
        $this->assertTrue($this->logger->isWarnEnabled());
        $this->assertTrue($this->logger->isInfoEnabled());
        $this->assertFalse($this->logger->isTraceEnabled());
        $this->assertFalse($this->logger->isDebugEnabled());
    }

    public function testErrorAndWarnAndInfoAndTraceLogLevelsAreEnabledWhenLogLevelIsTrace()
    {
        $this->setLogLevel(LogLevel::TRACE);
        $this->assertTrue($this->logger->isErrorEnabled());
        $this->assertTrue($this->logger->isWarnEnabled());
        $this->assertTrue($this->logger->isInfoEnabled());
        $this->assertTrue($this->logger->isTraceEnabled());
        $this->assertFalse($this->logger->isDebugEnabled());
    }

    public function testAllLogLevelsAreEnabledWhenLogLevelIsDebug()
    {
        $this->setLogLevel(LogLevel::DEBUG);
        $this->assertTrue($this->logger->isErrorEnabled());
        $this->assertTrue($this->logger->isWarnEnabled());
        $this->assertTrue($this->logger->isInfoEnabled());
        $this->assertTrue($this->logger->isTraceEnabled());
        $this->assertTrue($this->logger->isDebugEnabled());
    }

    public function testAnExceptionIsThrownWhenNoWebhookUrlIsDefined()
    {
        Config::set('slack-log.webhook-url');
        $this->setLogLevel(LogLevel::ERROR);

        $this->expectException(WebhookNotDefined::class);
        $this->logger->error('test');
    }

    public function testErrorTriggersBuildsErrorNotification()
    {
        Notification::fake();
        Config::set('slack-log.webhook-url', self::DUMMY_URL);
        $this->setLogLevel(LogLevel::ERROR);

        $this->notificationShouldReceive(Error::class);
        $this->logger->error('test', self::DUMMY_CHANNEL);
    }

    public function testWarnTriggersBuildsWarnNotification()
    {
        Notification::fake();
        Config::set('slack-log.webhook-url', self::DUMMY_URL);
        $this->setLogLevel(LogLevel::WARN);

        $this->notificationShouldReceive(Warn::class);
        $this->logger->warn('test', self::DUMMY_CHANNEL);
    }

    public function testInfoTriggersBuildsInfoNotification()
    {
        Notification::fake();
        Config::set('slack-log.webhook-url', self::DUMMY_URL);
        $this->setLogLevel(LogLevel::INFO);

        $this->notificationShouldReceive(Info::class);
        $this->logger->info('test', self::DUMMY_CHANNEL);
    }

    public function testTraceTriggersBuildsTraceNotification()
    {
        Notification::fake();
        Config::set('slack-log.webhook-url', self::DUMMY_URL);
        $this->setLogLevel(LogLevel::TRACE);

        $this->notificationShouldReceive(Trace::class);
        $this->logger->trace('test', self::DUMMY_CHANNEL);
    }

    public function testDebugTriggersBuildsDebugNotification()
    {
        Notification::fake();
        Config::set('slack-log.webhook-url', self::DUMMY_URL);
        $this->setLogLevel(LogLevel::DEBUG);

        $this->notificationShouldReceive(Debug::class);
        $this->logger->debug('test', self::DUMMY_CHANNEL);
    }

    private function notificationShouldReceive(string $logInstance): void
    {
        Notification::shouldReceive('send')
            ->once()
            ->withArgs(function (Channel $channel, LogMessageRequested $notification) use ($logInstance) {
                $this->assertEquals(self::DUMMY_CHANNEL, $channel->getName());

                $log = $notification->toSlack($channel);
                $this->assertInstanceOf($logInstance, $log);

                return true;
            });
    }

    private function setLogLevel(int $logLevel): void
    {
        Config::set('slack-log.log-level', $logLevel);
    }
}
