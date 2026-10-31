<?php
namespace Tests\Support;

class FixtureQueuedJob
{
    public function fire($job, array $data)
    {
        if ($data !== ['fixture' => 'phase22']) { throw new \RuntimeException('Unexpected queue fixture.'); }
        $job->delete();
    }
}
