<?php

namespace App\Http\Controllers\Api\Agents\Controller;

use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Api\Agents\Repository\AgentsRepository;
use App\Http\Controllers\Api\OauthClients\Model\OauthClients;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgentsController extends Controller
{
    /**
     * @var BookingRepository
     */
    private $agents;


    /**
     * PatientController constructor.
     */
    public function __construct()
    {
        $this->agents = new AgentsRepository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function register(Request $request)
    {
        $check = $this->patientValidator([
            'name' => 'required|string|max:50',
            'email' => 'email|unique:agents,email',
            'password' => 'string|max:20'
        ]);

        if ($check !== true)
            return $check;


        $this->agents->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $oauthClient = OauthClients::find($this->client_id);
        if (!$oauthClient)
            return $this->error401();

        Config::set('auth.guards.api.provider', 'agent');

        $request->request->add([
            'username' => $request->email, // $phone
            'password' => $request->password, // $password
            'grant_type' => 'password',
            'client_id' => $this->client_id,
            'client_secret' => $oauthClient->secret,
            'provider' => 'agent'// 'parents'
        ]);

        $tokenRequest = Request::create(
            '/oauth/token',
            'post'
        );

        $response = \Route::dispatch($tokenRequest);

        if ($response->getStatusCode() == 200) {
            $userToken = json_decode($response->getContent(), true);
            return $this->Success200([
                "agent_token" => $userToken,
            ]);
        }
        return $response;

        return $this->Success201();
    }


    public function login(Request $request)
    {
        $check = $this->patientValidator([
            'email' => 'email|exists:agents,email',
            'password' => 'string|max:20'
        ]);

        if ($check !== true)
            return $check;

        if (auth('agentApi')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])
        ) {
            $oauthClient = OauthClients::find($this->client_id);
            if (!$oauthClient)
                return $this->error401();

            Config::set('auth.guards.api.provider', 'agent');

            $request->request->add([
                'username' => $request->email, // $phone
                'password' => $request->password, // $password
                'grant_type' => 'password',
                'client_id' => $this->client_id,
                'client_secret' => $oauthClient->secret,
                'provider' => 'agent'// 'parents'
            ]);

            $tokenRequest = Request::create(
                '/oauth/token',
                'post'
            );

            $response = \Route::dispatch($tokenRequest);

            if ($response->getStatusCode() == 200) {
                $userToken = json_decode($response->getContent(), true);
                return $this->Success200([
                    "agent_token" => $userToken,
                ]);
            }
            return $response;
        }

        else{
            return $this->error401();
        }
    }
}
