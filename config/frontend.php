<?php
$config =
    file_exists(__DIR__ . '/../frontend.config.json') &&
    gettype(file_get_contents(__DIR__ . '/../frontend.config.json')) === 'string'
        ? (string) file_get_contents(__DIR__ . '/../frontend.config.json')
        : '';

return json_decode($config, true);
