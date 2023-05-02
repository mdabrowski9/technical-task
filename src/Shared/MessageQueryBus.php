<?php

declare(strict_types=1);

namespace App\Shared;

use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessageQueryBus implements QueryBusInterface
{
    use HandleTrait {
        handle as handleQuery;
    }

    public function __construct(
        MessageBusInterface $queryBus,
    ) {
        $this->messageBus = $queryBus;
    }

    /** @return mixed */
    public function handle(QueryInterface $query)
    {
        return $this->handleQuery($query);
    }
}