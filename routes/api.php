<?php

use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RecordController;

Route::group(['prefix'=>'v1'], function() {
    Route::controller(RecordController::class)->prefix('record')->group(function () {
        Route::get('/get','index');
        Route::get('/show/{id}','show');
        Route::post('/create',  'store');

        Route::get('/getImage/{record}',function(Request $request, Record $record) {
            return Storage::download($record->file);
        })->name('getImageURL')->middleware('signed');
    });
});


