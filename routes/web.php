<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/detalhes-contrato/{id}', [App\Http\Controllers\Admin\OsController::class, 'attedsByContract'])->name('OS.contract');

    Route::get('/admin/atendimentos', [App\Http\Controllers\Admin\AttendController::class, 'index'])->name('attend');

    Route::get('/admin/getCalendario', [App\Http\Controllers\Admin\AttendController::class, 'calendar'])->name('attend.calendar');

    Route::put('/admin/changeStatus/{id}', [App\Http\Controllers\Admin\AttendController::class, 'changeStatus'])->name('attend.changeStatus');

    Route::get('/admin/atendimentos/detalhes/{id}', [App\Http\Controllers\Admin\AttendController::class, 'show'])->name('attend.show');

    Route::post('/admin/atendimentos/novolog/', [App\Http\Controllers\Admin\StatusLogController::class, 'store'])->name('log.store');

    Route::DELETE('/admin/atendimentos/deleteimg/{id}', [App\Http\Controllers\Admin\ImgLogController::class, 'destroy'])->name('imglog.destroy');
    
    Route::post('/admin/atendimentos/detalhes', [App\Http\Controllers\Admin\ImgLogController::class, 'store'])->name('imglog.store');

    Route::group(['middleware'=>'can:view_service_demands'], function(){
        
        //SERVICOS
        Route::get('/admin/servicos', [App\Http\Controllers\Admin\ServicesController::class, 'index'])->name('service');
        Route::get('/admin/servicos/novo', [App\Http\Controllers\Admin\ServicesController::class, 'create'])->name('service.create');
        Route::Post('/admin/servicos/novo', [App\Http\Controllers\Admin\ServicesController::class, 'store'])->name('service.store');
        Route::get('/admin/servicos/editar/{id}', [App\Http\Controllers\Admin\ServicesController::class, 'edit'])->name('service.edit');
        Route::put('/admin/servicos/editar/{id}', [App\Http\Controllers\Admin\ServicesController::class, 'update'])->name('service.update');
        Route::DELETE('/admin/servicos/excluir/{id}', [App\Http\Controllers\Admin\ServicesController::class, 'destroy'])->name('service.destroy');

        //ORDENS DE SERVIÇO
        Route::get('/admin/OS', [App\Http\Controllers\Admin\OsController::class, 'index'])->name('OS');
        Route::put('/admin/accept/{id}', [App\Http\Controllers\Admin\OsController::class, 'accept'])->name('accept.OS');
        Route::get('/admin/OS/novo', [App\Http\Controllers\Admin\OsController::class, 'create'])->name('OS.create');
        Route::Post('/admin/OS/novo', [App\Http\Controllers\Admin\OsController::class, 'store'])->name('OS.store');
        Route::get('/admin/OS/editar/{id}', [App\Http\Controllers\Admin\OsController::class, 'edit'])->name('OS.edit');
        Route::put('/admin/OS/editar/{id}', [App\Http\Controllers\Admin\OsController::class, 'update'])->name('OS.update');
        Route::DELETE('/admin/OS/excluir/{id}', [App\Http\Controllers\Admin\OsController::class, 'destroy'])->name('OS.destroy');
        Route::get('/admin/OS/getData', [App\Http\Controllers\Admin\OsController::class, 'getData'])->name('OS.getData');
        Route::get('/admin/OS/generalReport', [App\Http\Controllers\Admin\OsController::class, 'export'])->name('OS.export');

        //Usuários
        Route::get('/admin/detalhes-cadastro/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('user.view');
        Route::get('/admin/cadastros', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
        Route::get('/admin/cadastros/novo', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
        Route::Post('/admin/cadastros/novo', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
        Route::get('/admin/cadastros/editar/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
        Route::put('/admin/cadastros/editar/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
        Route::DELETE('/admin/cadastros/excluir/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/admin/cadastros/export', [App\Http\Controllers\Admin\UserController::class, 'export'])->name('user.export');

        //Atendimentos
        Route::get('/admin/atendimentos/novo', [App\Http\Controllers\Admin\AttendController::class, 'create'])->name('attend.create');
        Route::post('/admin/atendimentos/novo', [App\Http\Controllers\Admin\AttendController::class, 'store'])->name('attend.store');
        Route::get('/admin/atendimentos/editar/{id}', [App\Http\Controllers\Admin\AttendController::class, 'edit'])->name('attend.edit');
        Route::put('/admin/atendimentos/editar/{id}', [App\Http\Controllers\Admin\AttendController::class, 'update'])->name('attend.update');
        Route::DELETE('/admin/deletar/atendimento/{id}', [App\Http\Controllers\Admin\AttendController::class, 'destroy'])->name('attend.destroy');
        Route::put('/admin/atendimentos/agendar/{id}', [App\Http\Controllers\Admin\AttendController::class, 'scheduling'])->name('attend.scheduling');




        //STATUS
        Route::get('/admin/status', [App\Http\Controllers\Admin\StatusController::class, 'index'])->name('status');
        Route::get('/admin/status/novo', [App\Http\Controllers\Admin\StatusController::class, 'create'])->name('status.create');
        Route::Post('/admin/status/novo', [App\Http\Controllers\Admin\StatusController::class, 'store'])->name('status.store');
        Route::get('/admin/status/editar/{id}', [App\Http\Controllers\Admin\StatusController::class, 'edit'])->name('status.edit');
        Route::put('/admin/status/editar/{id}', [App\Http\Controllers\Admin\StatusController::class, 'update'])->name('status.update');
        Route::DELETE('/admin/status/excluir/{id}', [App\Http\Controllers\Admin\StatusController::class, 'destroy'])->name('status.destroy');

        //TIPOS
        Route::get('/admin/tipos', [App\Http\Controllers\Admin\TypeController::class, 'index'])->name('type');
        Route::get('/admin/tipos/novo', [App\Http\Controllers\Admin\TypeController::class, 'create'])->name('type.create');
        Route::Post('/admin/tipos/novo', [App\Http\Controllers\Admin\TypeController::class, 'store'])->name('type.store');
        Route::get('/admin/tipos/editar/{id}', [App\Http\Controllers\Admin\TypeController::class, 'edit'])->name('type.edit');
        Route::put('/admin/tipos/editar/{id}', [App\Http\Controllers\Admin\TypeController::class, 'update'])->name('type.update');
        Route::DELETE('/admin/tipos/excluir/{id}', [App\Http\Controllers\Admin\TypeController::class, 'destroy'])->name('type.destroy');

        //SITUAÇÃO DE OS
        Route::get('/admin/situation', [App\Http\Controllers\Admin\SituationController::class, 'index'])->name('situation');

        //cadastrar imagem na OS
        Route::post('/admin/addimage', [App\Http\Controllers\Admin\ImgContractController::class, 'store'])->name('imageContract.store');
        Route::DELETE('/admin/excluirimagem/{id}', [App\Http\Controllers\Admin\ImgContractController::class, 'destroy'])->name('imageContract.destroy');


        //reviews
        Route::get('/admin/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews');
        Route::post('/admin/reviews/add', [App\Http\Controllers\Admin\ReviewController::class, 'store'])->name('reviews.store');
        Route::DELETE('/admin/reviews/delete/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');


        //status_log
        Route::get('/admin/atendimentos/novolog/', [App\Http\Controllers\Admin\StatusLogController::class, 'create'])->name('log.create');
        Route::get('/admin/atendimentos/editlog/{id}', [App\Http\Controllers\Admin\StatusLogController::class, 'edit'])->name('log.edit');
        Route::put('/admin/atendimentos/editlog/{id}', [App\Http\Controllers\Admin\StatusLogController::class, 'update'])->name('log.update');
        Route::DELETE('/admin/atendimentos/deletelog/{id}', [App\Http\Controllers\Admin\StatusLogController::class, 'destroy'])->name('log.destroy');


        Route::get('/admin/blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog.admin');
        Route::get('/admin/blog/novo', [App\Http\Controllers\PostController::class, 'create'])->name('blog.create');
        Route::post('/admin/blog/novo', [App\Http\Controllers\PostController::class, 'store'])->name('blog.store');

      });



    


});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('web');

Route::get('/sobre-nos', function () {
    return view('pages.about');
})->name('about');

Route::get('/planos', function () {
    return view('pages.plans');
})->name('plans');

Route::get('/faq', function () {
    return view('pages.faq');
})->name('faq');

Route::get('/contato', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/blog', function () {
    return view('pages.blog-post');
})->name('blog');


Route::get('/blog/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');


Auth::routes(['register' => true]);

