<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
       if ( Route::currentRouteName() == 'post.store' ) {
           return true;
       }

       $post = $this->route('post');
       return $post && $this->user()->can('manage', $post);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'title'   => 'required|string|min:5|max:255',
                'body'    => 'required|string|min:50|max:50000',
                'img'     => 'max:1500',
                'category_id' => 'required|exists:categories,id',
        ];
    }
}
