<?php

declare(strict_types = 1);

require_once __DIR__.'/../bootstrap.php';

return [
    /**
     * --------------------------------------------------
     * | Server Configuration
     * | This section contains the server name and version.
     * | You can set these values through environment variables.
     * | SERVER_NAME and SERVER_VERSION can be set in your .env file.
     * | If not set, default values will be used.
     * | Default: 'Flatpak MCP Server' and '1.0.0'
     * --------------------------------------------------
     * | Example:
     * | SERVER_NAME=MyCustomServer.
     */
    'server' => [
        'name'    => $_ENV['SERVER_NAME'] ?? 'Flatpak MCP Server',
        'version' => $_ENV['SERVER_VERSION'] ?? '1.0.0',
    ],

    /**
     * --------------------------------------------------
     * | Logger Configuration
     * | This section configures the logger for the server.
     * | You can set the log path and log level through environment variables.
     * | LOG_PATH and LOG_LEVEL can be set in your .env file.
     * | If not set, default values will be used.
     * | Default: logs are stored in 'storage/logs/server.log' and log level is 'info'.
     * --------------------------------------------------
     * | Example:
     * | LOG_PATH=/var/logs/myserver.log
     * | LOG_LEVEL=debug
     * --------------------------------------------------
     * | Important:
     * --------------------------------------------------
     * | Note: The log path should be an relative path from the config directory.
     * --------------------------------------------------.
     */
    'logger' => [
        'log_path'  => __DIR__.'/..'.($_ENV['LOG_PATH'] ?? '/storage/logs/server.log'),
        'log_level' => $_ENV['LOG_LEVEL'] ?? 'info',
    ],

    /**
     * --------------------------------------------------
     * | Cache Configuration
     * | This section configures the cache for the server.
     * | You can set the cache path, cache prefix, and cache TTL through environment variables.
     * | CACHE_PATH, CACHE_PREFIX, and CACHE_TTL can be set in your .env file.
     * | If not set, default values will be used.
     * | Default: cache is stored in 'storage/cache' with prefix 'server_cache'
     * | and TTL is set to 3600 seconds (1 hour).
     * --------------------------------------------------
     * | Example:
     * | CACHE_PATH=/var/cache/myserver
     * | CACHE_PREFIX=myserver_cache
     * | CACHE_TTL=7200
     * --------------------------------------------------
     * | Important:
     * --------------------------------------------------
     * | Note: The cache path should be an relative path from the config directory.
     * --------------------------------------------------.
     */
    'cache' => [
        'cache_path'   => __DIR__.'/..'.($_ENV['CACHE_PATH'] ?? '/storage/cache'),
        'cache_prefix' => $_ENV['CACHE_PREFIX'] ?? 'server_cache',
        'cache_ttl'    => (int)$_ENV['CACHE_TTL'] ?? 3600,
    ],
];
