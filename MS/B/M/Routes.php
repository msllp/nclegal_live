<?php

Route::prefix('Users')->group(function () { \MS\Core\Helper\Comman::loadRoute('Users'); });
Route::prefix('Panel')->group(function () { \MS\Core\Helper\Comman::loadRoute('Panel'); });
Route::prefix('MAS')->group(function () { \MS\Core\Helper\Comman::loadRoute('MAS'); });
Route::prefix('AMS')->group(function () { \MS\Core\Helper\Comman::loadRoute('AMS'); });
Route::prefix('TMS')->group(function () { \MS\Core\Helper\Comman::loadRoute('TMS'); });
Route::prefix('NMS')->group(function () { \MS\Core\Helper\Comman::loadRoute('NMS'); });
Route::prefix('IM')->group(function () { \MS\Core\Helper\Comman::loadRoute('IM'); });
Route::prefix('MSCDN')->group(function () { \MS\Core\Helper\Comman::loadRoute('MSCDN'); });
Route::prefix('LOC')->group(function () { \MS\Core\Helper\Comman::loadRoute('LOC'); });
//Route::prefix('AAMS')->group(function () { \MS\Core\Helper\Comman::loadRoute('AAMS'); });
Route::prefix('ADMS')->group(function () { \MS\Core\Helper\Comman::loadRoute('ADMS'); });