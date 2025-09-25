<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'canonical' => [
                    'required', 
                    'unique:routers',
                    fn($a, $v, $fail) => DB::table('post_language')->where('canonical', $v)->exists() && $fail('Đường dẫn đã tồn tại')
                ],
            'post_catalogue_id' => 'gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập vào ô tiêu đề.',
            'canonical.required' => 'Bạn chưa nhập vào ô đường dẫn',
            'canonical.unique' => 'Đường dẫn đã tồn tại trong routers, Hãy chọn đường dẫn khác',
            'post_catalogue_id.gt' => 'Bạn phải nhập vào danh mục cha',
        ];
    }
}
