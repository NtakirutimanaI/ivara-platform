<?php
namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class StoreMenuRequest extends FormRequest
{
public function authorize(): bool { return $this->user()->can('manage menus'); }
public function rules(): array {
$id = $this->route('menu')?->id;
return [
'title' => ['required','string','max:255'],
'icon' => ['nullable','string','max:255'],
'slug' => ['required','string','max:255','unique:menus,slug,'.($id ?? 'NULL').',id'],
'parent_id' => ['nullable','exists:menus,id'],
'order' => ['nullable','integer','min:0'],
'is_active' => ['boolean'],
'roles' => ['array'],
'roles.*' => ['integer','exists:roles,id'],
];
}
}