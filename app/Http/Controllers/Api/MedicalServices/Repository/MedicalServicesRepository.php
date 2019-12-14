<?php


namespace App\Http\Controllers\Api\MedicalServices\Repository;

use App\Http\Controllers\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Api\MedicalServices\Model\MedicalServices;

class MedicalServicesRepository extends Repository
{
    protected $model;

    /**
     * MedicalServicesTypesRepository constructor.
     */
    function __construct()
    {
        return $this->model = new MedicalServices;
    }

    public function getList($pagination = null)
    {
        if (is_null($pagination))
            $pagination = $this->pagination;

        $data = $this->model->select('id', 'name', 'description')
            ->orderBy('id', 'ASC');

        $data = $this->filters($data);

        return $data->paginate($pagination);
    }
}
