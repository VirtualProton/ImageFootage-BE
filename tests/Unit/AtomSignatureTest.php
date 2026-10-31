<?php
namespace Tests\Unit;

use App\Http\AtomPay\TransactionResponse;
use Tests\TestCase;

class AtomSignatureTest extends TestCase
{
    /** @dataProvider signatures */
    public function testAtomUsesSyntheticSha512SignatureAndRejectsTampering($tamper, $expected)
    {
        $payload = ['mmp_txn' => 'phase2-bank', 'mer_txn' => 'phase2-order', 'f_code' => 'Ok',
            'prod' => 'phase2', 'discriminator' => 'NB', 'amt' => '118.00', 'bank_txn' => 'phase2-txn'];
        $payload['signature'] = hash_hmac('sha512', implode('', $payload), 'phase2-atom-secret');
        if ($tamper) { $payload['amt'] = '1.00'; }
        $verifier = new TransactionResponse();
        $verifier->setRespHashKey('phase2-atom-secret');
        $this->assertSame($expected, $verifier->validateResponse($payload));
    }

    public function signatures() { return [[false, true], [true, false]]; }
}
