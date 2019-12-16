<?php
namespace App\Http\Controllers\Api\Booking\Controller;

use Illuminate\Http\Request;

interface BookingInterFace
{

    /**
     * @api {post} /api/patients/booking/create Create
     * @apiName Create
     * @apiGroup Booking
     *
     * @apiParam {integer} medical_services_id integer.
     * @apiParam {string} notes string and max length 500.
     * @apiParam {date} date_time date format Y-m-d H:i:s.
     * @apiParam {array} patient array.
     * @apiParam {string} patient.name string and max length 255.
     * @apiParam {email} patient.email email.
     * @apiParam {string} patient.phone string and max length 15.
     * @apiParam {date_format} created_at.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
    {
    "response": {
    "action": "Created"
    }
    }
    }
     * @apiErrorExample {json} Error-Response 400:
    {
    "error": {
    "email": [
    {
    "message": "The phone may not be greater than 15 characters.",
    "code": "name_max_string_error"
    }
    ]
    }
    }
     * @apiSampleRequest /api/patients/booking/create
     */

    public function create(Request $request);

    /**
     * @api {post} /api/patients/booking/list Create
     * @apiName List
     * @apiGroup Booking
     *
     * @apiParam {integer} medical_services_id integer.
     * @apiParam {string} notes string and max length 500.
     * @apiParam {date} date_time date format Y-m-d H:i:s.
     * @apiParam {array} patient array.
     * @apiParam {string} patient.name string and max length 255.
     * @apiParam {email} patient.email email.
     * @apiParam {string} patient.phone string and max length 15
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
    {
    "id": 1,
    "patient_id": 1,
    "medical_services_id": 1,
    "date_time": "2019-12-30 16:00:00",
    "notes": "asdasdasdasdasdsad",
    "patient": {
    "id": 1,
    "name": "first patient",
    "phone": "201007353273",
    "email": "hamza.alidarwesh@gmail.com"
    },
    "medical_services": {
    "id": 1,
    "name": "Dental care",
    "description": "Dental care Dental care Dental care Dental care Dental care Dental care"
    }
    },
    }
     * @apiErrorExample {json} Error-Response 400:
    {
    "error": {
    "email": [
    {
    "message": "The name may not be greater than 100 characters.",
    "code": "name_max_string_error"
    }
    ]
    }
    }
     * @apiSampleRequest /api/patients/booking/list
     */

    public function list(Request $request);
}
