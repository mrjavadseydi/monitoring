<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditActionRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "title"    => "required",
            "date"     => "required",
            "delivery" => "required",
            "program"  => "required",
            'repeat_count'=>'integer',
            'repeat_done'=>'integer'

        ];
    }
}
