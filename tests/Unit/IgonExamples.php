<?php
$forms = [
    [
        'type' => 'select', // 'input' | 'select' | 'checkbox'
        'control' => [
            'name' => 'department', // название значения, которое будет возвращаться
            'value' => '', // Выбранное значение (его value)
            'label' => 'Подразделение',
            'options' => [
                [
                    'text' => 'Подразделение 1',
                    'value' => '1'
                ],
                [
                    'text' => 'Подразделение 2',
                    'value' => '2'
                ],
                [
                    'text' => 'Подразделение 3',
                    'value' => '3'
                ]
            ]
        ],
        'actions' => []
    ],
    [
        'type' => 'input', // 'input' | 'select' | 'checkbox'
        'control' => [
            'name' => 'search', // название значения, которое будет возвращаться
            'value' => '', // Значение
            'label' => 'Поиск по названию'
        ]
    ]
];

$buttons = [
    [
        'type' => 'button',
        'control' => [
            'type' => 'button',
            'name' => 'load-excel',
            'value' => 'Загрузить Excel'
        ]
    ],
    [
        'type' => 'button',
        'control' => [
            'type' => 'submit',
            'name' => 'calculate',
            'value' => 'Пересчитать'
        ]
    ]
];

$tabs = [
    [
        'title' => 'Книги',
        'anchor' => 'books',
        'description' => 'Новые книги',
        'route' => '/subscriber/reports/new-resources/books'
    ],
    [
        'title' => 'Журналы',
        'name' => 'journals',
        'description' => 'Новые журналы',
        'route' => '/subscriber/reports/new-resources/journals'
    ]
];