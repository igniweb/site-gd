<?php

namespace App\Services;

use RuntimeException;

class Assets
{
    /**
     * Application environment.
     *
     * @var string
     */
    private $environment;

    /**
     * Data describing assets.
     *
     * @var array
     */
    private $data;

    /**
     * Assets version identifier.
     *
     * @var string
     */
    private $version = '';

    /**
     * Setup assets instance.
     *
     * @param string $path
     * @return void
     */
    public function __construct($path = '')
    {
        $this->environment = app()->environment();

        $this->data = $this->read($path);

        if ($this->environment !== 'local') {
            $versionFile = base_path($this->data['paths']['src'] . '.version');
            $this->version = file_exists($versionFile) ? '?t=' . file_get_contents($versionFile) : '';
        }
    }

    /**
     * Returns <script> tags depending of the environment.
     *
     * @return string
     */
    public function scripts()
    {
        $scripts = '';

        if ($this->environment === 'local') {
            foreach ($this->data['scripts'] as $script) {
                $scripts .= '<script src="' . $this->cleanPath($script) . '"></script>' . PHP_EOL;
            }
        } else {
            $scripts .= '<script src="' . $this->cleanPath($this->data['paths']['dist']) . 'scripts.min.js' . $this->version . '"></script>' . PHP_EOL;
        }

        return $scripts;
    }

    /**
     * Returns <link rel="stylesheet"> tags depending of the environment.
     *
     * @return string
     */
    public function styles()
    {
        $styles = '';

        if ($this->environment === 'local') {
            foreach ($this->data['styles'] as $style) {
                $styles .= '<link rel="stylesheet" type="text/css" href="' . $this->cleanPath($style) . '">' . PHP_EOL;
            }
        } else {
            $styles .= '<link rel="stylesheet" type="text/css" href="' . $this->cleanPath($this->data['paths']['dist']) . 'styles.min.js' . $this->version . '">' . PHP_EOL;
        }

        return $styles;
    }

    /**
     * Parse 'assets.json' file.
     *
     * @param string $path
     * @throws \RuntimeException
     * @return void
     */
    private function read($path)
    {
        $path = $path ?: base_path('resources/assets.json');
        if (!file_exists($path)) {
            throw new RuntimeException('Assets file not found (' . $path . ')');
        }

        $data = json_decode(file_get_contents($path), true);
        if (!is_array($data)) {
            throw new RuntimeException('Assets file not a valid JSON file (' . $path . ')');
        }

        return $data;
    }

    /**
     * Returns clean rootDirectory path.
     *
     * @var string $path
     * @return string
     */
    private function cleanPath($path)
    {
        return str_replace('public/', '/', $path);
    }
}
