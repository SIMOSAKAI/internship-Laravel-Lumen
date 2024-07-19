<?php 

if (!function_exists('mix')) {
    function mix($path)
    {
        static $manifest;

        // Load the mix-manifest.json only once
        if (!$manifest) {
            $manifestPath = base_path('public/mix-manifest.json');
            if (!file_exists($manifestPath)) {
                throw new Exception('The mix-manifest.json file does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        // Ensure the path starts with a leading slash
        $path = '/' . ltrim($path, '/');

        // Check if the path exists in the manifest
        if (!array_key_exists($path, $manifest)) {
            throw new Exception("The path '{$path}' does not exist in the mix-manifest.");
        }

        return $manifest[$path];
    }
}
