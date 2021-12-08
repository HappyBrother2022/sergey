<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HistoricDataUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'open' => ['required', 'numeric'],
            'close' => ['required', 'numeric'],
            'low' => ['required', 'numeric'],
            'high' => ['required', 'numeric'],
            'adjusted_close' => ['required', 'numeric'],
            'volume' => ['required', 'numeric']
        ];
    }
}
