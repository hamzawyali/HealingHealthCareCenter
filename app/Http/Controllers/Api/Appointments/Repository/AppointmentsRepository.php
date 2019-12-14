<?php


namespace App\Http\Controllers\Api\Appointments\Repository;

use App\Http\Controllers\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Api\Appointments\Model\Appointments;


class AppointmentsRepository extends Repository
{
    protected $model;

    /**
     * AppointmentsRepository constructor.
     */
    function __construct()
    {
        return $this->model = new Appointments;
    }

    public function getList($pagination = null)
    {
        if (is_null($pagination))
            $pagination = $this->pagination;

        $data = $this->model->select('id', 'user_id', 'medical_services_id', 'time')
            ->orderBy('id', 'ASC');

        $data = $this->filters($data);

        return $data->paginate($pagination);
    }
}
