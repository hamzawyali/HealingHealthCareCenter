<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, GeneralReturn;

    /**
     * check data.
     *
     * @param $roles
     *
     * @param null $data
     *
     * @return bool|mixed
     */
    protected function patientValidator($roles, $data = null)
    {
        if (is_null($data))
            $data = request()->all();

        $validator = validator($data, $roles);

        if ($validator->fails())
            return $this->error400($validator);
        else
            return true;
    }
}
