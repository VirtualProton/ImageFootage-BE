<?php
Payumoney::pay([
                'txnid'       => "67575757",
                'amount'      => 10.50,
                'productinfo' => 'A book',
                'firstname'   => 'Peter',
                'email'       => 'abc@example.com',
                'phone'       => '1234567890',
                'surl'        => url('payumoney-test/return'),
                'furl'        => url('payumoney-test/return'),
            ])->send();
 ?>

