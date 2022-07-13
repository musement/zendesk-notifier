<?php

namespace Musement\Notifier\Bridge\Zendesk;

use Symfony\Component\Notifier\Message\MessageOptionsInterface;

/**
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
final class ZendeskOptions implements MessageOptionsInterface
{
    private ?string $priority;

    public function __construct(string $priority = null)
    {
        $this->priority = $priority;
    }

    public function toArray(): array
    {
        return [
            'priority' => $this->priority,
        ];
    }

    public function getRecipientId(): ?string
    {
        return null;
    }

    /**
     * @return $this
     */
    public function priority(string $priority): ZendeskOptions
    {
        $this->priority = $priority;

        return $this;
    }
}
