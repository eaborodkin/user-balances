<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\Enums\OrderEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class HistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'search' => trim(strtolower($this->string('search')->toString())),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order'=>[new Enum(OrderEnum::class)],
            'search'=>'string',
        ];
    }
}
