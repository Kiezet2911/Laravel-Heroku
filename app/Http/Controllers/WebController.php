<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WebController extends Controller
{
    //
    function index()
    {
        $url = "https://bookingapiiiii.herokuapp.com/";
        $list = json_decode(Http::get($url . 'home'), true);
        $book1 = $list['Book1'];
        $book2 = $list['Book2'];
        $sachhay = $list['Book3'];
        $listBanner = $list['Banner'];
        return view('home', ['book1' => $book1, 'book2' => $book2, 'sachhay' => $sachhay, 'active' => 1, 'listBanner' => $listBanner]);
    }


    function product(Request $req)
    {
        $url = "https://bookingapiiiii.herokuapp.com/";

        $chude = json_decode(Http::get($url . 'chude'), true);
        return view('products', ['chude' => $chude]);
    }
    public static function ifEmptyCart()
    {
        return true;
    }


    function details()
    {
        $id = "";
        $url = "https://bookingapiiiii.herokuapp.com/";
        if (isset($_GET["id"])) {
            $id =   $_GET['id'];
            $url =  $url . "sachbyid/" . $id;
        }
        $bookdetails = json_decode(Http::get($url), true);
        return view('details', ['details' => $bookdetails]);
    }

    function CreateCart(Request $req)
    {
        $req->session()->remove('Mess');
        if (isset($_GET['id'])) {
            if (isset($_GET['token'])) {
                //Token Là Ảnh Trên Firebase
                $image = $_GET['image'] . '&token=' . $_GET['token'];
            } else {
                $image = $_GET['image'];
            }
            $itemCart = [
                "id" => $_GET['id'],
                "name" => $_GET['name'],
                "image" =>  $image,
                "price" => $_GET['price'],
                "count" => 1
            ];

            if ($req->session()->get("idbookforcart") != null) {
                $arr = $req->session()->get("idbookforcart");
                $length = 1;
                foreach ($arr as $item) {

                    if ($item['id'] == $itemCart['id']) {
                        $item['count'] += 1;
                        $req->session()->put("idbookforcart", $arr);
                        break;
                    }
                    if ($item['id'] != $itemCart['id'] && $length == count($arr)) {
                        array_push($arr, $itemCart);
                        $req->session()->put("idbookforcart", $arr);
                    }
                    $length++;
                }
            } else {
                $arr = array($itemCart);
                $req->session()->put("idbookforcart", $arr);
            }
        }

        if (isset($_GET['deleteid'])) {
            $objNeed = [];
            $arr = $req->session()->get("idbookforcart");
            foreach ($arr as $item) {
                if ($item['id'] == $_GET['deleteid']) {
                    $objNeed = $item;
                    break;
                }
            }
            if (($key = array_search($objNeed, $arr)) !== false) {
                unset($arr[$key]);
            }

            $req->session()->put("idbookforcart", $arr);
        }

        if (isset($_GET['deleteAll'])) {
            $req->session()->put("idbookforcart", []);
        }

        if (isset($_GET['pay'])) {
            $UserLogin = session()->get('UserLogin');
            if ($UserLogin != null) {
                if (isset(session()->get('UserLogin')['id'])) {
                    if ($req->session()->get("idbookforcart") != null) {
                        $date = date('Y-m-d H:i:s');
                        $kh = session()->get('UserLogin')['id'];
                        $total = 0;
                        $masach = [];
                        $soluongcheck = [];
                        foreach (session()->get('idbookforcart') as $item) {
                            array_push($masach, $item['id']);
                            array_push($soluongcheck, $item['count']);
                            $total += $item['price'] * $item['count'];
                        }

                        if (isset($kh) && isset($date) && $masach != [] && $soluongcheck != []) {
                            $data = json_decode(Http::post('https://bookingapiiiii.herokuapp.com/DonHang', [
                                "Dathanhtoan" => false,
                                "Tinhtranggiaohang" => false,
                                "Ngaydat" => $date,
                                "TongTien" =>  $total,
                                "MaKH" =>  $kh,
                                "MasachCheck" => $masach,
                                "SoluongCheck" => $soluongcheck
                            ]), true);
                            if (isset($data['_id'])) {
                                foreach (session()->get('idbookforcart') as $item) {
                                    $price = (float)$item['price'];
                                    $response = json_decode(
                                        Http::post('https://bookingapiiiii.herokuapp.com/CTDonHang', [
                                            "MaDonHang" => $data['_id'],
                                            "Masach" => $item['id'],
                                            "Soluong" => $item['count'],
                                            "Dongia" => $price
                                        ]),
                                        true
                                    );
                                }

                                if (isset($response['MaDonHang'])) {
                                    $req->session()->put("idbookforcart", []);
                                    if (isset($req->session()->get('UserLogin')['Email'])) {
                                        $mail = $req->session()->get('UserLogin')['Email'];
                                        Http::get('https://bookingapiiiii.herokuapp.com/Sendmail/' . $mail);
                                    }
                                    $req->session()->put('Mess', "Đặt hàng thành công nhá");
                                } else {
                                    $req->session()->put('Mess', $data['Messager'][0]);
                                }
                            } else {
                                $req->session()->put('Mess', $data['Messager'][0]);
                            }
                        }
                    }
                } else {
                    return view('signin');
                }
            } else {
                return view('signin');
            }
        }

        return redirect('cart');
    }

    function cart(Request $req)
    {
        if (session()->has('UserLogin')) {
            if (isset(session()->get('UserLogin')['id']) && session()->has("idbookforcart")) {
                $id = session()->get('UserLogin')['id'];
                $data = Http::get('https://bookingapiiiii.herokuapp.com/khachhangbyid/' . $id);

                return view('cart', ['data' => $data, 'listCart' => $req->session()->get("idbookforcart")]);
            } else return view('cart', ['data', 'listCart' => []]);
        } else {
            if (session()->has("idbookforcart")) return view('cart', ['data', 'listCart' => $req->session()->get("idbookforcart")]);
            else return view('cart', ['data', 'listCart' => []]);
        }
    }

    function plusCountItem(Request $req)
    {
        if (isset($_GET['id'])) {
            if ($req->session()->get("idbookforcart") != null) {
                $arr = $req->session()->get("idbookforcart");
                $arrrr = [];
                foreach ($arr as $item) {
                    if ($item['id'] == $_GET['id']) {
                        $item['count'] += 1;
                    }
                    array_push($arrrr, $item);
                }
                $req->session()->remove("idbookforcart");
                $req->session()->put("idbookforcart", $arrrr);
            }
        }
        if (session()->has('UserLogin')) {

            if (isset(session()->get('UserLogin')['id'])) {
                $id = session()->get('UserLogin')['id'];
                $data = Http::get('https://bookingapiiiii.herokuapp.com/khachhangbyid/' . $id);


                return redirect('cart');
            } else return redirect('cart');
        } else return redirect('cart');
    }

    function minusCountItem(Request $req)
    {
        if (isset($_GET['id'])) {
            if ($req->session()->get("idbookforcart") != null) {
                $arr = $req->session()->get("idbookforcart");
                $arrrr = [];
                foreach ($arr as $item) {
                    if ($item['id'] == $_GET['id']) {
                        if ($item['count'] == 1) {
                            break;
                        } else {
                            $item['count'] -= 1;
                        }
                    }
                    array_push($arrrr, $item);
                }
                $req->session()->remove("idbookforcart");
                $req->session()->put("idbookforcart", $arrrr);
            }
        }
        if (session()->has('UserLogin')) {

            if (isset(session()->get('UserLogin')['id'])) {
                $id = session()->get('UserLogin')['id'];
                $data = Http::get('https://bookingapiiiii.herokuapp.com/khachhangbyid/' . $id);


                return redirect('cart');
            } else return redirect('cart');
        } else return redirect('cart');
    }


    function HistoryPay(Request $req)
    {
        $url = "https://bookingapiiiii.herokuapp.com/";
        if ($req->session()->has('UserLogin')) {

            if (isset($req->session()->get('UserLogin')['id'])) {
                return view('historypay');
            } else {
                return view('notlogin');
            }
        } else return view('notlogin');
    }

    function CTBill($idBill, $date, $money, $TT)
    {
        $url = "https://bookingapiiiii.herokuapp.com/";
        $dateformat = date('j \\ F Y', strtotime($date));
        $listCTBill = json_decode(Http::get($url . 'CTDonHangbyid/' . $idBill), true);
        $money = number_format($money, 3, ",", ".");
        return view('dialogHistoryPay', compact('listCTBill', 'idBill', 'dateformat', 'money', 'TT'));
    }
}
