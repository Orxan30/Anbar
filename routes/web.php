<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandsController;

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
Route::get('lang/change','App\Http\Controllers\LangController@change')->name('changeLang');




Route::group(['middleware'=>'notlogin'], function(){

    Route::group(['middleware'=>'isblock'], function(){

        Route::group(['middleware'=>'isadmin'], function(){
            Route::prefix('admin')->group(function(){

                Route::get('/ayarlar','App\Http\Controllers\anbarController@indexApul')->name('ayarlar');
                Route::post('/ayarlar','App\Http\Controllers\anbarController@ok9')->name('PULgonder');
                Route::get('/PULsil/{id}','App\Http\Controllers\anbarController@PULsil')->name('PULsil');
                Route::get('/PULyes/{id}','App\Http\Controllers\anbarController@PULyes')->name('PULyes');
                
                Route::post('/LGupdate', 'App\Http\Controllers\anbarController@LGupdate')->name('LGupdate');
                Route::post('/EMupdate', 'App\Http\Controllers\anbarController@EMupdate')->name('EMupdate');
                Route::post('/FTRupdate', 'App\Http\Controllers\anbarController@FTRupdate')->name('FTRupdate');

                Route::get('/mesajlar','App\Http\Controllers\anbarController@COindex')->name('mesajlar');
                Route::get('/msil/{id}','App\Http\Controllers\anbarController@msil')->name('msil');
                Route::get('/myes/{id}','App\Http\Controllers\anbarController@myes')->name('myes');
                
                Route::get('/sadmin','App\Http\Controllers\anbarController@sadmin')->name('sadmin');
                Route::post('/sadmin','App\Http\Controllers\anbarController@sAdminok')->name('sAUgonder');
                Route::get('/sAUsil/{id}','App\Http\Controllers\anbarController@sAUsil')->name('sAUsil');
                Route::get('/sAUyes/{id}','App\Http\Controllers\anbarController@sAUyes')->name('sAUyes');
                Route::get('/sAUedit/{id}','App\Http\Controllers\anbarController@sAUedit')->name('sAUedit');
                Route::post('/sAUupdate/{id}','App\Http\Controllers\anbarController@sAUupdate')->name('sAUupdate');
                Route::get('/sAUblock/{id}','App\Http\Controllers\anbarController@sAUblock')->name('sAUblock');
                Route::get('/sAUopen/{id}','App\Http\Controllers\anbarController@sAUopen')->name('sAUopen');
                Route::get('/AUadmin/{id}','App\Http\Controllers\anbarController@AUadmin')->name('AUadmin');
                Route::get('/AUuser/{id}','App\Http\Controllers\anbarController@AUuser')->name('AUuser');

                Route::get('/admin','App\Http\Controllers\anbarController@admin')->name('admin');
                Route::post('/admin','App\Http\Controllers\anbarController@Adminok')->name('AUgonder');
                Route::get('/AUsil/{id}','App\Http\Controllers\anbarController@AUsil')->name('AUsil');
                Route::get('/AUyes/{id}','App\Http\Controllers\anbarController@AUyes')->name('AUyes');
                Route::get('/AUblock/{id}','App\Http\Controllers\anbarController@AUblock')->name('AUblock');
                Route::get('/AUopen/{id}','App\Http\Controllers\anbarController@AUopen')->name('AUopen');
            });
        
        });
        
        Route::get('/translation', function () {
            return view('translation');
        })->name('translation');

        Route::get('/elaqe', function () {
            return view('elaqe');
        })->name('elaqe');
        Route::post('/elaqe','App\Http\Controllers\anbarController@Eok')->name('Egonder');
        
        Route::get('/manage','App\Http\Controllers\anbarController@manage')->name('manage');
        Route::post('/manage','App\Http\Controllers\anbarController@umanage')->name('umanage');
        Route::post('/pmanage','App\Http\Controllers\anbarController@pmanage')->name('pmanage');

        Route::get('/logout','App\Http\Controllers\anbarController@logout')->name('logout');

        
        Route::get('/clients','App\Http\Controllers\anbarController@index2')->name('clients');
        Route::post('/clients','App\Http\Controllers\anbarController@ok2')->name('Cgonder');
        Route::post('/Cupdate/{id}', 'App\Http\Controllers\anbarController@Cupdate')->name('Cupdate');
        Route::get('/Cedit/{id}','App\Http\Controllers\anbarController@Cedit')->name('Cedit');
        Route::get('/Csil/{id}','App\Http\Controllers\anbarController@Csil')->name('Csil');
        Route::get('/Cyes/{id}','App\Http\Controllers\anbarController@Cyes')->name('Cyes');

        Route::get('/staff','App\Http\Controllers\anbarController@index6')->name('staff');
        Route::post('/staff','App\Http\Controllers\anbarController@ok6')->name('Sgonder');
        Route::get('/Ssil/{id}', 'App\Http\Controllers\anbarController@Ssil')->name('Ssil');
        Route::get('/Syes/{id}', 'App\Http\Controllers\anbarController@Syes')->name('Syes');
        Route::get('/Sedit/{id}', 'App\Http\Controllers\anbarController@Sedit')->name('Sedit');
        Route::post('/Supdate/{id}', 'App\Http\Controllers\anbarController@Supdate')->name('Supdate');

        Route::get('/senedlerim/{id}','App\Http\Controllers\anbarController@senedlerim')->name('senedlerim');
        Route::post('/senedlerim','App\Http\Controllers\anbarController@Sok')->name('Sndgonder2');
        Route::post('/Sndupdate/{id}','App\Http\Controllers\anbarController@Sndupdate')->name('Sndupdate');
        Route::get('/Sndedit/{id}{staff_id}','App\Http\Controllers\anbarController@Sndedit')->name('Sndedit');
        Route::get('/Sndsil/{id}{staff_id}','App\Http\Controllers\anbarController@Sndsil')->name('Sndsil');
        Route::get('/Sndyes/{id}','App\Http\Controllers\anbarController@Sndyes')->name('Sndyes');
        
        Route::get('/profil','App\Http\Controllers\anbarController@Proindex')->name('profil');
        Route::post('/Prupdate', 'App\Http\Controllers\anbarController@Prupdate')->name('Prupdate');
        Route::post('/Parolupdate', 'App\Http\Controllers\anbarController@Parolupdate')->name('Parolupdate');

        Route::get('lang/home','App\Http\Controllers\LangController@index');

        Route::get('/Cexport','App\Http\Controllers\anbarController@Cexport')->name('Cexport');
        Route::get('/staffexport','App\Http\Controllers\anbarController@staffexport')->name('staffexport');
        Route::get('/senedexport','App\Http\Controllers\anbarController@senedexport')->name('senedexport');


    });


});

Route::group(['middleware'=>'islogin'], function(){

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
    Route::post('/contact','App\Http\Controllers\anbarController@COok')->name('COgonder');

    Route::get('/register','App\Http\Controllers\anbarController@index7')->name('users');
   
    Route::post('/users','App\Http\Controllers\anbarController@ok7')->name('Ugonder');


    Route::get('', function () {
        return view('login');
    })->name('login1');
    Route::post('/login','App\Http\Controllers\anbarController@login')->name('login');

});

Route::get('', function () {
    return view('login');
})->name('login1');
Route::post('/login','App\Http\Controllers\anbarController@login')->name('login');













