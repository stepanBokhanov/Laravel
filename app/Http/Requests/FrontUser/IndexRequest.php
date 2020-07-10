<?php

namespace Modules\Core\Http\Requests\School;

use Modules\Core\Http\Requests\BaseRequest;

class IndexRequest extends BaseRequest
{
    
    public function authorize()
    {
        $user = superadmin();

        return $user !== null;
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
