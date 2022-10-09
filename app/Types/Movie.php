<?php

namespace App\Types;

use App\Types\Type;

class Movie extends Type
{
    public $name = 'movie';

    public $title = 'فیلم';

    public $fields = [
        'title' => [
            'label' => 'اسم فیلمی که میخوای ببینی رو بنویس'
        ],
        'link' => [
            'label' => 'اگه لینک از Imdb فیلم بزاری که عالی میشه (اینجوری اسم فیلمم خودکار انتخاب میشه)'
        ],
        'date' => [
            'label' => 'برا کی میخوای ببینی؟ همون تاریخو بزن'
        ],
        'comment' => [
            'label' => 'توضیحات اضافه'
        ]
    ];
}
