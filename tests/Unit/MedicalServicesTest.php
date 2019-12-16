<?php

namespace Tests\Unit;

use Tests\TestCase;

class MedicalServicesTest extends TestCase
{
    private $token;

    /**
     * get access token and set it in token var.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->token = $this->testAgentLogin('first10@first.com');
    }


    public function testAgentLogin($email)
    {
        $response = $this->post(
            '/api/agent/login',
            [
                'email' => 'first10@first.com',
                'password' => '123456'
            ]
        );
        $response->assertStatus(200);
        $response->assertJsonStructure([
            "response" => [
                "agent_token" => [
                    "token_type", "expires_in", "access_token", "refresh_token"
                ]
            ]
        ]);
        return \json_decode($response->getContent())->response->agent_token->access_token;
    }


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

    public function testCreateMedicalServiceSuccessResponse()
    {
        $response = $this->post(
            'api/agents/medical-services/create',
            [
                'name' => 'test rere',
                'description' => 'test test',
            ],
            [
                'Authorization' => 'Bearer' .$this->token
            ]
        );

        $response->assertStatus(201);
        $response->assertJsonStructure([
            "response" =>
                [
                    "action"
                ]
        ]);
    }

    public function testCreateMedicalServiceError400Response()
    {
        $response = $this->post(
            'api/agents/medical-services/create',
            [
                'name' => 'test rerjkshfksdhfkdshfkdshkfhdskfhsdkfjksdjfksdjfkdsjfkjdskfjdskfjkdsjfkdsjkfjdskfjsdkfjkerjkewjfkdsjfkdsjfkjdskfjdskfjdskfjksdjfksdjfksjddkfjksdfjksdjfksdjfkdsjfksjdkfjsdkfjsdkfjkdsjfke',
                'description' => 'test test',
            ],
            [
                'Authorization' => 'Bearer' .$this->token
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            "status",
            "errors" => [
                [
                    "message",
                    "code"
                ]
            ]
        ]);
    }
}
