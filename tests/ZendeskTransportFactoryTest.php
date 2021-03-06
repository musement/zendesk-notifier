<?php

namespace Musement\Notifier\Bridge\Zendesk\Tests;

use Musement\Notifier\Bridge\Zendesk\ZendeskTransportFactory;
use Symfony\Component\Notifier\Test\TransportFactoryTestCase;

final class ZendeskTransportFactoryTest extends TransportFactoryTestCase
{
    public function createFactory(): ZendeskTransportFactory
    {
        return new ZendeskTransportFactory();
    }

    public function createProvider(): iterable
    {
        yield [
            'zendesk://subdomain.zendesk.com',
            'zendesk://email:token@subdomain.zendesk.com',
        ];
    }

    public function supportsProvider(): iterable
    {
        yield [true, 'zendesk://host'];
        yield [false, 'somethingElse://host'];
    }

    public function incompleteDsnProvider(): iterable
    {
        yield 'missing email or token' => ['zendesk://testOneOfEmailOrToken@host'];
        yield 'wrong host' => ['zendesk://testEmail:Token@host.com'];
    }

    public function unsupportedSchemeProvider(): iterable
    {
        yield ['somethingElse://email:token@host'];
    }
}
