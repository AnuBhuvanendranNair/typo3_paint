<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 Paint',
    'description' => 'Configurable backend colors (primary, secondary, icon accent, header, sidebar) for the TYPO3 backend',
    'category' => 'be',
    'state' => 'alpha',
    'author' => 'Anu Bhuvanendran Nair',
    'author_email' => '',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '14.0.0-14.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
