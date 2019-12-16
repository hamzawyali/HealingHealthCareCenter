<?php


namespace App\Http\Controllers\Api\Invoices\Repository;

use App\Http\Controllers\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Api\Invoices\Model\Invoices;


class InvoicesRepository extends Repository
{

    /**
     * InvoicesRepository constructor.
     */
    function setModelName()
    {
        return new Invoices;
    }

    public function getList($pagination = null)
    {
        if (is_null($pagination))
            $pagination = $this->pagination;

        $data = $this->model->select('id', 'agent_id', 'patient_id', 'status', 'original_amount', 'discount', 'total_amount')
            ->orderBy('id', 'ASC');

        $data = $this->filters($data);

        return $data->paginate($pagination);
    }

    public function check48Hours()
    {
        $checkTime = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " -2 days"));
        return $this->model->where('status', 'pending')
            ->where('created_at', '<=', $checkTime)
            ->where('is_notification', 0)
            ->with([
                'Patient' => function ($patient) {
                    $patient->select('id','name', 'email', 'phone');
                }
            ])
            ->get();
    }
}
