<?php



Route::prefix('APanel')->group(function () { \MS\Core\Helper\Comman::loadRoute('APanel'); });
Route::prefix('ATMS')->group(function () { \MS\Core\Helper\Comman::loadRoute('ATMS'); });
Route::prefix('ANMS')->group(function () { \MS\Core\Helper\Comman::loadRoute('ANMS'); });
Route::prefix('AAMS')->group(function () { \MS\Core\Helper\Comman::loadRoute('AAMS'); });
