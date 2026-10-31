<?php
namespace Tests\Support;

// Controller boundary fixture, explicitly not a database, transaction or concurrency test.
class CallbackStore
{
    public $invoice;
    public $writes = [];
    public $reads = [];
    public $queries = [];

    public function __construct(array $overrides = [])
    {
        $this->invoice = array_merge(['id' => 700001, 'invoice_name' => '7000001', 'user_id' => 700002,
            'package_id' => null, 'invoice_type' => 3, 'proforma_type' => 2,
            'invoice_url' => 'synthetic-invoice.pdf', 'status' => 0, 'cancelled_on' => null,
            'total' => '118.00', 'currency' => 'INR',
            'payment_response' => json_encode(['id' => 'plink_phase2', 'reference_id' => 'QTN-7000001', 'amount' => 11800, 'currency' => 'INR'])], $overrides);
    }

    public function install()
    {
        \Illuminate\Support\Facades\DB::shouldReceive('transaction')->andReturnUsing(function ($operation) { return $operation(); });
        \Illuminate\Support\Facades\DB::shouldReceive('table')->andReturnUsing(function ($table) {
            if (!in_array($table, ['imagefootage_performa_invoices', 'imagefootage_users', 'imagefootage_user_package'], true)) {
                throw new \RuntimeException('Unconfigured callback table refused.');
            }
            $builder = \Mockery::mock();
            $builder->shouldReceive('lockForUpdate')->andReturnSelf(); // Boundary fixture only; real locking is tested separately.
            $columns = ['*'];
            $predicates = [];
            $builder->shouldReceive('select')->andReturnUsing(function (...$selected) use (&$columns, $builder) {
                $columns = count($selected) === 1 && is_array($selected[0]) ? $selected[0] : $selected;
                return $builder;
            });
            $builder->shouldReceive('where')->andReturnUsing(function ($column, $operator, $value = null) use (&$predicates, $builder) {
                if (func_num_args() === 2) {
                    $value = $operator;
                    $operator = '=';
                }
                if ($operator !== '=') {
                    throw new \RuntimeException('Only explicit equality predicates supported by callback fixture.');
                }
                $predicates[] = [$column, $value];
                return $builder;
            });
            $row = function () use ($table) {
                if ($table === 'imagefootage_users') {
                    return ['id' => 700002, 'gst' => '', 'pan' => '', 'mobile' => '', 'phone' => ''];
                }
                return $this->invoice;
            };
            $matches = function ($record) use (&$predicates) {
                foreach ($predicates as [$column, $value]) {
                    if (!array_key_exists($column, $record) || (string) $record[$column] !== (string) $value) {
                        return false;
                    }
                }
                return true;
            };
            $builder->shouldReceive('first')->andReturnUsing(function () use ($table, &$columns, &$predicates, $row, $matches) {
                $this->reads[] = $table;
                $this->queries[] = ['table' => $table, 'operation' => 'first', 'select' => $columns, 'where' => $predicates];
                $record = $row();
                if (!$matches($record)) {
                    return null;
                }
                return (object) (in_array('*', $columns, true) ? $record : array_intersect_key($record, array_flip($columns)));
            });
            $builder->shouldReceive('update')->andReturnUsing(function ($values) use ($table, &$predicates, $row, $matches) {
                $this->queries[] = ['table' => $table, 'operation' => 'update', 'where' => $predicates];
                if (!$matches($row())) {
                    return 0;
                }
                $this->writes[] = ['table' => $table, 'values' => $values];
                if ($table === 'imagefootage_performa_invoices') {
                    $this->invoice = array_merge($this->invoice, $values);
                }
                return 1;
            });
            return $builder;
        });
    }
}
