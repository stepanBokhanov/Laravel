<?php
namespace App\Http\Requests\Admin\Department;

use Illuminate\Support\Facades\Request;
class DeleteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        $admin = admin();
        // If country code does not match and do not have permission to delete answer
        return admin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

}
