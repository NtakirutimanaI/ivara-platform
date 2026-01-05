<?php
namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class StorePageRequest extends FormRequest
{
public function authorize(): bool { return $this->user()->can('manage pages'); }
public function rules(): array {
return [
'menu_id' => ['required','exists:menus,id'],
'title' => ['required','string','max:255'],
'content' => ['nullable','string'],
];
}
}