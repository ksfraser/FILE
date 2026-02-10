<?php

$autoload = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
}

// Legacy classes in this repo require files from the monorepo root.
$stubsDir = __DIR__ . '/stubs';
$includePath = $stubsDir . PATH_SEPARATOR . get_include_path();

$monorepoRoot = dirname(dirname(dirname(__DIR__))); // .../ksf_modules_common
set_include_path($includePath . PATH_SEPARATOR . $monorepoRoot);

require_once $stubsDir . '/defines.inc.php';
