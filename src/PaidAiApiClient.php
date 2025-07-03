<?php

declare(strict_types=1);

namespace Evergrowth\PaidAiPhpClient;

use Evergrowth\PaidAiPhpClient\Exception\PaidAiPhpClientException;
use Evergrowth\PaidAiPhpClient\Model\Signal;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class PaidAiApiClient implements PaidAiApiClientInterface
{
    private const string DEFAULT_URL = 'https://api.agentpaid.io';

    /**
     * @param non-empty-string $apiKey
     * @param non-empty-string $url
     */
    public function __construct(
        private HttpClientInterface $httpClient,
        private string $apiKey,
        private string $url = self::DEFAULT_URL,
    ) {
    }

    /**
     * @param non-empty-string $apiKey
     */
    public static function new(string $apiKey): PaidAiApiClient
    {
        return new self(HttpCLient::create(), $apiKey);
    }

    /**
     * {@inheritdoc}
     */
    public function flush(array $signals): void
    {
        try {
            $response = $this->httpClient->request(
                'POST',
                \sprintf('%s/api/entries/bulk', \rtrim($this->url, '/')),
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'transactions' => \array_values(
                            \array_map(
                                static function (Signal $signal): array {
                                    return $signal->normalize();
                                },
                                $signals,
                            ),
                        ),
                    ],
                    'timeout' => 10.0,
                ],
            );

            $statusCode = $response->getStatusCode();
            if ($statusCode < 200 || $statusCode > 299) {
                throw new PaidAiPhpClientException(
                    \sprintf('Paid.ai API: invalid response status code - %d', $statusCode),
                );
            }
        } catch (ExceptionInterface $e) {
            throw new PaidAiPhpClientException(
                \sprintf('Paid.ai API: %s', $e->getMessage()),
                0,
                $e,
            );
        }
    }
}
