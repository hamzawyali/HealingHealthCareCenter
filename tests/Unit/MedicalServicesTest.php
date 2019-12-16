<?php

namespace Tests\Unit;

use Tests\TestCase;

class MedicalServicesTest extends TestCase
{
    public function testMedicalServicesListSuccessResponse()
    {

        $response = $this->post(
            'api/patients/medical-services/list'
        );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "response" => [
                "current_page",
                "data" => [
                    [
                        "id",
                        "name",
                        "description",
                    ]
                ],
                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total"
            ]
        ]);
    }


    public function testMedicalServicesError400Response()
    {

        $response = $this->post(
            'api/patients/medical-services/list',
            [
                'id' => 'string string string'
            ]
        );
        $response->assertStatus(400);
        $response->assertJsonStructure([
            "error" => [
                "id"
            ]
        ]);
    }
}
