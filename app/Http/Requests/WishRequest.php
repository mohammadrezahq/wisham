<?php

namespace App\Http\Requests;

use App\Types\Type;
use App\Types\Types;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => ['required', Rule::in(Types::allTypes()) ],
            'title' => 'required|max:100',
            'link' => 'nullable|url',
            'price' => 'nullable|integer',
            'date' => 'required|date',
            'comment' => 'nullable|string|max:140',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'تیتر را باید وارد نمایید.',
            'title.max' => 'تیتر باید حداکثر ۱۰۰ حرف باشد.',
            'link.url' => 'لینک اشتباه می باشد.',
            'date.reqiured' => 'تاریخ را باید وارد نمایید',
            'date.date' => 'تاریخ اشتباه می باشد.',
            'comment.max' => 'توضیحات باید حداکثر ۱۴۰ حرف باشد',
        ];
    }
}
