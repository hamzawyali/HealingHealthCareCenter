<?php

namespace App\Http\Controllers;

trait GeneralReturn
{

    /**
     * 200 - Generic everything is OK
     *
     * @param $data
     *
     * @return mixed json
     */
    protected function Success200($data = null)
    {
        if (is_null($data))
            $data = ["action" => "Done"];

        return response([
            "response" => $data
        ]);
    }


    /**
     * 201 - The request has been fulfilled and has resulted in one or more new resources being created.
     *
     * @return array of json
     */
    protected function Success201()
    {
        return response([
            "response" => ["action" => 'Created']
        ],201);
    }


    /**
     * 202 - Accepted but is being processed async (video is encoding, image is resizing, etc)
     *
     * @return array of json
     */
    protected function Success202()
    {
        return response([
            "response" => ["action" => 'The request has been accepted for processing']
        ], 202);
    }


    /**
     * 400 - Wrong arguments (missing validation)
     *
     * @param $error
     *
     * @return mixed json
     */
    protected function error400($error)
    {
        return response([
            "status_code" => 400,
            'error' => $error->errors()->toArray()
        ], 400);
    }


    /**
     * 401 - Unauthorized (no current user and there should be)
     *
     * @return array of json
     */
    protected function error401()
    {
        return response([
            'error' => [
                'message' => "Unauthorized",
                "code" => "401"
            ]
        ], 401);
    }


    /**
     * 403 - The current user is forbidden from accessing this data
     *
     * @return array of json
     */
    protected function error403()
    {
        return response([
            'error' => [
                'message' => "The current user is forbidden from accessing this data",
                "code" => "403"
            ]
        ], 403);
    }


    /**
     * 404 - That URL is not a valid route, or the item resource does not exist
     *
     * @return array of json
     */
    protected function error404()
    {
        return response([
            'error' => [
                'message' => "That URL is not a valid",
                'code' => "404"
            ]
        ], 404);
    }


    /**
     * 405 - Method Not Allowed (your framework will probably do this for you)
     *
     * @return array of json
     */
    protected function error405()
    {
        return response([
            'error' => [
                'message' => "Method Not Allowed",
                'code' => "405"
            ]
        ], 405);
    }


    /**
     * 410 - Data has been deleted, deactivated, suspended, etc
     *
     * @return array of json
     */
    protected function error410()
    {
        return response([
            'error' => [
                'message' => "Data has been deleted, deactivated, suspended, etc",
//                'code' => "410"
            ]
        ], 410);
    }

    /**
     * Reject the request for some reason.
     *
     * @param string $reason
     *
     * @return array of json
     */
    protected function error411($reason, $code = 411, $data = null)
    {
        $allData = [

            'error' => [
                'message' => $reason, //"code" => $code
            ]
        ];

        if ($data)
            $allData = array_merge($allData, ['response' => $data]);
        return response($allData, $code);
    }


    /**
     * 500 - Something unexpected happened and it is the APIs fault
     *
     * @return array of json
     */
    protected function error500()
    {
        return response([
            'error' => [
                [
                    'error' => "Internal server error",
                    "code" => "500"
                ]
            ]
        ], 500);
    }


    /**
     * 503 - API is not here right now, please try again later
     *
     * @return array of json
     */
    protected function error503()
    {
        return response([
            'error' => [
                [
                    'error' => "API is not here right now, please try again later",
                    "code" => "503"
                ]
            ]
        ], 503);
    }
}
