<?php

namespace App\Types;

use App\Types\Type;

class Product extends Type
{
    public $name = 'product';

    public $title = 'خرید';

    public $fields = [
        'title' => [
            'label' => 'اسم چیزی که میخوای بهش برسی رو بنویس'
        ],
        'link' => [
            'label' => 'اگه لینک از صفحه محصولی که میخوایو بزاری که عالی میشه'
        ],
        'price' => [
            'label' => 'قیمت چیزی که میخوای بگیری چقدره؟ (اگه محصول نیست خالی بزارش)'
        ],
        'date' => [
            'label' => 'برا کی میخوای بهش برسی؟ همون تاریخو بزن'
        ],
        'comment' => [
            'label' => 'چیز اضافه ای که میخوای بنویسی'
        ]
    ];
}
