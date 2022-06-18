<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BucketListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'=>'bigInteger',
            'bucket_list_item'=>'required | max:500 |string',
            'is_done'=> boolean
        ];
    }

    public function messages(){

        return[
            'user_id'=>'Invalid data type.',
            'bucket_list_item.required'=>'Input required.',
            'bucket_list_item.max'=>'Input less than 500 letters.',
            'bucket_list_item.string'=>'Data type is invalid.',
            'is_done'=>'Data type is invalid.'
        ];
    }
}
