<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        try {

            DB::beginTransaction();

            $data = [];

            $user = Http::timeout(10)->get(ApiHelper::apiUrl("/organization/account/user/all"));

            if ($user->successful()) {
                $responseBody = $user->json();

                if ($responseBody["statusCode"] == 200) {

                    $data["user"] = $responseBody["data"];
                } else {
                    return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
                }
            } else {
                return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
            }

            DB::commit();

            return view("pages.account.user.index", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function indexByAdmin($member_account_code)
    {
        try {

            DB::beginTransaction();

            $data = [];

            $user = Http::timeout(10)->get(ApiHelper::apiUrl("/organization/account/user/" . $member_account_code . "/admin"));

            if ($user->successful()) {
                $responseBody = $user->json();

                if ($responseBody["statusCode"] == 200) {

                    $data["user"] = $responseBody["data"];
                } else {
                    return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
                }
            } else {
                return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
            }

            DB::commit();

            return view("pages.account.user.index", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function store(Request $request, $member_account_code)
    {
        try {

            DB::beginTransaction();

            $response = Http::timeout(10)->post(ApiHelper::apiUrl("/organization/account/admin/" . $member_account_code . "/create_user"), $request->all());

            DB::commit();

            $responseBody = $response->json();

            if ($responseBody["statusCode"] == 201) {
                return back()->with("success", "Data Berhasil di Simpan");
            } else {
                return back()->with("error", $responseBody["message"]);
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function show($idUser)
    {
        try {

            DB::beginTransaction();

            $data = [];

            $user = Http::timeout(10)->get(ApiHelper::apiUrl("/organization/account/user/" . $idUser . "/show"));

            if ($user->successful()) {
                $responseBody = $user->json();

                if ($responseBody["statusCode"] == 200) {

                    $data["detail"] = $responseBody;
                } else {

                    return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
                }
            } else {
                return redirect()->route("pages.dashboard")->with("error", "Terjadi Kesalahan");
            }

            DB::commit();

            return view("pages.account.user.detail", $data);
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with("error", $e->getMessage());
        }
    }

    public function destroy($idUser)
    {
        try {

            DB::beginTransaction();

            $response = Http::timeout(10)->delete(ApiHelper::apiUrl("/organization/account/user/" . $idUser . "/delete/admin"));

            DB::commit();

            $responseBody = $response->json();

            if ($responseBody["statusCode"] == 200) {
                return back()->with("success", "Data Berhasil di Hapus");
            } else {
                return back()->with("error", $responseBody["message"]);
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->route("pages.dashboard")->with("error", $e->getMessage());
        }
    }

    public function changeStatus(Request $request, $idUser)
    {
        try {

            DB::beginTransaction();

            $response = Http::timeout(10)->put(ApiHelper::apiUrl("/organization/account/user/" . $idUser . "/put/account_status"));

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Data Berhasil di Simpan",
                "data" => $response
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }

    public function updateStatus($username)
    {
        try {

            DB::beginTransaction();

            $response = Http::put(ApiHelper::apiUrl("/organization/account/user/" . $username . "/put/account_status"));

            DB::commit();

            $responseBody = $response->json();

            if ($responseBody["statusCode"] == 200) {

                return response()->json([
                    "status" => true,
                    "message" => $responseBody["message"]
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => $responseBody["message"]
                ]);
            }
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => $e->getMessage()
            ]);
        }
    }
}
