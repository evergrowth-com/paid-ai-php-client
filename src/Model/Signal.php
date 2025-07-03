<?php

declare(strict_types=1);

namespace Evergrowth\PaidAiPhpClient\Model;

final readonly class Signal
{
    public function __construct(
        private string $eventName,
        private string $agentId,
        private string $customerId,
        private array $data,
    ) {
    }

    public static function fromAgent(
        AgentEnum $agent,
        string $customerId,
        array $data,
    ): Signal {
        return new self(
            eventName: $agent->getEventName(),
            agentId: $agent->getAgentId(),
            customerId: $customerId,
            data: $data,
        );
    }

    /**
     * @return array{
     *     'event_name': string,
     *     'agent_id': string,
     *     'customer_id': string,
     *     'data': array
     * }
     */
    public function normalize(): array
    {
        return [
            'event_name' => $this->eventName,
            'agent_id' => $this->agentId,
            'customer_id' => $this->customerId,
            'data' => $this->data,
        ];
    }
}
