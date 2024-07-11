<?php

use App\Http\Controllers\Account\AdminController;
use App\Http\Controllers\Account\ProfilController;
use App\Http\Controllers\Account\ResponderController;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Authorization\LoginController;
use App\Http\Controllers\Pengaturan\RoleController;
use App\Http\Controllers\Report\PanicController;
use App\Http\Controllers\Transaksi\HistoryPaymentController;
use App\Http\Controllers\Transaksi\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return redirect()->route("pages.login");
});

Route::get("/templating", [AppController::class, "templating"]);

Route::group(["middleware" => ["guest"]], function () {
    Route::prefix("pages")->group(function () {
        Route::get("/login", [LoginController::class, "login"])->name("pages.login");
        Route::post("/login", [LoginController::class, "postLogin"])->name("pages.login.post-login");
    });
});

Route::group(["middleware" => ["check.session"]], function () {
    Route::prefix("pages")->group(function () {
        Route::get("/dashboard", [AppController::class, "dashboard"])->name("pages.dashboard");
        Route::get("/logout", [LoginController::class, "logout"])->name("pages.logout");
        Route::prefix("account")->group(function () {
            Route::controller(AdminController::class)->group(function () {
                Route::prefix("admin")->group(function () {
                    Route::get("/", "index")->name("pages.accounts.admin.index");
                    Route::post("/", "store")->name("pages.accounts.admin.store");
                    Route::get("/{id}", "show")->name("pages.accounts.admin.show");
                    Route::get("/{id}/upgrade", "upgrade")->name("pages.accounts.admin.upgrade");
                });
            });

            Route::controller(UserController::class)->group(function () {
                Route::prefix("user")->group(function () {
                    Route::get("/", "index")->name("pages.accounts.user.index");
                    Route::get("/{member_account_code}", "indexByAdmin")->name("pages.accounts.user.index-admin");
                    Route::post("/{member_account_code}", "store")->name("pages.accounts.user.store");
                    Route::get("/{idUser}/show", "show")->name("pages.accounts.user.show");
                    Route::post("/{idUser}/change-status", "changeStatus")->name("pages.accounts.user.changeStatus");
                    Route::delete("/{idUser}", "destroy")->name("pages.accounts.user.destroy");
                    Route::put("/{username}", "updateStatus")->name("pages.account.user.update-status");
                });
            });

            Route::controller(ResponderController::class)->group(function () {
                Route::prefix("responder")->group(function () {
                    Route::get("/{member_account_code}", "indexByAdmin")->name("pages.account.responder.index-admin");
                    Route::post("/{member_account_code}", "store")->name("pages.accounts.responder.store");
                    Route::get("/{username}/show", "show")->name("pages.accounts.responder.show");
                    Route::post("/{idUser}/change-status", "changeStatus")->name("pages.accounts.responder.changeStatus");
                    Route::delete("/{idUser}", "destroy")->name("pages.accounts.responder.destroy");
                    Route::put("/{username}", "updateStatus")->name("pages.account.responder.update-status");
                });
            });

            Route::controller(ProfilController::class)->group(function () {
                Route::prefix("profil")->group(function () {
                    Route::get("/", "index")->name("pages.account.profil.index");
                    Route::put("/{member_account_code}", "update")->name("pages.account.profil.update");
                    Route::patch("/{member_acccount_code}/change-password", "changePassword")->name("pages.account.profil.change-password");
                    Route::put("/{member_account_code}/upgrade-paket", "upgradePaket")->name("pages.account.profil.upgradePaket");
                });
            });
        });

        Route::prefix("payment")->group(function() {
            Route::controller(PaymentController::class)->group(function() {
                Route::get("/checkout", "index")->name("pages.payment.checkout.index");
            });
        });

        Route::prefix("report")->group(function () {
            Route::controller(PanicController::class)->group(function () {
                Route::prefix("panic")->group(function () {
                    Route::get("/{member_account_code}", "index")->name("pages.report.panic.index");
                    Route::get("{id_panic}/show", "show")->name("pages.report.panic.show");
                });
            });
        });

        Route::prefix("transaksi")->group(function () {
            Route::controller(HistoryPaymentController::class)->group(function () {
                Route::prefix("history-payment")->group(function () {
                    Route::get("/", "index")->name("pages.transaction.history-payment.index");
                });
            });
        });

        Route::prefix("pengaturan")->group(function () {
            Route::controller(RoleController::class)->group(function () {
                Route::prefix("role")->group(function () {
                    Route::get("/", "index")->name("pages.pengaturan.role.index");
                    Route::post("/", "store")->name("pages.pengaturan.role.store");
                    Route::get("/{id}/edit", "edit")->name("pages.pengaturan.role.edit");
                    Route::delete("/{id}", "destroy")->name("pages.pengaturan.role.destroy");
                });
            });
        });
    });
});
