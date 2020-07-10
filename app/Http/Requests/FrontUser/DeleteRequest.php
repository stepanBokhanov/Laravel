<?php

namespace Modules\Core\Http\Requests\School;

use Modules\Core\Entities\School;
use Modules\Core\Http\Requests\BaseRequest;

class DeleteRequest extends BaseRequest
{

    public function authorize()
    {
        $user = superadmin();

        $school = School::withoutGlobalScope('active')
            ->where('id', $this->route('school'))
            ->first();

        return $school && $user !== null;
    }

    public function rules()
    {
        return [
            //
        ];
    }

}
