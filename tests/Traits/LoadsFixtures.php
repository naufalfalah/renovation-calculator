<?php

namespace Tests\Traits;

trait LoadsFixtures
{
    protected function loadFixtureArray(string $file): array
    {
        $path = base_path("tests/Fixtures/{$file}.php");

        if (!file_exists($path)) {
            throw new \Exception("Fixture {$file} not found.");
        }

        return require $path;
    }

    protected function loadFixtureJson(string $file): array
    {
        $path = base_path("tests/Fixtures/{$file}.json");

        if (!file_exists($path)) {
            throw new \Exception("Fixture {$file} not found.");
        }

        return json_decode(file_get_contents($path), true);
    }
}
