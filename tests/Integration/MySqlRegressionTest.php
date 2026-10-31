<?php
namespace Tests\Integration;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\PromoCode;
use Tests\Support\MySqlTestCase;

class MySqlRegressionTest extends MySqlTestCase
{
    public function testModelCreationUpdateAndReadBack()
    {
        $promo = PromoCode::create(['name' => 'PHASE2-PROMO', 'type' => 'flat', 'discount' => '10.10', 'status' => '1']);
        $this->assertSame('10.10', PromoCode::findOrFail($promo->id)->discount);
        $promo->discount = '20.25';
        $promo->save();
        $this->assertSame('20.25', PromoCode::findOrFail($promo->id)->discount);
    }

    public function testInvoiceItemRelationshipUsesInvoiceId()
    {
        $invoice = $this->invoice();
        $item = new InvoiceItem();
        $item->forceFill(['invoice_id' => $invoice->id, 'product_id' => 'PHASE2-IMAGE', 'subtotal' => '100.00']);
        $item->save();
        $this->assertSame([$item->id], $invoice->items()->pluck('id')->all());
    }

    public function testMySqlStoresExactTwoDecimalMoney()
    {
        $invoice = $this->invoice(['tax' => '0.01', 'total' => '0.06']);
        $row = $this->sql->table('imagefootage_performa_invoices')->where('id', $invoice->id)->first();
        $this->assertSame('0.01', $row->tax);
        $this->assertSame('0.06', $row->total);
    }

    public function testFilteringSortingAndPaginationUseActualMySql()
    {
        foreach (['C', 'A', 'B'] as $name) {
            PromoCode::create(['name' => 'PHASE2-'.$name, 'type' => 'flat', 'discount' => '1', 'status' => '1']);
        }
        PromoCode::create(['name' => 'PHASE2-X', 'type' => 'flat', 'discount' => '1', 'status' => '0']);
        $page = PromoCode::where('status', '1')->orderBy('name')->paginate(2, ['*'], 'page', 2);
        $this->assertSame(3, $page->total());
        $this->assertSame(['PHASE2-C'], $page->pluck('name')->all());
    }

    public function testRollbackRestoresRowsAfterSyntheticFailure()
    {
        $before = PromoCode::count();
        try {
            $this->sql->transaction(function () {
                PromoCode::create(['name' => 'PHASE2-ROLLBACK', 'type' => 'flat', 'discount' => '1']);
                throw new \RuntimeException('Synthetic failure');
            });
        } catch (\RuntimeException $exception) {
            $this->assertSame('Synthetic failure', $exception->getMessage());
        }
        $this->assertSame($before, PromoCode::count());
    }

    public function testLegacyItemForeignKeyMetadataIsExplicit()
    {
        $keys = $this->sql->select('select constraint_name from information_schema.referential_constraints where constraint_schema = database() and table_name = ?', ['imagefootage_performa_invoice_items']);
        // The checked-in initial migration declares no foreign keys. Revisit if a verified schema differs.
        $this->assertSame([], $keys, 'Fixture schema differs from legacy migration: investigate, do not disable FK checks.');
    }

    public function testMissingInvoiceIsNull()
    {
        $this->assertNull(Invoice::where('invoice_name', 'PHASE2-MISSING')->first());
    }

    public function testInvoiceStatusUpdatePreservesMoneyAndNumber()
    {
        $invoice = $this->invoice();
        Invoice::where('id', $invoice->id)->update(['status' => 1, 'proforma_type' => 2]);
        $row = Invoice::findOrFail($invoice->id);
        $this->assertSame('PHASE2-700001', $row->invoice_name);
        $this->assertSame('118.00', $row->total);
        $this->assertSame(2, (int) $row->proforma_type);
    }

    public function testActualPrimaryKeyUniquenessRejectsDuplicateInvoiceRow()
    {
        $invoice = $this->invoice();
        try {
            $this->sql->table('imagefootage_performa_invoices')->insert(['id' => $invoice->id, 'user_id' => 700001,
                'created' => '2026-10-29 12:00:00', 'modified' => '2026-10-29 12:00:00']);
            $this->fail('Primary-key duplicate must be rejected.');
        } catch (\Illuminate\Database\QueryException $exception) {
            $this->assertSame(1062, (int) $exception->errorInfo[1]);
        }
        $this->assertSame(1, Invoice::count());
    }
}
