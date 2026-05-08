<?php

/**
 * FrankenPHP Worker Bootstrap for Laravel
 */

declare(strict_types=1);

ignore_user_abort(true);

require_once __DIR__ . '/vendor/autoload.php';

// ── One-time application bootstrap ───────────────────────────
$app = require_once __DIR__ . '/bootstrap/app.php';

/** @var \Illuminate\Contracts\Http\Kernel $kernel */
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Warm up the service container and all service providers once.
$kernel->bootstrap();

// ── Per-request handler ───────────────────────────────────────
$handler = static function () use ($kernel): void {
    $request = \Illuminate\Http\Request::capture();

    try {
        $response = $kernel->handle($request);
        $response->send();
    } finally {
        $kernel->terminate($request, $response ?? new \Illuminate\Http\Response('', 500));
        gc_collect_cycles();
    }
};

// ── Worker loop ───────────────────────────────────────────────
while (frankenphp_handle_request($handler)) {
}
