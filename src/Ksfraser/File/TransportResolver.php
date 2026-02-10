<?php

declare(strict_types=1);

namespace Ksfraser\File;

use Ksfraser\File\Contracts\TransportInterface;
use Ksfraser\File\Exception\FileException;
use Ksfraser\File\Transports\HttpTransport;
use Ksfraser\File\Transports\LocalFileTransport;

final class TransportResolver
{
    /** @var array<int, TransportInterface> */
    private $transports;

    /**
     * @param array<int, TransportInterface> $transports
     */
    public function __construct(array $transports = [])
    {
        $this->transports = $transports ?: [
            new LocalFileTransport(),
            new HttpTransport(),
        ];
    }

    public function resolve(string $uri): TransportInterface
    {
        $scheme = $this->inferScheme($uri);

        foreach ($this->transports as $transport) {
            if ($transport->supportsScheme($scheme)) {
                return $transport;
            }
        }

        $s = $scheme ?? '(path)';
        throw new FileException('Unsupported URI scheme: ' . $s);
    }

    private function inferScheme(string $uri): ?string
    {
        $parts = @parse_url($uri);
        if (!is_array($parts) || !isset($parts['scheme']) || !is_string($parts['scheme']) || $parts['scheme'] === '') {
            return null;
        }

        return strtolower($parts['scheme']);
    }
}
