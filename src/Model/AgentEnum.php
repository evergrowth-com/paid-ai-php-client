<?php

declare(strict_types=1);

namespace Evergrowth\PaidAiPhpClient\Model;

enum AgentEnum
{
    case ACCOUNT_PLANNING;
    case ACCOUNT_QUALIFICATION;
    case ACCOUNT_RESEARCH_CHAT_GPT_41;
    case ACCOUNT_RESEARCH_CHAT_GPT_41_MINI;
    case ACCOUNT_RESEARCH_CHAT_GPT_4o;
    case ACCOUNT_RESEARCH_CHAT_GPT_4o_MINI;
    case ACCOUNT_RESEARCH_GEMINI_25_PRO;
    case ACCOUNT_RESEARCH_SONAR_REASONING_PRO;
    case CONTACT_FINDER;
    case CONTACT_QUALIFICATION;
    case DIGITAL_TWIN;
    case DIGITAL_TWIN_CONVERSATION;
    case PHONE_EMAIL_FINDER;
    case PLAY_GENERATION;
    case PLAY_TEMPLATE_GENERATION;
    case ROLEPLAY;
    case ROLEPLAY_EVALUATION;

    /**
     * @return non-empty-string
     */
    public function getEventName(): string
    {
        return match ($this) {
            self::ACCOUNT_PLANNING => 'generated_account_plan',
            self::ACCOUNT_QUALIFICATION => 'qualified_account',
            self::ACCOUNT_RESEARCH_CHAT_GPT_41 => 'found_data_point_(chatgpt_4.1)',
            self::ACCOUNT_RESEARCH_CHAT_GPT_41_MINI => 'found_data_point_(chatgpt_4.1_mini)',
            self::ACCOUNT_RESEARCH_CHAT_GPT_4o => 'found_data_point_(chatgpt_4o)',
            self::ACCOUNT_RESEARCH_CHAT_GPT_4o_MINI => 'found_data_point_(chatgpt_4o_mini)',
            self::ACCOUNT_RESEARCH_GEMINI_25_PRO => 'found_data_point_(gemini_2.5_pro)',
            self::ACCOUNT_RESEARCH_SONAR_REASONING_PRO => 'found_data_point_(sonar_reasoning_pro)',
            self::CONTACT_FINDER => 'contact_found',
            self::CONTACT_QUALIFICATION => 'qualified_contact',
            self::DIGITAL_TWIN => 'generated_digital_twin',
            self::DIGITAL_TWIN_CONVERSATION => 'message_received',
            self::PHONE_EMAIL_FINDER => 'contact_enriched',
            self::PLAY_GENERATION => 'generated_play',
            self::PLAY_TEMPLATE_GENERATION => 'template_generated',
            self::ROLEPLAY => 'message_received',
            self::ROLEPLAY_EVALUATION => 'roleplay_evaluation_report',
        };
    }

    /**
     * @return non-empty-string
     */
    public function getAgentId(): string
    {
        return match ($this) {
            self::ACCOUNT_PLANNING => '688d22c8-0b70-4bb5-99fb-34863394e749',
            self::ACCOUNT_QUALIFICATION => '482cebb7-c8ea-4c25-8735-4d592e22713a',
            self::ACCOUNT_RESEARCH_CHAT_GPT_41 => '668f2f94-2552-4f6b-b10f-8a9f14371f69',
            self::ACCOUNT_RESEARCH_CHAT_GPT_41_MINI => '668f2f94-2552-4f6b-b10f-8a9f14371f69',
            self::ACCOUNT_RESEARCH_CHAT_GPT_4o => '668f2f94-2552-4f6b-b10f-8a9f14371f69',
            self::ACCOUNT_RESEARCH_CHAT_GPT_4o_MINI => '668f2f94-2552-4f6b-b10f-8a9f14371f69',
            self::ACCOUNT_RESEARCH_GEMINI_25_PRO => '668f2f94-2552-4f6b-b10f-8a9f14371f69',
            self::ACCOUNT_RESEARCH_SONAR_REASONING_PRO => '668f2f94-2552-4f6b-b10f-8a9f14371f69',
            self::CONTACT_FINDER => 'ff0bc8c3-d54c-463b-860d-891c94f6454f',
            self::CONTACT_QUALIFICATION => 'cf5209d9-5f04-4377-a671-ab465e3a1011',
            self::DIGITAL_TWIN => 'f5ba9064-c2d1-49b5-960a-057c4c0d6a47',
            self::DIGITAL_TWIN_CONVERSATION => '8dedaf24-fed1-4900-9e61-6d584a004e64',
            self::PHONE_EMAIL_FINDER => '30b68bbc-ba07-4228-9554-6a12f98af022',
            self::PLAY_GENERATION => 'bb888a31-2a49-4da8-b3f5-66eb8bc86836',
            self::PLAY_TEMPLATE_GENERATION => '0cda34a6-0d40-49b8-a6d1-647d348e4385',
            self::ROLEPLAY => 'f804d9c2-26fc-4136-b2fb-430d74e5a606',
            self::ROLEPLAY_EVALUATION => '8191bd0e-8805-48a8-82c7-f88cea10ea5e',
        };
    }
}
