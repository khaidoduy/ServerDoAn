<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Tau;
use App\chuyendi;

class MainController extends Controller
{
  public function signUp (Request $request) {
  $user = new Users();
  $user->TenKH = $request->TenKH;
  $user->password = $request->Pass;
  $user->Gmail = $request->Gmail;
  $user->save();
  return json_encode('SUCCESS');
}
public function signIn(Request $request ) {
  $user = Users::where('TenKH',$request->Username)->get()->toArray();
  // return $request->Username;
  if($user[0]['password'] == $request->password) {
    return json_encode('SUCCESS');
  }
  else {
    return json_encode('Fail');

  }

}
public function LayThongTinUser(Request $request) {
  $result = array();
  $user = Users::find($request->IDUser);
  $tau = Tau::where('IdUser',$request->IDUser)->get()->toArray();
  // var_dump($tau);
  $result['TenKH'] = $user->TenKH;
  $result['SLtau'] = count($tau);
  $result = json_encode($result);
  return $result;
}
public function AddBoat(Request $request) {
  $tau = new Tau();
  $tau->IDUser = $request->IDUser;
  $tau->TenTau = $request->TenTau;
  $tau->ChieuCao = $request->ChieuCao;
  $tau->ChieuRong = $request->ChieuRong;
  $tau->CanNangKhongTai = $request->CanNangKhongTai;
  $tau->HinhDangDayTau = $request->HinhDangDayTau;
  $tau->ViTriX = '0';
  $tau->ViTriY = '0';
  $tau->TrangThai = '0';
  $tau->save();
  return json_encode('SUCCESS');

}
public function ListBoat(Request $request) {
  $tau = Tau::where('IdUser',$request->IDUser)->get()->toArray();
  $result = json_encode($tau);
  return $result;
}
public function ChiTietTau(Request $request) {
  //test cần xem xét lại
  $antoan = array();
  $tau = Tau::find($request->IdTau);
  $chuyendi = $tau->IDChuyenDi;
  if ($chuyendi) {
    foreach ($chuyendi as $key => $value) {
      $chuyendi = chuyendi::find($value);
      $antoan[] = $chuyendi->AnToan;
    }
  }
  $result = json_encode($antoan);
  return $result;
}
public function TinhKhoangCachTauDenCau($ViTriX,$ViTriY,$KinhDo,$ViDo) {
  $xDistance = abs($ViTriX-$KinhDo);
  $yDistance = abs($ViTriY-$ViDo);
  switch ($ViDo) {
    case ($ViDo < 15 && $vido >= 0):
      $mPerX = 111320;
      $mPerY = 110574;
      break;
    case ($ViDo < 30 && $vido >= 15):
      $mPerX = 107551;
      $mPerY = 110649;
      break;
    case ($ViDo < 45 && $vido >= 30):
      $mPerX = 96486;
      $mPerY = 110852;
      break;
    case ($ViDo < 60 && $vido >= 45):
      $mPerX = 78847;
      $mPerY = 111132;
      break;
    case ($ViDo < 75 && $vido >= 60):
      $mPerX = 55800;
      $mPerY = 111412;
      break;
    case ($ViDo < 90 && $vido >= 75):
      $mPerX = 28902;
      $mPerY = 111618;
      break;
    case (90):
      $mPerX = 0;
      $mPerY = 111694;
      break;
      $xTrueDistance = $xDistance*$mPerX;
      $yTrueDistance = $yDistance*$mPerY;
      $distance = sqrt(pow($xTrueDistance,2)+pow($yTrueDistance,2));
      return $distance;
  }
}
}
