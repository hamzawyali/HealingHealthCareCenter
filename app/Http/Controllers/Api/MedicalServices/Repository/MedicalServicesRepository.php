<?php


namespace App\Http\Controllers\Api\MedicalServices\Repository;

use App\Http\Controllers\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Api\MedicalServices\Model\MedicalServices;

class MedicalServicesRepository extends Repository
{

    /**
     * set class model name.
     * @return MedicalServices
     */
    function setModelName()
    {
        return new MedicalServices;
    }

    /**
     * get medical services list.
     * @param null $pagination
     * @return mixed
     */
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
