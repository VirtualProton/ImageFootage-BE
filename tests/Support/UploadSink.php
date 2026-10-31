<?php
namespace Tests\Support;

// SDK upload boundary only; no HTTP, no cloud emulator/integration success claim.
class UploadSink
{
    public static $uploads = [];
    public static $fail = false;
    private $source;
    private $options;

    public static function install()
    {
        // Business code constructs a concrete SDK client with no injectable HTTP handler.
        // Replace construction too: default Guzzle selection is forbidden in this runner.
        if (!class_exists('Aws\\S3\\S3Client', false)) {
            class_alias(CloudClientSink::class, 'Aws\\S3\\S3Client');
        } elseif (!is_a('Aws\\S3\\S3Client', CloudClientSink::class, true)) {
            throw new \RuntimeException('Cloud SDK client already loaded; refusing unsafe business integration run.');
        }
        if (!class_exists('Aws\\S3\\MultipartUploader', false)) {
            class_alias(self::class, 'Aws\\S3\\MultipartUploader');
        } elseif (!is_a('Aws\\S3\\MultipartUploader', self::class, true)) {
            throw new \RuntimeException('Cloud upload class already loaded; refusing unsafe integration run.');
        }
        self::$uploads = [];
        self::$fail = false;
    }

    public function __construct($client, $source, array $options)
    {
        $this->source = $source;
        $this->options = $options;
    }

    public function upload()
    {
        $bytes = is_resource($this->source) ? stream_get_contents($this->source) : file_get_contents($this->source);
        if (is_resource($this->source)) { fclose($this->source); }
        self::$uploads[] = ['key' => $this->options['key'], 'bytes' => $bytes];
        if (self::$fail) { throw new \RuntimeException('Synthetic isolated storage boundary failure'); }
        return ['ObjectURL' => 'http://phase2.invalid/artifacts/'.$this->options['key']];
    }
}

class CloudClientSink
{
    public function __construct(array $options) {}
    public function __call($name, $arguments) { throw new \RuntimeException('Unexpected cloud client operation refused.'); }
}
