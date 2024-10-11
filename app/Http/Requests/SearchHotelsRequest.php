<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchHotelsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'checkin' => 'sometimes',
            'checkout' => 'sometimes',
            'region_id' => 'required|int',
            'adults' => 'required|int',
            'children' => 'required|int'
        ];
    }

    public function getHash(): string
    {
        return md5(implode($this->validated()));
    }
}
