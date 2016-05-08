<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude('var')
    ->exclude('vendor')
    ->exclude('docker')
    ->notName('adminer.php')
    ->in(__DIR__)
;

return Symfony\CS\Config\Config::create()
    ->fixers([
        // PSR2/Symfony code styles rules blacklisting:
        '-phpdoc_params',
        '-list_commas',
        '-concat_without_spaces',
        '-empty_return',
        '-unused_use', //might break code: we will have to remove unused "use" statements manually
        // Additional code style rules whitelisting:
        'short_array_syntax',
        'ordered_use',
        'newline_after_open_tag',
    ])
    ->finder($finder)
;
