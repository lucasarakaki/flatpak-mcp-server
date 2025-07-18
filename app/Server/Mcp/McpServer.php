<?php

declare(strict_types = 1);

namespace App\Server\Mcp;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PhpMcp\Server\Server;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

/**
 * ---------------------------------------------------
 * | McpServer class.
 * ---------------------------------------------------
 * | this class is a bootstrap for the MCP server. It initializes the server
 * | with configuration settings, sets up logging and caching, and provides
 * | a method to create a server instance.
 * ---------------------------------------------------.
 */
class McpServer
{
    /**
     * Configuration for the MCP Server.
     *
     * @var array
     */
    private array $config;

    /**
     * Logger instance for logging purposes.
     *
     * @var Logger
     */
    private Logger $logger;

    /**
     * Cache interface for caching purposes.
     *
     * @var Psr16Cache
     */
    private Psr16Cache $cache;

    /**
     * McpServer constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->setupLogger();
        $this->setupCache();
    }

    /**
     * Setup the logger for the MCP Server.
     *
     * @return void
     */
    private function setupLogger(): void
    {
        $this->logger = new Logger('McpServerLogger');
        $this->ensureDirectoryExists(\dirname($this->config['logger']['log_path']));
        $this->logger->pushHandler(new StreamHandler(
            $this->config['logger']['log_path'],
            $this->config['logger']['log_level'],
        ));
    }

    /**
     * Setup the cache for the MCP Server.
     *
     * @return void
     */
    private function setupCache(): void
    {
        $this->ensureDirectoryExists(\dirname($this->config['cache']['cache_path']));
        $this->cache = new Psr16Cache(new FilesystemAdapter(
            $this->config['cache']['cache_prefix'],
            $this->config['cache']['cache_ttl'],
            $this->config['cache']['cache_path'],
        ));
    }

    /**
     * Make the MCP Server instance.
     *
     * @return Server
     */
    public function serverMake(): Server
    {
        return Server::make()
            ->withServerInfo(
                $this->config['server']['name'],
                $this->config['server']['version'],
            )
            ->withLogger($this->logger)
            ->withCache($this->cache)
            ->build();
    }

    /**
     * Validate and ensure the directory exists.
     *
     * @param string $path
     *
     * @return void
     */
    private function ensureDirectoryExists(string $path): void
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }
}
