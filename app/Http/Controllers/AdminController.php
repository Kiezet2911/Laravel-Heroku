<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Pagination;


class AdminController extends Controller
{

    function AdminIndex(Request $req)
    {

        if (isset($req->session()->get("UserLogin")["Role"])) {
            if ($req->session()->get("UserLogin")["Role"] == true) {
                return view('admin_index', ['Admin' => $req->session()->get("UserLogin")["HoTen"]]);
            } else return view('admin_notAdmin');
        } else return view('admin_notAdmin');
    }

    function AdminSetting(Request $req)
    {
        if (isset($req->session()->get("UserLogin")["Role"])) {
            if ($req->session()->get("UserLogin")["Role"] == true) {
                $url = "https://bookingapiiiii.herokuapp.com/";
                //Check POST For Add New Author, New Category, New Publishing Company:
                // 1. Add New Author
                if (isset($_POST["BtnAddAuthor"])) {
                    $resAuthor = json_decode(Http::post($url . 'tacgia', [
                        'TenTG' => $_POST['inputAuthorName'],
                        'Diachi' => $_POST['inputAuthorAddr'],
                        'Tieusu' => $_POST['inputAuthorHist'],
                        'Dienthoai' => $_POST['inputAuthorPhone'],
                    ]));
                }

                if (isset($_POST["BtnAddCategory"])) {
                    $resAuthor = json_decode(Http::post($url . 'chude', [
                        'TenChuDe' => $_POST['inputCategory']
                    ]));
                }

                if (isset($_POST["BtnAddNXB"])) {
                    $resAuthor = json_decode(Http::post($url . 'nhaxuatban', [
                        'TenNXB' => $_POST['inputNXB'],
                        'Diachi' => $_POST['inputAddress'],
                        'DienThoai' => $_POST['inputPhone']
                    ]));
                }

                $data = json_decode(Http::get($url . "GETALL"), true);

                $listTG = $data['tacgia'];
                $listNXB = $data['NXB'];
                $listChuDe = $data['chude'];

                return  view('admin_setting', compact('listTG', 'listNXB', 'listChuDe'));
            } else return view('admin_notAdmin');
        } else return view('admin_notAdmin');
    }

    function AdminStorage(Request $req)
    {
        if (isset($req->session()->get("UserLogin")["Role"])) {
            if ($req->session()->get("UserLogin")["Role"] == true) {
                return view('admin_storage');
            } else return view('admin_notAdmin');
        } else return view('admin_notAdmin');
    }

    function AdminAccount(Request $req)
    {
        if (isset($req->session()->get("UserLogin")["Role"])) {
            if ($req->session()->get("UserLogin")["Role"] == true) {
                return view('admin_account');
            } else return view('admin_notAdmin');
        } else return view('admin_notAdmin');
    }

    function GetBill($idBill, $date, $money, $TT, Request $req)
    {
        $url = "https://bookingapiiiii.herokuapp.com/";
        $listCTBill = json_decode(Http::get($url . 'CTDonHangbyid/' . $idBill), true);
        $money = number_format($money, 3, ",", ".");
        return view('dialogBill', compact('idBill', 'date', 'money', 'TT', 'listCTBill'));
    }

    function AdminBill(Request $req)
    {
        if (isset($req->session()->get("UserLogin")["Role"])) {
            if ($req->session()->get("UserLogin")["Role"] == true) {
                return view('admin_billpay');
            } else return view('admin_notAdmin');
        } else return view('admin_notAdmin');
    }

    function AdminAddNewBook(Request $req)
    {
        if (isset($req->session()->get("UserLogin")["Role"])) {
            if ($req->session()->get("UserLogin")["Role"] == true) {
                $url = "https://bookingapiiiii.herokuapp.com/";
                $list = json_decode(Http::get($url . 'GETALL'), true);
                return view('admin_addnewbook', ['list' => $list]);
            } else return view('admin_notAdmin');
        } else return view('admin_notAdmin');
    }
}
