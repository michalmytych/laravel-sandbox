<?php

namespace App\Http\Requests\Chat\Message;

use Illuminate\Foundation\Http\FormRequest;

class SendRequest extends FormRequest
{
    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function rules(): array
    {
        return [
            'content' => 'required|max:2056'
        ];
    }
}
