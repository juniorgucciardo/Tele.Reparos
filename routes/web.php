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

    Route::get('/operacional', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/operacional/detalhes-contrato/{id}', [App\Http\Controllers\Admin\OsController::class, 'attedsByContract'])->name('OS.contract');
    Route::any('/operacional/atendimentos', [App\Http\Controllers\Admin\AttendController::class, 'index'])->name('attend');
    Route::get('/operacional/getCalendario', [App\Http\Controllers\Admin\AttendController::class, 'calendar'])->name('attend.calendar');
    Route::put('/operacional/changeStatus/{id}', [App\Http\Controllers\Admin\AttendController::class, 'changeStatus'])->name('attend.changeStatus');
    Route::get('/operacional/atendimentos/detalhes/{id}', [App\Http\Controllers\Admin\AttendController::class, 'show'])->name('attend.show');
    Route::post('/operacional/atendimentos/novolog/', [App\Http\Controllers\Admin\StatusLogController::class, 'store'])->name('log.store');
    Route::DELETE('/operacional/atendimentos/deleteimg/{id}', [App\Http\Controllers\Admin\ImgLogController::class, 'destroy'])->name('imglog.destroy');
    Route::post('/operacional/atendimentos/detalhes', [App\Http\Controllers\Admin\ImgLogController::class, 'store'])->name('imglog.store');
    //view profile
    Route::get('/administrativo/detalhes-cadastro/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('user.view');
    Route::get('/operacional/calendario', [App\Http\Controllers\Admin\AttendController::class, 'calendarView'])->name('attend.calendarView');

    //Admin routes
    Route::group(['middleware'=>'can:view_service_demands'], function(){
        
        
        //ORDENS DE SERVIÇO
        Route::get('/operacional/OS', [App\Http\Controllers\Admin\OsController::class, 'index'])->name('OS');
        Route::put('/operacional/accept/{id}', [App\Http\Controllers\Admin\OsController::class, 'accept'])->name('accept.OS');
        Route::get('/operacional/OS/novo', [App\Http\Controllers\Admin\OsController::class, 'create'])->name('OS.create');
        Route::Post('/operacional/OS/novo', [App\Http\Controllers\Admin\OsController::class, 'store'])->name('OS.store');
        Route::get('/operacional/OS/editar/{id}', [App\Http\Controllers\Admin\OsController::class, 'edit'])->name('OS.edit');
        Route::put('/operacional/OS/editar/{id}', [App\Http\Controllers\Admin\OsController::class, 'update'])->name('OS.update');
        Route::DELETE('/operacional/OS/excluir/{id}', [App\Http\Controllers\Admin\OsController::class, 'destroy'])->name('OS.destroy');
        Route::get('/operacional/OS/getData', [App\Http\Controllers\Admin\OsController::class, 'getData'])->name('OS.getData');
        Route::get('/operacional/OS/generalReport', [App\Http\Controllers\Admin\OsController::class, 'export'])->name('OS.export');

        //Atendimentos
        Route::get('/operacional/atendimentos/novo', [App\Http\Controllers\Admin\AttendController::class, 'create'])->name('attend.create');
        Route::post('/operacional/atendimentos/novo', [App\Http\Controllers\Admin\AttendController::class, 'store'])->name('attend.store');
        Route::get('/operacional/atendimentos/editar/{id}', [App\Http\Controllers\Admin\AttendController::class, 'edit'])->name('attend.edit');
        Route::put('/operacional/atendimentos/editar/{id}', [App\Http\Controllers\Admin\AttendController::class, 'update'])->name('attend.update');
        Route::DELETE('/operacional/deletar/atendimento/{id}', [App\Http\Controllers\Admin\AttendController::class, 'destroy'])->name('attend.destroy');
        Route::put('/operacional/atendimentos/agendar/{id}', [App\Http\Controllers\Admin\AttendController::class, 'scheduling'])->name('attend.scheduling');

         //Usuários
         Route::get('/configuracoes/cadastros', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
         Route::get('/configuracoes/cadastros/novo', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
         Route::Post('/configuracoes/cadastros/novo', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('user.store');
         Route::get('/configuracoes/cadastros/editar/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
         Route::put('/configuracoes/cadastros/editar/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('user.update');
         Route::DELETE('/configuracoes/cadastros/excluir/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.destroy');
         Route::get('/configuracoes/cadastros/export', [App\Http\Controllers\Admin\UserController::class, 'export'])->name('user.export');

        //SERVICOS
        Route::any('/configuracoes/servicos', [App\Http\Controllers\Admin\ServicesController::class, 'index'])->name('service');
        Route::get('/configuracoes/servicos/novo', [App\Http\Controllers\Admin\ServicesController::class, 'create'])->name('service.create');
        Route::Post('/configuracoes/servicos/novo', [App\Http\Controllers\Admin\ServicesController::class, 'store'])->name('service.store');
        Route::get('/configuracoes/servicos/editar/{id}', [App\Http\Controllers\Admin\ServicesController::class, 'edit'])->name('service.edit');
        Route::put('/configuracoes/servicos/editar/{id}', [App\Http\Controllers\Admin\ServicesController::class, 'update'])->name('service.update');
        Route::DELETE('/configuracoes/servicos/excluir/{id}', [App\Http\Controllers\Admin\ServicesController::class, 'destroy'])->name('service.destroy');

        //STATUS
        Route::get('/configuracoes/status', [App\Http\Controllers\Admin\StatusController::class, 'index'])->name('status');
        Route::get('/configuracoes/status/novo', [App\Http\Controllers\Admin\StatusController::class, 'create'])->name('status.create');
        Route::Post('/configuracoes/status/novo', [App\Http\Controllers\Admin\StatusController::class, 'store'])->name('status.store');
        Route::get('/configuracoes/status/editar/{id}', [App\Http\Controllers\Admin\StatusController::class, 'edit'])->name('status.edit');
        Route::put('/configuracoes/status/editar/{id}', [App\Http\Controllers\Admin\StatusController::class, 'update'])->name('status.update');
        Route::DELETE('/configuracoes/status/excluir/{id}', [App\Http\Controllers\Admin\StatusController::class, 'destroy'])->name('status.destroy');

        //TIPOS
        Route::get('/configuracoes/tipos', [App\Http\Controllers\Admin\TypeController::class, 'index'])->name('type');
        Route::get('/configuracoes/tipos/novo', [App\Http\Controllers\Admin\TypeController::class, 'create'])->name('type.create');
        Route::Post('/configuracoes/tipos/novo', [App\Http\Controllers\Admin\TypeController::class, 'store'])->name('type.store');
        Route::get('/configuracoes/tipos/editar/{id}', [App\Http\Controllers\Admin\TypeController::class, 'edit'])->name('type.edit');
        Route::put('/configuracoes/tipos/editar/{id}', [App\Http\Controllers\Admin\TypeController::class, 'update'])->name('type.update');
        Route::DELETE('/configuracoes/tipos/excluir/{id}', [App\Http\Controllers\Admin\TypeController::class, 'destroy'])->name('type.destroy');

        //SITUAÇÃO DE OS
        Route::get('/configuracoes/situation', [App\Http\Controllers\Admin\SituationController::class, 'index'])->name('situation');

        //cadastrar imagem na OS
        Route::post('/configuracoes/addimage', [App\Http\Controllers\Admin\ImgContractController::class, 'store'])->name('imageContract.store');
        Route::DELETE('/configuracoes/excluirimagem/{id}', [App\Http\Controllers\Admin\ImgContractController::class, 'destroy'])->name('imageContract.destroy');

        //reviews
        Route::get('/configuracoes/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews');
        Route::post('/configuracoes/reviews/add', [App\Http\Controllers\Admin\ReviewController::class, 'store'])->name('reviews.store');
        Route::DELETE('/configuracoes/reviews/delete/{id}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

        //status_log
        Route::get('/configuracoes/atendimentos/novolog/', [App\Http\Controllers\Admin\StatusLogController::class, 'create'])->name('log.create');
        Route::get('/configuracoes/atendimentos/editlog/{id}', [App\Http\Controllers\Admin\StatusLogController::class, 'edit'])->name('log.edit');
        Route::put('/configuracoes/atendimentos/editlog/{id}', [App\Http\Controllers\Admin\StatusLogController::class, 'update'])->name('log.update');
        Route::DELETE('/configuracoes/atendimentos/deletelog/{id}', [App\Http\Controllers\Admin\StatusLogController::class, 'destroy'])->name('log.destroy');
        
      });
      //configurações do blog
        Route::group(['middleware'=>'can:view_service_demands'], function(){
        //blog
        Route::get('/administrativo/blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog.admin');
        Route::get('/administrativo/blog/novo', [App\Http\Controllers\PostController::class, 'create'])->name('blog.create');
        Route::post('/administrativo/blog/novo', [App\Http\Controllers\PostController::class, 'store'])->name('blog.store');

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

