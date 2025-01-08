<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\StudentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(TestController::class)->prefix('v1')->group(function () {
    Route::get('/test/show', 'show')->name('test.show');

    Route::controller(StudentController::class)->prefix('student')->group(function () {
        Route::get('/', 'index')->name('student.index');
        Route::post('/store', 'store')->name('student.store');
        Route::get('/show/{id}', 'show')->name('student.show');
        Route::put('/update/{id}', 'update')->name('student.update');
        Route::delete('/delete/{id}', 'destroy')->name('student.destroy');
    });
});
