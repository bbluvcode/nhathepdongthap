<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarauselController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TVGSController;
use App\Http\Middleware\AuthMiddelware;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, "home"])->name("client.home");
Route::get('/du-an', [ProjectController::class, "project"])->name("client.project");
Route::get('/tu-van-giam-sat', [TVGSController::class, "tvgs"])->name("client.tvgs");
Route::get('/lien-he', [ContactController::class, "contact"])->name("client.contact");
//store
Route::get('/bao-gia-tu-van-giam-sat', [PriceController::class, "price"])->name("client.price");
Route::get('/tin-tuc', [NewController::class, "news"])->name("client.news");
Route::get('/tin-tuc/{slug}', [TVGSController::class, "newsDetail"])->name("client.newsDetail");
Route::post('/lien-he/message', [ContactController::class, "messageMail"])->name("client.contact.message");

//tai bao gia
Route::get('/download-price-list', [PriceController::class, 'downloadPriceList'])->name('download.price');
//login
Route::get('/login', [AdminController::class, "login"])->name("admin.login");
Route::post('/login', [AdminController::class, "checkLogin"])->name("admin.checkLogin");
Route::get('/login/otp', [AdminController::class, "viewOTP"])->name("admin.viewOtp");
Route::post('/login/otp', [AdminController::class, "checkOTP"])->name("admin.checkOTP");
//logout
Route::get('/logout', [AdminController::class, "logout"])->name("admin.logout");
Route::prefix('admin')->middleware(AuthMiddelware::class)->group(function () {
    Route::get('/change-pass', [AdminController::class, "formChangePass"])->name("admin.formChangePass");
    Route::post('/change-pass', [AdminController::class, "changePass"])->name("admin.changePass");
    // admin
    Route::get('/', [AdminController::class, "admin"])->name("admin.dashboard");
    //carausel
    Route::get('/carausel', [CarauselController::class, "index"])->name("admin.carausels.index");
    Route::get('/carausel/create', [CarauselController::class, "create"])
        ->name("admin.carausels.create");
    Route::post('/carausel/create', [CarauselController::class, "store"])->name("admin.carausels.store");
    Route::get('/carausel/edit/{id}', [CarauselController::class, "edit"])
        ->name("admin.carausels.edit");
    Route::post('/carausel/edit/{carausel}', [CarauselController::class, "update"])->name("admin.carausels.update");
    Route::get('/carausel/delete/{id}', [CarauselController::class, "delete"])
        ->name("admin.carausels.delete");

    //intro
    Route::get('/intro', [AdminController::class, "homeIntro"])
        ->name("admin.homeIntro");
    Route::post('/intro', [AdminController::class, "storeHomeIntro"])
        ->name("admin.storeHomeIntro");
    Route::post('/intro/{intro}', [AdminController::class, "updateIntro"])
        ->name("admin.updateIntro");
    //video intro
    Route::get('/intro-video', [AdminController::class, "introVideo"])->name("admin.introVideo");
    Route::post('/intro-video/create', [AdminController::class, "storeVideoIntro"])
        ->name("admin.storeVideoIntro");
    Route::post('/intro-video/{introMovie}', [AdminController::class, "updateVideoIntro"])
        ->name("admin.updateVideoIntro");

    //benefit intro
    Route::post('/introBenefit', [AdminController::class, "storeIntroBenefit"])
        ->name("admin.store.benefit");
    Route::get('/introBenefit/{id}', [AdminController::class, "editIntroBenefit"])->name("admin.edit.benefit");
    Route::put('/introBenefit/{id}', [AdminController::class, "updateIntroBenefit"])->name("admin.update.benefit");
    Route::get('/introBenefit/delete/{id}', [AdminController::class, "deleteIntroBenefit"])->name("admin.delete.benefit");

    //cancel form
    Route::get('/cancel/form/{id}', [AdminController::class, "canelForm"])
        ->name("admin.form.cancel");

    //intro
    Route::get('/panel', [AdminController::class, "panelJob"])
        ->name("admin.panelJob.index");
    Route::post('/panel/create', [AdminController::class, "createPanelJob"])
        ->name("admin.panelJob.store");
    Route::get('/panel/{id}', [AdminController::class, "editPanelJob"])
        ->name("admin.panelJob.edit");
    Route::post('/panel/{panelJob}', [AdminController::class, "updatePanelJob"])
        ->name("admin.panelJob.storeUpdate");
    Route::get('/panel/delete/{id}', [AdminController::class, "deletePanelJob"])
        ->name("admin.panelJob.delete");

    //panel image
    Route::get('/panel/detail/{id}', [AdminController::class, "detailPanelJob"])
        ->name("admin.panelJob.detail");
    Route::post('/panel/detail/{id}', [AdminController::class, "storePanelJobImage"])
        ->name("admin.panelJob.storePanelImage");
    Route::post('/panel/image/{panelJobImage}', [AdminController::class, "updatePanelJobImage"])
        ->name("admin.panelJob.updatePanelImage");
    Route::get('/panel/image/edit/{id}', [AdminController::class, "editPanelJobImage"])->name("admin.panelJob.editPanelJobImage");
    Route::get('/panel/image/delete/{id}', [AdminController::class, "deletePanelJobImage"])->name("admin.panelJob.deletePanelJobImage");
    //outstanding
    Route::get('/outstanding', [AdminController::class, "outstanding"])->name("admin.outstanding.index");
    Route::get('/outstanding/{id}', [AdminController::class, "editOutstanding"])->name("admin.outstanding.edit");
    Route::post('/outstanding', [AdminController::class, "storeOutstanding"])->name("admin.outstanding.create");
    Route::post('/outstanding/update/{outstanding}', [AdminController::class, "updateOutstanding"])->name("admin.outstanding.update");

    //feedbacks
    Route::get('/feedback', [AdminController::class, "feedback"])->name("admin.feedback.index");

    Route::get('/feedback/{id}', [AdminController::class, "editFeedback"])->name("admin.feedback.edit");
    Route::post('/feedback', [AdminController::class, "storeFeedback"])->name("admin.feedback.create");
    Route::post('/feedback/update/{feedback}', [AdminController::class, "updateFeedback"])->name("admin.feedback.update");
    Route::get('/feedback/delete/{id}', [AdminController::class, "deleteFeedback"])->name("admin.feedback.delete");
    //TVGS
    Route::get('/tvgs', [TVGSController::class, "viewTvsg"])->name("admin.tvgs.index");
    Route::post('/tvgs/create', [TVGSController::class, "createIntroTVSG"])->name("admin.tvgs.create");
    Route::post('/tvgs/update/{introTVSG}', [TVGSController::class, "updateIntroTVSG"])->name("admin.tvgs.update");
    //POST
//TVGS
    Route::get('/post', [PostController::class, "create"])->name("admin.post.create");
    Route::post('/post', [PostController::class, "store"])->name("admin.post.store");
    Route::get('/post/{id}', [PostController::class, "edit"])->name("admin.post.edit");
    Route::post('/post/{news}', [PostController::class, "updatePost"])->name("admin.post.updatePost");
    Route::get('/post/delete/{id}', [PostController::class, "deletePost"])->name("admin.post.delete");

    //POST ADS
    Route::get('/ads', [PostController::class, "createAds"])->name("admin.ads.create");
    Route::post('/ads', [PostController::class, "storeAds"])->name("admin.ads.store");
    Route::get('/ads/{id}', [PostController::class, "editAds"])->name("admin.ads.edit");
    Route::post('/ads/{ads}', [PostController::class, "updateAds"])->name("admin.ads.update");
    Route::get('/ads/delete/{id}', [PostController::class, "deleteAds"])->name("admin.ads.delete");

    //POST SPECIAL ADS
    Route::get('/specads/{id}', [PostController::class, "editSpecAds"])->name("admin.specads.edit");
    Route::post('/specads/{specialAds}', [PostController::class, "updateSpecAds"])
        ->name("admin.specads.update");
    //Price
    Route::get('/price', [PriceController::class, "index"])->name("admin.price.index");
    Route::get('/price/create', [PriceController::class, "createPrice"])
        ->name("admin.price.create");
    Route::post('/price/create', [PriceController::class, "storePrice"])
        ->name("admin.price.store");
    Route::get('/price/edit/{id}', [PriceController::class, "editPrice"])
        ->name("admin.price.edit");
    Route::post('/price/edit/{price}', [PriceController::class, "updatePrice"])
        ->name("admin.price.update");
    Route::get('/price/delete/{id}', [PriceController::class, "deletePrice"])
        ->name("admin.price.delete");
    Route::post('/price/desnote', [PriceController::class, "storeDesNote"])
        ->name("admin.price.storeDesnote");
    Route::post('admin/price/desnote/edit/{notePrice}', [PriceController::class, 'updateDesnote'])
        ->name('admin.price.updateDesnote');
    //process
    Route::get('/process', [TVGSController::class, "process"])->name("admin.process.index");
    Route::post('/process', [TVGSController::class, "storeProcess"])->name("admin.process.store");
    Route::post('/process/update-order', [TVGSController::class, 'updateOrder'])->name('admin.process.updateOrder');
    Route::post('/process/update-process/{id}', [TVGSController::class, 'updateProcess'])
        ->name('admin.process.updateProcess');
    Route::get('/process/delete-process/{id}', [TVGSController::class, 'deleteItemProcess'])
        ->name('admin.process.deleteProcess');

    //project
    Route::get('/project', [ProjectController::class, "index"])
        ->name("admin.project.index");
    Route::get('/project/create', [ProjectController::class, "create"])
        ->name("admin.project.create");
    Route::post('/project/create', [ProjectController::class, "store"])
        ->name("admin.project.store");
    Route::get('/project/edit/{id}', [ProjectController::class, "edit"])
        ->name("admin.project.edit");
    Route::post('/project/edit/{project}', [ProjectController::class, "update"])
        ->name("admin.project.update");
    Route::get('/project/delete/{id}', [ProjectController::class, "delete"])
        ->name("admin.project.delete");
    //contact
    Route::get('/contact', [ContactController::class, "index"])
        ->name("admin.contact.index");
    Route::get('/contact/{id}', [ContactController::class, "edit"])
        ->name("admin.contact.edit");
    Route::post('/contact/update/{contact}', [ContactController::class, "update"])
        ->name("admin.contact.update");
    Route::get('/message/{id}', [ContactController::class, "delete"])
        ->name("admin.message.delete");

    //quote
    Route::get('/quote', [AdminController::class, "listQuote"])
        ->name("admin.quote.index");
    Route::get('/quote/create', [AdminController::class, "createQuote"])
        ->name("admin.quote.create");
    Route::post('/quote/create', [AdminController::class, "storeQuote"])
        ->name("admin.quote.store");
    Route::get('/quote/edit/{id}', [AdminController::class, "editQuote"])
        ->name("admin.quote.edit");
    Route::post('/quote/edit/{quote}', [AdminController::class, "updateQuote"])
        ->name("admin.quote.update");
     Route::get('/quote/delete/{id}', [AdminController::class, "deleteQuote"])
        ->name("admin.quote.delete");
});
Route::fallback(function () {
    return response()->view('404', [], 404);
});


