<?php

namespace App\Http\Controllers;

use http\Env\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, GeneralReturn;

    /**
     * user_id
     */
    public $user_id;

    /**
     * Controller constructor.
     *
     */

    public function __construct()
    {
        $prefix = request()->route()->getPrefix(); // ex. api/admin/users
        $divides = explode('/', $prefix);

        $provider = isset($divides[1]) ? $divides[1] : '';
        if ($provider == 'agents' && isset(auth('agents')->user()->id))
            $this->user_id = auth('agents')->user()->id;
    }

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

    public function logRequest(Request $request)
    {

    }

    /*
     * check file or create it
     * update file data
     * log file path variable
     * handle log file data
     * read file data
     */
}
