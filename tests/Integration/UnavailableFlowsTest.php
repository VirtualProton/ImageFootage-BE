<?php
namespace Tests\Integration;

use Tests\TestCase;

// Explicit coverage gates, not empty passing tests. Each missing acceptance fixture is named.
class UnavailableFlowsTest extends TestCase
{
    /** @dataProvider blockedScenarios */
    public function testCriticalFlowRequiresTheNamedAcceptanceFixture($reason)
    {
        $this->markTestSkipped('BLOCKED: '.$reason);
    }

    public function blockedScenarios()
    {
        return [
            // Cross-store write/failure/retry is now executable in CrossStoreBusinessIntegrationTest.
            'quotation create/edit/replace end-to-end' => ['SQL-backed CP creation/edit retrieval/replacement now execute; full HTTP save/edit authorization matrix and owner-approved quantity/tax/branding outputs remain pending.'],
            'invoice numbering/customer selection/ownership' => ['schema-matched SQL records and business acceptance of numbering/ownership rules. No cross-user protection claim from guard mocks.'],
            'concurrent callback exactly-once effects' => ['Three overlapping real SQL/Common callback scenarios now pass via tests/run-concurrent.php; crash recovery, durable payment-ledger deduplication and external notification delivery still require accepted retry/compensation policy.'],
            'PayU callback end-to-end' => ['vendor-approved synthetic hash/order/merchant fixtures and isolated SQL state. Wrapper configuration is not assumed safe or supported.'],
            'Atom callback end-to-end' => ['active-provider confirmation and isolated order/package fixtures; signature primitive tests do not prove fulfillment.'],
            'Razorpay order/plan fulfillment end-to-end' => ['order/package SQL fixtures and intended amount/reference/retry rules for legacy razor_response and razor_plan_response.'],
            'Chromium and Browserless visual acceptance' => ['a separately sandboxed network-denied renderer and approved synthetic screenshots/fonts; process execution intentionally disabled in this runner.'],
            'custom quotation/full invoice email attachments' => ['SQL-backed CP/invoice PDFs, recipients/subjects/attachments now execute through private Swift sink; approved visual references and complete inline HTML/CC/BCC/renderer-failure matrix remain pending.'],
            'image upload/watermark end-to-end' => ['approved synthetic upload/controller fixtures and watermark/orientation expectations; library resize checks alone are insufficient.'],
            'FFmpeg video integration' => ['an isolated process sandbox and reviewed tiny synthetic video/thumbnail expectations; host FFmpeg exists but process execution is disabled here.'],
            'download authorization/history/limits' => ['isolated package/license/history data and business rules for cross-user and exhausted-plan access.'],
            'S3 adapter integration' => ['isolated S3 emulator/bucket credentials with deny-production policy; no cloud storage calls are permitted.'],
            // Product Mongo-filter -> MySQL category/keyword/pagination executes in CrossStoreBusinessIntegrationTest.
            'Elasticsearch integration/index mappings' => ['dedicated fixture cluster/index with compatible version and synthetic mappings; controller mocks are a separate layer.'],
            'package carry-forward calculation/duplicates' => ['actual synthetic MySQL remainder/sequential duplicate command now executes; owner-approved year/month/timezone rules and concurrent credit behavior still pending.'],
            'queue worker retry/failure persistence' => ['real DB queue reservation/release/retry/fixture execution/failed-job storage now execute; production job retry orchestration, worker-process sandbox and concurrent notification idempotency still pending.'],
            'currency conversion and invalid quantity rules' => ['business-approved conversion/rate source and quantity semantics; no assumption that legacy item price already includes quantity is correct.'],
        ];
    }
}
