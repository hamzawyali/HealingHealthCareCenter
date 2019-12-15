<?php


namespace App\Http\Controllers\Api\Agents\Repository;


use App\Http\Controllers\Api\Agents\Model\Agents;
use App\Http\Controllers\Repository;

class AgentsRepository extends Repository
{

    function setModelName()
    {
        return new Agents;
    }

}
