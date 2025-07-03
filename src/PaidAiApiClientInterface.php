<?php

declare(strict_types=1);

namespace Evergrowth\PaidAiPhpClient;

use Evergrowth\PaidAiPhpClient\Exception\PaidAiPhpClientException;
use Evergrowth\PaidAiPhpClient\Model\Signal;

interface PaidAiApiClientInterface
{
    /**
     * @param non-empty-array<Signal> $signals
     * @throws PaidAiPhpClientException
     */
    public function flush(array $signals): void;
}
