<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
            'seasonsQty' => ['required', 'integer', 'min:1'],
            'episodesPerSeason' => ['required', 'integer', 'min:1'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }

    public function messages(){
        return [
            'name.required' => "O campo nome é obrigatório",
            'name.min' => "Campo nome precisa de pelo menos :min caracteres",
            'seasonsQty.required' => "O campo temporadas é obrigatório",
            'seasonsQty.integer' => "O campo temporadas deve ser um número",
            'seasonsQty.min' => "O campo temporadas deve ser pelo menos 1",
            'episodesPerSeason.required' => "O campo episódios é obrigatório",
            'episodesPerSeason.integer' => "O campo episódios deve ser um número",
            'episodesPerSeason.min' => "O campo episódios deve ser pelo menos 1",
            'cover.image' => "O arquivo deve ser uma imagem",
            'cover.mimes' => "A imagem deve ser do tipo: JPEG, PNG, JPG, GIF ou SVG",
            'cover.max' => "A imagem não pode ter mais que 2MB"
        ];
    }
}
