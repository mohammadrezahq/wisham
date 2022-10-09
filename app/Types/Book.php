<?php

namespace App\Types;

use App\Types\Type;

class Book extends Type
{
    public $name = 'book';

    public $title = 'کتاب';

    public $fields = [
        'title' => [
            'label' => 'اسم کتابی که میخوای بخونی رو بنویس'
        ],
        'link' => [
            'label' => 'اگه لینک از صفحه کتابی که میخوایو بزاری که عالی میشه'
        ],
        'date' => [
            'label' => 'برا کی میخوای بخونی؟ همون تاریخو بزن'
        ],
        'comment' => [
            'label' => 'توضیحات اضافه'
        ]
    ];
}
