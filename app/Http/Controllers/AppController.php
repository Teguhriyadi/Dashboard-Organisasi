<?php

namespace App\Http\Controllers;

use App\Http\Helper\ApiHelper;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function templating()
    {
        return view("pages.layouts.main");
    }

    public function dashboard()
    {
        try {

            DB::beginTransaction();

            $client = new Client([
                "timeout" => 10
            ]);

            $data = [];

            $responder = $client->get(ApiHelper::apiUrl("/organization/account/responder/" . session("data")["member_account_code"] . "/admin"));
            $user = $client->get(ApiHelper::apiUrl("/organization/account/user/" . session("data")["member_account_code"] . "/admin"));

            $internal = $client->get(ApiHelper::apiUrl("/organization/account/admin/" . session("data")["username"] . "/show"));
            $internalBody = json_decode($internal->getBody(), true);

            $responderBody = json_decode($responder->getBody(), true);
            $userBody = json_decode($user->getBody(), true);

            DB::commit();

            if ($responderBody["statusCode"] == 200 && $userBody["statusCode"] == 200 && $internalBody["statusCode"] == 200) {

                $data["showDetail"] = $internalBody["data"];
                $data["totalResponder"] = $responderBody["total"];
                $data["totalUser"] = $userBody["total"];

                return view("pages.dashboard", $data);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => $responderBody["message"]
                ]);
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }
}
