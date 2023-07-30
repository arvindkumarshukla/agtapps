<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
  
use App\Http\Controllers\ImageUploadController;  

use App\Http\Controllers\XmlToJsonController;  

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
  
Route::get('/', function () {
    return view('welcome');
});

Route::get('addemployee', [EmployeeController::class, 'addemployee'])->name('addemployee');
Route::post('submitemploye', [EmployeeController::class, 'submitemploye'])->name('submitemploye.post');

Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');
Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');

Route::get('xmltojson', [ XmlToJsonController::class, 'xmltojsonwithui' ])->name('xmltojsonwithui');