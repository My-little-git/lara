<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'image' => ['required', 'string'],
            'category' => ['required', 'array'],
            'category.id' => ['integer', 'exists:categories,id'],
            'category.name' => ['required', 'string'],
            'tags' => ['array'],
            'tags.*.id' => ['integer', 'exists:tags,id'],
            'tags.*.name' => ['string'],
        ];
    }
}
