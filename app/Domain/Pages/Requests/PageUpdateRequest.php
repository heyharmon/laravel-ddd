<?php

namespace DDD\Domain\Pages\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class PageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string',
            'url' => [
                'nullable',
                'string',
                Rule::unique('pages')->ignore($this->route('page')),
            ],
            'http_status' => 'nullable|integer',
            'wordcount' => 'nullable|integer',
            'category' => 'nullable|string',
        ];
    }

    /**
     * Return exception as json
     *
     * @return Exception
     */
    protected function failedValidation(Validator $validator): Exception
    {
        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
