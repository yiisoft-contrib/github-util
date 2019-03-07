<?php
return [
    'common' => [
        [
            'name' => 'expired',
            'color' => 'cccccc',
            'description' => 'Information requested was not provided in two weeks.',
        ],
        [
            'name' => 'good first issue',
            'color' => '0e8a16',
            'description' => 'Simple enough issue to start with.',
        ],
        [
            'name' => 'help wanted',
            'color' => '0e8a16',
        ],
        [
            'name' => 'missing formatting',
            'color' => 'd4c5f9',
            'description' => 'Formatting is missing so it is hard to read issue.',
        ],
        [
            'name' => 'question',
            'color' => 'd4c5f9',
        ],
    ],
    'pr' => [
        [
            'name' => 'pr:missing usecase',
            'color' => 'fbca04',
            'description' => 'It is not clear what is the use case for the pull request.',
        ],

        [
            'name' => 'pr:request for unit tests',
            'color' => 'fbca04',
            'description' => 'Unit tests are needed.',
        ],

        [
            'name' => 'pr:too many objectives',
            'color' => 'fbca04',
            'description' => 'It is impossible to review pull request because it does too many things at once.',
        ],
    ],
    'status' => [
        [
            'name' => 'status:need more info',
            'color' => 'd4c5f9',
        ],
        [
            'name' => 'status:ready for adoption',
            'color' => '02e10c',
            'description' => 'Feel free to implement this issue.',
        ],
        [
            'name' => 'status:to be verified',
            'color' => 'fbca04',
            'description' => 'Needs to be reproduced and validated.',
        ],

        [
            'name' => 'status:under development',
            'color' => '0b02e1',
            'description' => 'Someone is working on a pull request.',
        ],

        [
            'name' => 'status:under discussion',
            'color' => 'f7c6c7',
        ],

        [
            'name' => 'status:wontfix',
            'color' => 'C0BABA',
        ],
        [
            'name' => 'status:code review',
            'color' => '02e10c',
            'description' => 'The pull request needs review.',
        ],
        [
            'name' => 'status:ready for merge',
            'color' => '02e10c',
            'description' => 'The pull request is OK to be merged.',
        ],
    ],
    'type' => [
        [
            'name' => 'type:bug',
            'color' => 'e102d8',
            'description' => 'Bug',
        ],
        [
            'name' => 'type:docs',
            'color' => '207de5',
            'description' => 'Documentation',
        ],

        [
            'name' => 'type:enhancement',
            'color' => 'd7e102',
            'description' => 'Enhancement',
        ],

        [
            'name' => 'type:feature',
            'color' => '02d7e1',
            'description' => 'New feature',
        ],

        [
            'name' => 'type:task',
            'color' => 'DDDDDD',
            'description' => 'Task',
        ],

        [
            'name' => 'type:test',
            'color' => 'd7e102',
            'description' => 'Test',
        ],
    ],
    'dbs' => [
        [
            'name' => 'MSSQL',
            'color' => '006b75',
        ],
        [
            'name' => 'MySQL',
            'color' => '006b75',
        ],
        [
            'name' => 'Oracle',
            'color' => '006b75',
        ],
        [
            'name' => 'PostgreSQL',
            'color' => '006b75',
        ],
        [
            'name' => 'SQLite',
            'color' => '006b75',
        ],
    ],
    'complexity' => [
        [
            'name' => 'complexity:easy',
            'color' => 'bfe5bf',
        ],
        [
            'name' => 'complexity:hard',
            'color' => 'fad8c7',
        ],
        [
            'name' => 'complexity:medium',
            'color' => 'bfdadc',
        ],
    ],
    'yii2-ext' => [
        [
            'name' => 'ext:apidoc',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:authclient',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:bootstrap',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:captcha',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:debug',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:elasticsearch',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:faker',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:gii',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:httpclient',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:imagine',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:jquery',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:jui',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:mongodb',
            'color' => 'c7def8',
        ],

        [
            'name' => 'ext:redis',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:rest',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:smarty',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:sphinx',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:swiftmailer',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'ext:twig',
            'color' => 'bfd4f2',
        ],
    ],
    'feature' => [
        [
            'name' => 'feature:db',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'feature:form',
            'color' => 'fef2c0',
        ],

        [
            'name' => 'feature:mailer',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'feature:pjax',
            'color' => 'c7def8',
        ],

        [
            'name' => 'feature:rbac',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'feature:rest',
            'color' => 'bfd4f2',
        ],

        [
            'name' => 'feature:widgets',
            'color' => 'bfd4f2',
        ],
    ],
    'severity' => [
        [
            'name' => 'severity:BC breaking',
            'color' => 'eb6420',
            'description' => 'Breaks backwards compatibility',
        ],

        [
            'name' => 'severity:critical',
            'color' => 'e10c02',
        ],

        [
            'name' => 'severity:important',
            'color' => 'eb6420',
        ],

        [
            'name' => 'severity:minor',
            'color' => '444444',
        ],

        [
            'name' => 'severity:normal',
            'color' => 'd7e102',
        ],

        [
            'name' => 'severity:security',
            'color' => '5319e7',
            'description' => 'Affects security',
        ],
    ],
    '_' => [
        [
            'name' => 'RFC',
            'color' => '5319e7',
        ],
        [
            'name' => 'Codeception',
            'color' => 'fef2c0',
        ],
        [
            'name' => 'JS',
            'color' => '006b75',
        ],
        [
            'name' => 'core issue',
            'color' => 'ededed',
        ],
        [
            'name' => 'hacktoberfest',
            'color' => '006b75',
        ],
    ]
];