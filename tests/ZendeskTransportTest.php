<?php

namespace Musement\Notifier\Bridge\Zendesk\Tests;

use Musement\Notifier\Bridge\Zendesk\ZendeskOptions;
use Musement\Notifier\Bridge\Zendesk\ZendeskTransport;
use Symfony\Component\Notifier\Message\ChatMessage;
use Symfony\Component\Notifier\Message\MessageInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\Test\TransportTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class ZendeskTransportTest extends TransportTestCase
{
    public function createTransport(HttpClientInterface $client = null): ZendeskTransport
    {
        return (new ZendeskTransport('testEmail', 'testToken', $client ?? $this->createMock(HttpClientInterface::class)))->setHost('test.zendesk.com');
    }

    public function toStringProvider(): iterable
    {
        yield ['zendesk://test.zendesk.com', $this->createTransport()];
    }

    public function supportedMessagesProvider(): iterable
    {
        yield [new ChatMessage('Hello!')];
        yield [new ChatMessage('Hello!', new ZendeskOptions('urgent'))];
    }

    public function unsupportedMessagesProvider(): iterable
    {
        yield [new SmsMessage('0611223344', 'Hello!')];
        yield [$this->createMock(MessageInterface::class)];
    }
}
