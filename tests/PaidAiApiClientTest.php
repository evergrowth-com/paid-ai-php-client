<?php

declare(strict_types=1);

namespace Evergrowth\PaidAiPhpClientTests;

use Evergrowth\PaidAiPhpClient\Exception\PaidAiPhpClientException;
use Evergrowth\PaidAiPhpClient\Model\AgentEnum;
use Evergrowth\PaidAiPhpClient\Model\Signal;
use Evergrowth\PaidAiPhpClient\PaidAiApiClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class PaidAiApiClientTest extends TestCase
{
    public function testFlushSuccessfully(): void
    {
        $client = new PaidAiApiClient(
            new MockHttpClient(
                [
                    function (string $method, string $url, array $options): MockResponse {
                        self::assertSame('POST', $method);
                        self::assertSame('https://api.agentpaid.io/api/entries/bulk', $url);
                        self::assertContains('Authorization: Bearer secret-api-key', $options['headers']);
                        self::assertContains('Accept: application/json', $options['headers']);
                        self::assertSame(
                            \json_encode(
                                [
                                    'transactions' => [
                                        [
                                            'event_name' => 'generated_account_plan',
                                            'agent_id' => '688d22c8-0b70-4bb5-99fb-34863394e749',
                                            'customer_id' => 'customerId',
                                            'data' => ['some' => 'data'],
                                        ],
                                        [
                                            'event_name' => 'generated_digital_twin',
                                            'agent_id' => 'f5ba9064-c2d1-49b5-960a-057c4c0d6a47',
                                            'customer_id' => 'customerId2',
                                            'data' => ['some' => 'data', '42'],
                                        ],
                                    ],
                                ],
                                \JSON_THROW_ON_ERROR,
                            ),
                            $options['body'],
                        );

                        return new MockResponse();
                    },
                ],
            ),
            'secret-api-key',
        );

        $client->flush(
            [
                2 => Signal::fromAgent(AgentEnum::ACCOUNT_PLANNING, 'customerId', ['some' => 'data']),
                4 => Signal::fromAgent(AgentEnum::DIGITAL_TWIN, 'customerId2', ['some' => 'data', '42']),
            ],
        );
    }

    public function testFlushInvalidResponseCode(): void
    {
        $client = new PaidAiApiClient(
            new MockHttpClient(
                [
                    function (string $method, string $url, array $options): MockResponse {
                        self::assertSame('POST', $method);
                        self::assertSame('https://api.agentpaid.io/api/entries/bulk', $url);
                        self::assertContains('Authorization: Bearer secret-api-key', $options['headers']);
                        self::assertContains('Accept: application/json', $options['headers']);
                        self::assertSame(
                            \json_encode(
                                [
                                    'transactions' => [
                                        [
                                            'event_name' => 'contact_found',
                                            'agent_id' => 'ff0bc8c3-d54c-463b-860d-891c94f6454f',
                                            'customer_id' => 'customerId3',
                                            'data' => [],
                                        ],
                                    ],
                                ],
                                \JSON_THROW_ON_ERROR,
                            ),
                            $options['body'],
                        );

                        return new MockResponse('', ['http_code' => 500]);
                    },
                ],
            ),
            'secret-api-key',
        );

        $this->expectExceptionObject(new PaidAiPhpClientException('Paid.ai API: invalid response status code - 500'));

        $client->flush([Signal::fromAgent(AgentEnum::CONTACT_FINDER, 'customerId3', [])]);
    }
}
