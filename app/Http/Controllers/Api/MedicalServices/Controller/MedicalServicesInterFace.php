<?php
namespace App\Http\Controllers\Api\MedicalServices\Controller;

use Illuminate\Http\Request;

interface MedicalServicesInterFace
{

    /**
     * @api {post} /api/patients/medical-services/list List
     * @apiName List
     * @apiGroup Medical Services
     *
     * @apiParam {integer} pagination integer.
     * @apiParam {integer} id integer.
     * @apiParam {string} name string and max length 100.
     * @apiParam {string} description string and max length 255.
     * @apiParam {date_format} created_at.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
    {
    "response": {
    "current_page": 1,
    "data": [
    {
    "id": 1,
    "name": "Dental care",
    "description": "Dental care Dental care Dental care Dental care Dental care Dental care"
    },
    {
    "id": 2,
    "name": "Laboratory and diagnostic carerrrr",
    "description": "eewreewrewreyyyy"
    {
    "id": 3,
    "name": "Substance abuse treatment",
    "description": "eewreewrewre"
    }
    ],
    "first_page_url": "http://localhost:8000/api/patients/medical-services/list?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/patients/medical-services/list?page=1",
    "next_page_url": null,
    "path": "http://localhost:8000/api/patients/medical-services/list",
    "per_page": 10,
    "prev_page_url": null,
    "to": 3,
    "total": 3
    }
     * @apiErrorExample {json} Error-Response 400:
    {
    "error": {
    "email": [
    {
    "message": "The description may not be greater than 255 characters.",
    "code": "name_max_string_error"
    }
    ]
    }
    }
     * @apiSampleRequest /api/medical-services/list
     */

    public function list(Request $request);

    /**
     * @api {post} /api/agents/medical-services/create Create
     * @apiName Create
     * @apiGroup Medical Services
     *
     * @apiParam {string} name string and max length 100.
     * @apiParam {string} description string and max length 255.
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
    "message": "The name may not be greater than 100 characters.",
    "code": "name_max_string_error"
    }
    ]
    }
    }
     * @apiSampleRequest /api/agents/medical-services/create
     */

    public function create(Request $request);

    /**
     * @api {post} /api/agents/medical-services/update Update
     * @apiName Update
     * @apiGroup Medical Services
     *
     * @apiParam {string} name string and max length 100.
     * @apiParam {string} description string and max length 255.
     *
     * @apiSuccessExample {json} Success-Response:
     *     HTTP/1.1 200 OK
    {
    "response": {
    "action": "The request has been accepted for processing"
    }
    }
     * @apiErrorExample {json} Error-Response 401:
     *     HTTP/1.1 401 Not Found
    {
    "error": {
    "message": "Unauthorized",
    "code": 401
    }
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
     * @apiSampleRequest /api/agents/medical-services/update
     */

    public function update($id, Request $request);
}
