<?php return [
    'plugin' => [
        'name' => 'Bots detector',
        'description' => 'Register bots visits on your site',
        'settings' => 'Detector settings',
        'settings_description' => 'Reporting frequency, bots list'
    ],
    'component' => [
        'name' => 'Bots detector',
        'description' => 'Register bots visits on your site',
    ],
    'texts' => [
        'description' => 'description: ',
        'on_page' => 'On page ',
        'came' => 'bot came',
        'number' => 'Number',
        'sercher' => 'Search engine',
        'table_descr' => 'Description',
        'income_time' => 'Date and time',
    ],
    'settings' => [
        'email' => 'Email for reports',
        'mail_name' => 'Name for email',
        'periodicity' => 'Reports frequency (hours)',
        'logging' => 'Write log?',
        'mailing' => 'Send report of every visit on email (no reports)',
        'allowOnlySome' => 'Look for all bots',
        'Feedfetcher_comm' => 'Looking for RSS feeds',
        'Googlebot' => 'Common Google bot',
        'Googlebot_comm' => 'Looking for sites',
        'GooglebotNews' => 'News bot',
        'GooglebotImage' => 'Images bot',
        'GooglebotVideo' => 'Video bot',
        'AdsBotGoogle' => 'Checking page quality',
        'GoogleMobile' => 'Applications bot',
        'YandexBot' => 'Main indexing bot',
        'YandexAccessibilityBot' => 'Download pages for checking there availability for users',
        'YandexMobileBot' => 'Looking for pages, good for mobile devices',
        'YandexDirectDyn' => 'Generates dynamic banners'
    ],
    'tabs' => [
        'main' => 'Main',
        'looking' => 'Tracked bots'
    ]
];