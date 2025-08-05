# Evergrowth Paid.ai php client

----------

## Installation

Run: `composer require evergrowth/paid-ai-php-client`

## Usage

Create a client using api key:
```php
<?php

use Evergrowth\PaidAiPhpClient\PaidAiApiClient;
use Evergrowth\PaidAiPhpClient\PaidAiApiClientInterface;

/** @var PaidAiApiClientInterface $client */
$client = PaidAiApiClient::new('secret-api-key');
```

Push the signals to paid.ai:
```php
<?php

use Evergrowth\PaidAiPhpClient\Model\Signal;

$signals = [
    new Signal('event1', 'agent1', 'customerX', ['additional metadata']),
    new Signal('event2', 'agent2', 'customerX', ['additional metadata']),
];
$client->flush($signals);
```

Pushing signals with predefined agents:
```php
<?php

use Evergrowth\PaidAiPhpClient\Model\Signal;
use Evergrowth\PaidAiPhpClient\Model\AgentEnum;

$signals = [
    Signal::fromAgent(
        AgentEnum::ACCOUNT_QUALIFICATION,
        'customerX',
        ['additional metadata'],
    ),
];
$client->flush($signals);
```
