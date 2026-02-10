<?php

// Minimal stub of rest_interface for legacy file_download.
class rest_interface
{
    protected string $baseurl = '';
    protected string $endpoint = '';
    protected string $queryval = '';
    protected string $key = '';
    protected string $url = '';

    public function __construct(string $host, string $user, string $pass, string $database)
    {
        // no-op
    }

    public function tell_eventloop(object $caller, string $event, $msg = null): void
    {
        // no-op for tests
    }
}
