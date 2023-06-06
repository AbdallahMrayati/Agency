<?php

namespace App\Http\Requests\Admin\Roles;

use Illuminate\Foundation\Http\FormRequest;

class RolesUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->can("blogAdd")) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $role_id = $this->route("role_permission");
        return [
            "permissions" => ["required"],
            "permissions.*" => ["exists:permissions,name"],
            "role" => ["required", "unique:roles,name", ". $role_id", "max:60"],
        ];
    }
}
