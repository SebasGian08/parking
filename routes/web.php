<?php

App::setLocale('es');

/* Route::get('/', 'App\HomeController@index')->name('index'); */


Route::get('/loginEmpresa', 'App\HomeController@loginEmpresa')->name('loginEmpresa');
//Route::get('/actualizar', 'App\HomeController@actualizar')->name('actualizar');
Route::get('/filtro_distritos/{id}', 'App\HomeController@filtro_distritos')->name('filtro_distritos');
Route::get('/offline_alumno/{id}', 'App\LoginAlumnoController@offline');


/* ADMINISTRADOR */
Route::get('/home/notification', 'Auth\EmpresaController@notification')->name('auth.home.notification');

Route::group(['prefix' => 'auth', 'middleware' => 'auth:web'], function () {
    Route::get('/home', 'Auth\HomeController@index')->name('auth.index');

    Route::group(['prefix' => 'inicio'], function () {
        Route::get('/', 'Auth\InicioController@index')->name('auth.inicio');
        Route::get('/listSeguimiento', 'Auth\InicioController@listSeguimiento')->name('auth.inicio.listSeguimiento');

    });


    Route::group(['prefix' => 'area'], function () {
        Route::get('/', 'Auth\AreaController@index')->name('auth.area');
        Route::get('/list_all', 'Auth\AreaController@list_all')->name('auth.area.list_all');
        Route::get('/partialView/{id}', 'Auth\AreaController@partialView')->name('auth.area.create');
        Route::post('/store', 'Auth\AreaController@store')->name('auth.area.store');
        Route::post('/delete', 'Auth\AreaController@delete')->name('auth.area.delete');
    });

    // SECTION USUARIO

    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'Auth\UsuariosController@index')->name('auth.usuarios');
        Route::get('/list_all', 'Auth\UsuariosController@list_all')->name('auth.usuarios.list_all');
        Route::post('/store', 'Auth\UsuariosController@store')->name('auth.usuarios.store');
        Route::post('/delete', 'Auth\UsuariosController@delete')->name('auth.usuarios.delete');
        Route::get('/partialView/{id}', 'Auth\UsuariosController@partialView')->name('auth.usuarios.create');
    });

    // END SECTION USUARIO

    Route::group(['prefix' => 'principal'], function () {
        Route::get('/', 'Auth\PrincipalController@index')->name('auth.principal');

    });

    Route::group(['prefix' => 'error'], function () {
        Route::get('/', 'Auth\ErrorController@index')->name('auth.error');

    });

    Route::group(['prefix' => 'configuracion'], function () {
        Route::get('/', 'Auth\ConfiguracionController@index')->name('auth.configuracion');
        Route::post('/store', 'Auth\ConfiguracionController@store')->name('auth.configuracion.store');
        Route::get('/list_all', 'Auth\ConfiguracionController@list_all')->name('auth.configuracion.list_all');
        Route::post('/delete', 'Auth\ConfiguracionController@delete')->name('auth.configuracion.delete');
        Route::get('/partialView/{id}', 'Auth\ConfiguracionController@partialView')->name('auth.configuracion.create');
        Route::post('/update', 'Auth\ConfiguracionController@update')->name('auth.configuracion.update');
    });

    /* SISTEMA PARKING */
    Route::group(['prefix' => 'datos'], function () {
        Route::get('/', 'Auth\DatosController@index')->name('auth.datos');
        Route::get('/list_all', 'Auth\DatosController@list_all')->name('auth.datos.list_all');
        Route::post('/update', 'Auth\DatosController@update')->name('auth.datos.update');

    });

    Route::group(['prefix' => 'estacionamiento'], function () {
        Route::get('/', 'Auth\EstacionamientoController@index')->name('auth.estacionamiento');
        Route::get('/list_all', 'Auth\EstacionamientoController@list_all')->name('auth.estacionamiento.list_all');
        Route::post('/store', 'Auth\EstacionamientoController@store')->name('auth.estacionamiento.store');
        Route::post('/delete', 'Auth\EstacionamientoController@delete')->name('auth.estacionamiento.delete');
        Route::get('/partialView/{id}', 'Auth\EstacionamientoController@partialView')->name('auth.estacionamiento.create');
    });
    Route::group(['prefix' => 'tipo'], function () {
        Route::get('/', 'Auth\TipoController@index')->name('auth.tipo');
        Route::get('/list_all', 'Auth\TipoController@list_all')->name('auth.tipo.list_all');
        Route::post('/store', 'Auth\TipoController@store')->name('auth.tipo.store');
        Route::post('/delete', 'Auth\TipoController@delete')->name('auth.tipo.delete');
        Route::get('/partialView/{id}', 'Auth\TipoController@partialView')->name('auth.tipo.create');
    });

    Route::group(['prefix' => 'vehiculos'], function () {
        Route::get('/', 'Auth\VehiculosController@index')->name('auth.vehiculos');
        Route::get('/list_all', 'Auth\VehiculosController@list_all')->name('auth.vehiculos.list_all');
        Route::post('/store', 'Auth\VehiculosController@store')->name('auth.vehiculos.store');
        Route::post('/delete', 'Auth\VehiculosController@delete')->name('auth.vehiculos.delete');
        Route::get('/partialView/{id}', 'Auth\VehiculosController@partialView')->name('auth.vehiculos.create');
    });

    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'Auth\TicketsController@index')->name('auth.tickets');
        Route::get('/list_all', 'Auth\TicketsController@list_all')->name('auth.tickets.list_all');
        Route::post('/store', 'Auth\TicketsController@store')->name('auth.tickets.store');
        Route::post('/delete', 'Auth\TicketsController@delete')->name('auth.tickets.delete');
        Route::get('/partialView/{id}', 'Auth\TicketsController@partialView')->name('auth.tickets.create');
        
        // Nueva ruta para buscar por placa
        Route::get('/placa/{placa}', 'Auth\TicketsController@buscarPorPlaca')->name('auth.tickets.buscarPorPlaca');
        Route::get('/partialViewCalculate/{id}', 'Auth\TicketsController@partialViewCalculate')->name('auth.tickets.create');
        Route::post('/confirmar', 'Auth\TicketsController@confirmar')->name('auth.tickets.confirmar');
        Route::get('/listarPlacasMasFrecuentes', 'Auth\TicketsController@listarPlacasMasFrecuentes')->name('auth.tickets.listarPlacasMasFrecuentes');
    });


    Route::group(['prefix' => 'abonados'], function () {
        Route::get('/', 'Auth\AbonadosController@index')->name('auth.abonados');
        Route::get('/list_all', 'Auth\AbonadosController@list_all')->name('auth.abonados.list_all');
        Route::get('/partialViewDetalle/{id}', 'Auth\AbonadosController@partialViewDetalle')->name('auth.abonados.partialViewDetalle');
        Route::post('/update', 'Auth\AbonadosController@update')->name('auth.abonados.update');
       Route::post('/storeContrato', 'Auth\AbonadosController@storeContrato')->name('auth.abonados.storeContrato');

        /* Route::post('/delete', 'Auth\VehiculosController@delete')->name('auth.vehiculos.delete');
        Route::get('/partialView/{id}', 'Auth\VehiculosController@partialView')->name('auth.vehiculos.create'); */
    });

});


Route::group(['prefix' => 'auth'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
    Route::post('login', 'Auth\LoginController@login')->name('auth.login.post');
    Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

    Route::get('/changePassword/partialView', 'Auth\LoginController@partialView_change_password')->name('auth.login.partialView_change_password');
    Route::post('/changePassword', 'Auth\LoginController@change_password')->name('auth.login.change_password');

    /*Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');*/
});

Route::get('publicar_oferta', 'Auth\LoginController@view_publicar_oferta');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');