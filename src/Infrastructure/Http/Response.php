<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

class Response
{
    private string $version;
    private string $content;
    private int $statusCode = 200;
    private string $statusText = 'OK';
    private const HTTP_STATUS_CODES = [
        200 => 'OK',
        404 => 'Not Found',
    ];

    public function __construct()
    {
        $this->version = '1.1';

        if (isset($_SERVER['SERVER_PROTOCOL']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.0') {
            $this->version = '1.0';
        }
    }

    public function send(): void
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    private function sendContent(): void
    {
        echo $this->content;
    }

    public function setStatusCode(?int $statusCode = null, ?string $statusText = null): self
    {
        if ($statusCode === null) {
            $statusCode = 200;
        }

        if ($statusText === null) {
            $statusText = self::HTTP_STATUS_CODES[$statusCode] ?? '';
        }

        $this->statusCode = $statusCode;
        $this->statusText = $statusText;

        return $this;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    private function sendHeaders(): void
    {
        header("HTTP/{$this->version} {$this->statusCode} {$this->statusText}");
    }
}
