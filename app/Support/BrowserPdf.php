<?php

namespace App\Support;

use GuzzleHttp\Client;
use RuntimeException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class BrowserPdf
{
    /**
     * @var string|null
     */
    private static $lastRenderer;

    /**
     * Render HTML to a PDF string using a real browser engine.
     *
     * @param string $html
     * @return string
     */
    public static function render(string $html): string
    {
        $workspace = self::makeWorkspace();
        $pdfPath = $workspace . DIRECTORY_SEPARATOR . 'document.pdf';

        try {
            self::saveHtmlAsPdf($html, $pdfPath);

            $pdfBinary = @file_get_contents($pdfPath);
            if ($pdfBinary === false) {
                throw new RuntimeException('Browser PDF renderer did not produce a readable PDF file.');
            }

            return $pdfBinary;
        } finally {
            self::cleanupDirectory($workspace);
        }
    }

    /**
     * Render HTML to a PDF file path using a browser engine.
     *
     * @param string $html
     * @param string $pdfPath
     * @return void
     */
    public static function saveHtmlAsPdf(string $html, string $pdfPath): void
    {
        self::$lastRenderer = null;
        $browserPath = self::browserPath();

        if (self::browserlessBaseUrl() !== null) {
            try {
                self::saveHtmlAsPdfViaBrowserless($html, $pdfPath);
                self::$lastRenderer = 'browserless';

                return;
            } catch (\Throwable $exception) {
                if ($browserPath === null) {
                    throw $exception;
                }
            }
        }

        if ($browserPath === null) {
            throw new RuntimeException('No supported browser binary found for browser-based PDF rendering.');
        }

        $workspace = self::makeWorkspace();
        $htmlPath = $workspace . DIRECTORY_SEPARATOR . 'document.html';
        $profilePath = $workspace . DIRECTORY_SEPARATOR . 'profile';

        if (!is_dir($profilePath)) {
            mkdir($profilePath, 0777, true);
        }

        $outputDirectory = dirname($pdfPath);
        if (!is_dir($outputDirectory)) {
            mkdir($outputDirectory, 0777, true);
        }

        file_put_contents($htmlPath, $html);

        $process = new Process([
            $browserPath,
            '--headless',
            '--disable-gpu',
            '--disable-dev-shm-usage',
            '--disable-software-rasterizer',
            '--no-first-run',
            '--no-default-browser-check',
            '--allow-file-access-from-files',
            '--disable-web-security',
            '--run-all-compositor-stages-before-draw',
            '--virtual-time-budget=2000',
            '--window-size=1400,2200',
            '--force-device-scale-factor=1',
            '--no-pdf-header-footer',
            '--user-data-dir=' . $profilePath,
            '--print-to-pdf=' . $pdfPath,
            self::toFileUrl($htmlPath),
        ]);

        if (self::shouldDisableSandbox()) {
            $process = new Process([
                $browserPath,
                '--headless',
                '--disable-gpu',
                '--disable-dev-shm-usage',
                '--disable-software-rasterizer',
                '--no-first-run',
                '--no-default-browser-check',
                '--allow-file-access-from-files',
                '--disable-web-security',
                '--run-all-compositor-stages-before-draw',
                '--virtual-time-budget=2000',
                '--window-size=1400,2200',
                '--force-device-scale-factor=1',
                '--no-pdf-header-footer',
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--user-data-dir=' . $profilePath,
                '--print-to-pdf=' . $pdfPath,
                self::toFileUrl($htmlPath),
            ]);
        }

        $process->setTimeout(120);

        try {
            $process->mustRun();
        } catch (ProcessFailedException $exception) {
            throw new RuntimeException(
                'Browser PDF rendering failed: ' . trim($process->getErrorOutput() ?: $process->getOutput()),
                0,
                $exception
            );
        } finally {
            self::cleanupDirectory($workspace);
        }

        if (!file_exists($pdfPath) || filesize($pdfPath) === 0) {
            throw new RuntimeException('Browser PDF renderer completed without producing a PDF file.');
        }

        self::$lastRenderer = 'browser';
    }

    /**
     * @return bool
     */
    public static function isAvailable(): bool
    {
        return self::browserlessBaseUrl() !== null || self::browserPath() !== null;
    }

    /**
     * @return string|null
     */
    public static function lastRenderer(): ?string
    {
        return self::$lastRenderer;
    }

    /**
     * @return string|null
     */
    public static function browserPath(): ?string
    {
        $candidates = array_filter([
            env('PDF_BROWSER_PATH'),
            env('CHROME_PATH'),
            'google-chrome',
            'google-chrome-stable',
            'chromium-browser',
            'chromium',
            'microsoft-edge',
            'msedge',
            'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files\\Microsoft\\Edge\\Application\\msedge.exe',
            'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe',
            '/usr/bin/google-chrome',
            '/usr/bin/google-chrome-stable',
            '/usr/bin/chromium-browser',
            '/usr/bin/chromium',
            '/usr/bin/microsoft-edge',
            '/snap/bin/chromium',
            '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome',
            '/Applications/Microsoft Edge.app/Contents/MacOS/Microsoft Edge',
        ]);

        foreach ($candidates as $candidate) {
            $resolvedPath = self::resolveBrowserExecutable((string) $candidate);
            if ($resolvedPath !== null) {
                return $resolvedPath;
            }
        }

        return null;
    }

    /**
     * @return string|null
     */
    public static function browserlessBaseUrl(): ?string
    {
        $baseUrl = trim((string) env('PDF_BROWSERLESS_URL', ''));

        if ($baseUrl === '') {
            return null;
        }

        return rtrim($baseUrl, '/');
    }

    /**
     * @return string
     */
    private static function makeWorkspace(): string
    {
        $workspace = storage_path('app/browser-pdf/' . uniqid('render_', true));
        if (!is_dir($workspace)) {
            mkdir($workspace, 0777, true);
        }

        return $workspace;
    }

    /**
     * @param string $path
     * @return string
     */
    private static function toFileUrl(string $path): string
    {
        return 'file:///' . str_replace('\\', '/', ltrim($path, '\\/'));
    }

    /**
     * @param string $directory
     * @return void
     */
    private static function cleanupDirectory(string $directory): void
    {
        if (!is_dir($directory)) {
            return;
        }

        $items = array_diff(scandir($directory) ?: [], ['.', '..']);
        foreach ($items as $item) {
            $path = $directory . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                self::cleanupDirectory($path);
            } elseif (file_exists($path)) {
                @unlink($path);
            }
        }

        @rmdir($directory);
    }

    /**
     * @param string $html
     * @param string $pdfPath
     * @return void
     */
    private static function saveHtmlAsPdfViaBrowserless(string $html, string $pdfPath): void
    {
        $baseUrl = self::browserlessBaseUrl();
        if ($baseUrl === null) {
            throw new RuntimeException('Browserless URL is not configured.');
        }

        $outputDirectory = dirname($pdfPath);
        if (!is_dir($outputDirectory)) {
            mkdir($outputDirectory, 0777, true);
        }

        $client = new Client([
            'timeout' => (float) env('PDF_BROWSERLESS_TIMEOUT', 120),
            'http_errors' => true,
        ]);

        $url = $baseUrl . '/pdf';
        $token = trim((string) env('PDF_BROWSERLESS_TOKEN', ''));
        if ($token !== '') {
            $separator = strpos($url, '?') === false ? '?' : '&';
            $url .= $separator . 'token=' . rawurlencode($token);
        }

        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/pdf',
                'Cache-Control' => 'no-cache',
            ],
            'json' => [
                'html' => $html,
                'options' => [
                    'printBackground' => true,
                    'preferCSSPageSize' => true,
                    'format' => env('PDF_BROWSERLESS_FORMAT', 'A4'),
                ],
            ],
        ]);

        $pdfBinary = (string) $response->getBody();
        if ($pdfBinary === '') {
            throw new RuntimeException('Browserless returned an empty PDF response.');
        }

        file_put_contents($pdfPath, $pdfBinary);
    }

    /**
     * @return bool
     */
    private static function shouldDisableSandbox(): bool
    {
        $envValue = strtolower((string) env('PDF_BROWSER_DISABLE_SANDBOX', ''));
        if (in_array($envValue, ['1', 'true', 'yes', 'on'], true)) {
            return true;
        }

        return function_exists('posix_geteuid') && posix_geteuid() === 0;
    }

    /**
     * @param string $candidate
     * @return string|null
     */
    private static function resolveBrowserExecutable(string $candidate): ?string
    {
        $candidate = trim($candidate);
        if ($candidate === '') {
            return null;
        }

        if (file_exists($candidate)) {
            return $candidate;
        }

        $resolverCommand = DIRECTORY_SEPARATOR === '\\'
            ? ['where', $candidate]
            : ['which', $candidate];

        try {
            $process = new Process($resolverCommand);
            $process->setTimeout(5);
            $process->mustRun();

            $resolvedLines = preg_split('/\r\n|\r|\n/', trim($process->getOutput())) ?: [];
            foreach ($resolvedLines as $resolvedLine) {
                $resolvedLine = trim($resolvedLine);
                if ($resolvedLine !== '' && file_exists($resolvedLine)) {
                    return $resolvedLine;
                }
            }
        } catch (\Throwable $exception) {
            return null;
        }

        return null;
    }
}
