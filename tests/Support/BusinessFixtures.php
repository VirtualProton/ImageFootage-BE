<?php
namespace Tests\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

trait BusinessFixtures
{
    protected $mailTransport;

    protected function insertFixture($table, array $values)
    {
        foreach (DB::select('SHOW COLUMNS FROM `'.$table.'`') as $column) {
            if (array_key_exists($column->Field, $values) || $column->Null === 'YES' || $column->Default !== null || strpos($column->Extra, 'auto_increment') !== false) { continue; }
            if (preg_match('/^(tinyint|smallint|mediumint|bigint|int|decimal|float|double)/', $column->Type)) { $values[$column->Field] = 0; }
            elseif (strpos($column->Type, 'enum(') === 0) { preg_match("/enum\('([^']+)'/", $column->Type, $match); $values[$column->Field] = $match[1]; }
            elseif (preg_match('/^(date|timestamp)/', $column->Type)) { $values[$column->Field] = '2026-10-29 12:00:00'; }
            else { $values[$column->Field] = 'Synthetic'; }
        }
        return DB::table($table)->insertGetId($values);
    }

    protected function businessFixtures($seed = true)
    {
        if ($seed) {
        foreach (['countries' => ['name' => 'Synthetic Country'], 'states' => ['state' => 'Synthetic State', 'country_id' => 700001], 'cities' => ['name' => 'Synthetic City', 'state_id' => 700001]] as $table => $values) {
            $this->insertFixture($table, array_merge(['id' => 700001], $values));
        }
        $this->insertFixture('imagefootage_users', ['id' => 700001, 'first_name' => 'Synthetic Customer', 'last_name' => 'Fixture',
            'email' => 'synthetic@example.invalid', 'password' => password_hash('SyntheticPassword42', PASSWORD_BCRYPT, ['cost' => 4]),
            'country' => 700001, 'state' => 700001, 'city' => 700001, 'address' => 'Synthetic Street',
            'company' => 'Synthetic Studio', 'phone' => '0000000000', 'mobile' => '0000000000', 'gst' => '07SYNTHETIC0000Z', 'pan' => 'SYNTH0000X']);
        $this->insertFixture('imagefootage_admins', ['id' => 700002, 'name' => 'Synthetic Creator', 'email' => 'creator@example.invalid',
            'password' => password_hash('SyntheticPassword42', PASSWORD_BCRYPT, ['cost' => 4]), 'admin_status' => 'A', 'role_id' => 1, 'department_id' => 1]);
        Auth::guard('admins')->setUser(\App\Models\Admin::findOrFail(700002));
        }
        $image = imagecreatetruecolor(3, 2);
        ob_start(); imagepng($image); $png = ob_get_clean(); imagedestroy($image);
        if (!is_dir(public_path('images'))) { mkdir(public_path('images'), 0700, true); }
        foreach (['new-design-logo.png', 'conceptual_logo.png', 'signature.png', 'placeholder-music.png', 'placeholder-video.png', 'placeholder-image.png', 'music-img.png'] as $name) { file_put_contents(public_path('images/'.$name), $png); }
        UploadSink::install();
        $this->app->forgetInstance('mailer');
        Mail::clearResolvedInstance('mailer');
        $mailer = $this->app->make('mailer');
        $mailer->setSwiftMailer(new \Swift_Mailer(new MaterializedMailSink()));
        Mail::swap($mailer);
        $this->mailTransport = $mailer->getSwiftMailer()->getTransport();
        $this->assertInstanceOf(\Illuminate\Mail\Transport\ArrayTransport::class, $this->mailTransport);
    }

    protected function quotationRequest(array $changes = [])
    {
        return array_replace_recursive(['uid' => 700001, 'email' => 'synthetic@example.invalid', 'flag' => 2,
            'expiry_date' => 7, 'GSTS' => true, 'tax' => '18.00', 'total' => '118.00', 'end_client' => 'Synthetic End Client',
            'products' => ['product' => [['name' => 'Synthetic Image License', 'price' => '100.00', 'currency' => 'INR',
                'pro_type' => 'royalty_free', 'type' => 'Image', 'pro_size' => 'Large', 'licence_type' => 'Synthetic License', 'image' => '']]]], $changes);
    }

    protected function expectQuotationLink($id = 'plink_phase22')
    {
        GatewayTransport::respond('POST', '/v1/payment_links', ['id' => $id, 'short_url' => 'http://phase2.invalid/pay/'.$id,
            'amount' => 11800, 'currency' => 'INR', 'status' => 'created']);
    }
}

class MaterializedMailSink extends \Illuminate\Mail\Transport\ArrayTransport
{
    public function send(\Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        // A real transport reads attachments at send time, before business cleanup unlinks them.
        foreach ($message->getChildren() as $child) {
            if ($child instanceof \Swift_Attachment) { $child->setBody($child->getBody()); }
        }
        return parent::send($message, $failedRecipients);
    }
}
