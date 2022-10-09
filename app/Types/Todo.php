<?php

namespace App\Types;

use App\Types\Type;

class Todo extends Type
{
    public $name = 'todo';

    public $title = 'کار';

    public $fields = [
        'title' => [
            'label' => 'اسم کاری که قراره انجام بدی'
        ],
        'date' => [
            'label' => 'برا کی میخوای انجامش بدی؟ همون تاریخو بزن'
        ],
        'comment' => [
            'label' => 'چیز اضافه ای که میخوای بنویسی'
        ]
    ];
}
