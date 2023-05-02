<?php

declare(strict_types=1);

namespace App\Shared;

interface QueryBusInterface
{
    /** @return mixed */
    public function handle(QueryInterface $query);
}