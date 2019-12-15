<?php

namespace App\Http\Controllers\Api\Payment\Controller;

use App\Http\Controllers\Api\Paymebt\Repository\PaymentRepository;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function callback(Request $request, $providerName)
    {
        $data = $request->all();
        $this->callPayment($providerName, $data);
        return $this->Success202();
    }

    private function callPayment($providerName, $data)
    {
        $className = "App\Http\Controllers\Api\Payment\\" . $providerName;
        return new $className($data);
    }
}
