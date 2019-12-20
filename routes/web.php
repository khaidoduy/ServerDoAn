<?php

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


Route::get('taobang',function() {
  // Schema::drop('tau');
  // Schema::drop('user');
  //   Schema::drop('cau');

    // Schema::drop('chuyendi');


  Schema::create('User',function ($table) {
    $table->increments('ID');
    $table->string('Gmail');
    $table->string('TenKH');
    $table->string('password');
    // $table->integer('id_tau')->nullable()->unsigned();
    //   $table->foreign('id_tau')->references('id')->on('tau');
  });

    Schema::create('TAU',function ($table) {
      $table->increments('IDTau');
      $table->string('TenTau');
      $table->integer('ChieuCao');
      $table->integer('ChieuRong');
      $table->integer('CanNangKhongTai');
      $table->float('ViTriX');
      $table->float('ViTriY');
      $table->integer('TrangThai');
      $table->integer('IdUser')->unsigned();
      $table->foreign('IdUser')->references('ID')->on('User');
      // $table->integer('IDChuyenDi')->nullable()->unsigned();
      // $table->foreign('IDChuyenDi')->references('IDShip')->on('CHUYENDI');
    });
  Schema::create('CAU',function ($table) {
    $table->increments('IDCau');
    $table->integer('ChieuCao');
    $table->integer('ChieuRong');
    $table->integer('MucNuocHienTai');
    $table->float('ViDo1');
    $table->float('KinhDo1');
    $table->float('ViDo2');
    $table->float('KinhDo2');
    $table->float('ViDo3');
    $table->float('KinhDo3');

  });
  Schema::create('chuyendi',function ($table) {
    $table->increments('IDShip');
    $table->dateTime('NgayBatDau');
    $table->dateTime('NgayKetThuc');
    $table->integer('ChieuCaoHang');
    $table->integer('CanNangHang');
    $table->integer('ChieuCaoHienTai');
    $table->integer('ChieuRongHienTai');
    $table->string('AnToan')->default('An Toàn');
    $table->integer('IDTau')->unsigned();
    $table->foreign('IDTau')->references('IDTau')->on('TAU');
    // $table->integer('IDCau')->nullalbe()->unsigned();
    // $table->foreign('IDCau')->references('IDCau')->on('CAU');

  });
  Schema::create('giaodiem',function() {
     $table->increments('IDgiaodiem');
     $table->integer('IDchuyendi')->nullalbe()->unsigned();
       $table->foreign('IDchuyendi')->references('IDShip')->on('chuyendi');
       $table->integer('IDcau')->nullable()->unsigned();
       $table->foreign('IDcau')->references('IDCau')->on('cau');
  });




});
Route::get('suabang',function() {
  // Schema::table('chuyendi',function($table) {
  //   $table->drop('IDCau');
  // });
  // Schema::create('chuyendi',function($table) {
  //   $table->increments('IDShip');
  //   $table->dateTime('NgayBatDau');
  //   $table->dateTime('NgayKetThuc');
  //   $table->integer('ChieuCaoHang');
  //   $table->integer('CanNangHang');
  //   $table->integer('ChieuCaoHienTai');
  //   $table->integer('ChieuRongHienTai');
  //   $table->string('AnToan')->default('An Toàn');
  //   $table->integer('IDTau')->unsigned();
  //   $table->foreign('IDTau')->references('IDTau')->on('TAU');
  //   // $table->integer('IDCau')->nullalbe()->unsigned();
  //   // $table->foreign('IDCau')->references('IDCau')->on('CAU');
  //   // $table->integer('IDChuyenDi')->nullable()->unsigned();
  //   // $table->foreign('IDChuyenDi')->references('IDShip')->on('CHUYENDI');
  // });
  // Schema::create('giaodiem',function($table) {
  //   $table->increments('IDShip');
  //   // $table->dateTime('NgayBatDau');
  //   // $table->dateTime('NgayKetThuc');
  //   // $table->integer('ChieuCaoHang');
  //   // $table->integer('CanNangHang');
  //   // $table->integer('ChieuCaoHienTai');
  //   // $table->integer('ChieuRongHienTai');
  //   // $table->string('AnToan')->default('An Toàn');
  //   // $table->integer('IDTau')->unsigned();
  //   // $table->foreign('IDTau')->references('IDTau')->on('TAU');
  //   $table->integer('IDchuyendi')->nullalbe()->unsigned();
  //   $table->foreign('IDchuyendi')->references('IDShip')->on('chuyendi');
  //   $table->integer('IDcau')->nullable()->unsigned();
  //   $table->foreign('IDcau')->references('IDCau')->on('cau');
  // });
  Schema::table('tau',function($table) {
    $table->string('HinhDangDayTau');
  });
});
Route::get('signupform',function() {
  return view('createacc');
});
Route::post('Signup',['as'=>'Signup','uses'=> 'MainController@signUp']);
Route::get('signinform',function() {
  return view('signin');
});
Route::post('Signin',['as'=>'Signin','uses'=> 'MainController@signIn']);

Route::get('LayThongTinUserform',function () {
  return view('LayThongTinUserform');
});
Route::post('LayThongTinUser',['as'=>'LayThongTinUser','uses'=> 'MainController@LayThongTinUser']);
Route::get('AddBoatForm',function () {
  return view('AddBoatform');
});
Route::post('AddBoat',['as'=>'AddBoat','uses'=> 'MainController@AddBoat']);
Route::get('listboatform',function () {
  return view('listboatform');
});
Route::post('ListBoat',['as'=>'ListBoat','uses'=> 'MainController@ListBoat']);
Route::post('ChiTietTau',['as'=>'ChiTietTau','uses'=> 'MainController@ChiTietTau']);

Route::post('LayThongTinUser',['as'=>'LayThongTinUser','uses'=> 'MainController@LayThongTinUser']);
Route::post('test',function() {
  return json_encode('test');
});
