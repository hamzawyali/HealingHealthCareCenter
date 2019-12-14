<?php


namespace App\Http\Controllers\Api\Invoices\Repository;

use App\Http\Controllers\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Api\Invoices\Model\Invoices;


class InvoicesRepository extends Repository
{
    protected $model;

    /**
     * MedicalServicesTypesRepository constructor.
     */
    function __construct()
    {
        return $this->model = new Invoices;
    }

    public function getList($pagination = null)
    {
        if (is_null($pagination))
            $pagination = $this->pagination;

        $data = $this->model->select('id', 'agent_id', 'appointment_id', 'status', 'original_amount', 'discount')
            ->orderBy('id', 'ASC');

        $data = $this->filters($data);

        return $data->paginate($pagination);
    }
}
