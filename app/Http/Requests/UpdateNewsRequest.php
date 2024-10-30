<?php

namespace App\Http\Requests;

use Closure;
use App\Models\News;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            //
            'id' => 'exists:news,id',
            'slug' => [
                'required',
                function(string $attribute,mixed $value, Closure $fail)
                {
                    $slug = News::where('slug','=',$value)
                    ->where('id','!=',$this->route()->id)
                    ->pluck('slug')->first();
                    if($value == $slug)
                    {
                        $fail("This {$attribute} is already in use");
                    }
                }
            ],
            'title_en' => [
                'required',
                'regex:/^[a-zA-Z0-9\s]+$/'
            ],
            'content_en' => [
                'required',
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:500'
            ],
            'title_vi' => [
                'required',
                'regex:/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđĐ0-9\s]+$/'
            ],
            'content_vi' => [
                'required',
                'regex:/^[a-zA-ZàáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđĐ0-9\s]+$/',
                'max:500'
            ],
            'title_zh' => [
                'required',
                'regex:/^[\p{Han}0-9\s]+$/u'
            ],
            'content_zh' => [
                'required',
                'regex:/^[\p{Han}0-9\s]+$/u',
                'max:500'
            ]
        ];
    }
}
