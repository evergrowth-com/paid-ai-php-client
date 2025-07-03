# Evergrowth Paid.ai php client

----------

## Installation

Add repository config to the application's composer.json file:

```json
{
    // ...
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/evergrowth-com/paid-ai-php-client"
        }
    ]
}
```

Run: `composer require evergrowth/paid-ai-php-client`

## Usage

Create a client using api key:
```php
<?php

use Evergrowth\PaidAiPhpClient\PaidAiApiClient;
use Evergrowth\PaidAiPhpClient\PaidAiApiClientInterface;

$client = PaidAiApiClient::new('secret-api-key');

assert($client instanceof PaidAiApiClientInterface);
```
