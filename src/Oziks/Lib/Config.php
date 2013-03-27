<?php

/*
 * This file is part of the oziks/ConfigServiceProvider.
 *
 * (c) Morgan Brunot <brunot.morgan@gmail.com>
 */

namespace Oziks\Lib;

use Symfony\Component\Yaml\Yaml;
use SplFileInfo;

/**
 * Config.
 *
 * @author Morgan Brunot <brunot.morgan@gmail.com>
 */
class Config
{
    private $data = array();

    public function __construct(array $paths = array())
    {
        $this->load($paths);
    }

    private function load($paths)
    {
        $files = array();
        foreach ($paths as $path) {
            $files = array_merge($files, glob(rtrim($path, '/') . '/*.yml'));
        }

        foreach ($files as $file) {
            $scope = $this->getScope($file);
            if (!isset($this->data[$scope])) {
                $this->data[$scope] = array();
            }

            $this->data[$scope] = array_merge($this->data[$scope], Yaml::parse($file));
        }
    }

    private function getScope($path)
    {
        $file     = new SplFileInfo($path);
        $filename = $file->getFilename();

        return rtrim(str_replace($file->getExtension(), '', $filename), '.');
    }

    public function get($scope, array $default = array())
    {
        if (!isset($this->data[$scope])) {
            return $default;
        }

        return $this->data[$scope];
    }

    public function __call($scope, $args)
    {
        $default = isset($args[0]) ? $args[0] : array();

        return $this->get($scope, $default);
    }
}
