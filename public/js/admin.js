let Role;
let userid;
let idbook;
let ListCTBill;
let Anh1 = "";
let Anh2 = "";
let Anh3 = "";
let SolnTon = 0;
let Product__Price = 0;

function closeDialog() {
    let details = document.getElementById("DialogDetailsPay__Container");
    details.style.display = "none";
}

function showDialogDeleteAccount(id, role) {
    let dialog = document.getElementById("Dialog_Messenger");
    dialog.style.display = "block";
    this.userid = id;
    this.Role = role;
}

function closeDialogDeleteAccount() {
    let dialog = document.getElementById("Dialog_Messenger");
    dialog.style.display = "none";
}

function closeDialogChangeDetails() {
    let dialog = document.getElementById(
        "DialogChangeDetailsProduct__Container"
    );
    dialog.style.display = "none";
}
let IDBOOK;
let GIA;

function showDialogChangeDetailsProduct(id, gia) {
    let dialog = document.getElementById(
        "DialogChangeDetailsProduct__Container"
    );
    dialog.style.display = "block";
    IDBOOK = id;
    GIA = gia;
    document.getElementById("storagePrice").value = gia;
}

//Update Storage
const FormUpdate = document.getElementById("UpdateBook");
FormUpdate.addEventListener("submit", submitFormprofile);
function submitFormprofile(e) {
    e.preventDefault();
    let dongia = document.getElementById("storagePrice").value;
    let ton = document.getElementById("storageNum").value;
    let check = [];
    check.push(dongia > 0);
    check.push(ton > 0);
    if (check.every((va) => va === true)) {
        let body =
            '{"id":"' +
            IDBOOK +
            '","Giaban":' +
            dongia +
            ',"Soluongton":' +
            ton +
            "}";
        put("sach", body)
            .then((res) => {
                if (res._id != null) {
                    alert("Cập Nhật Thành Công");
                    window.location.href = "/admin/storage-products";
                } else {
                    alert("Đã Xảy Ra Lỗi");
                }
            })
            .catch((err) => {
                alert(err);
            });
    } else {
        alert("Vui Lòng Nhập Lại");
    }
}

//update bill
function comboxBill(id) {
    let tinhtrang = document.getElementById("Setting__Status").value;
    let check = [];
    check.push(tinhtrang != null);

    if (check.every((va) => va === true)) {
        let body =
            '{"id":"' +
            id +
            '","Giaban":' +
            dongia +
            ',"Soluongton":' +
            ton +
            "}";
        put("sach", body)
            .then((res) => {
                if (res._id != null) {
                    alert("Cập Nhật Thành Công");
                    window.location.href = "/admin/storage-products";
                } else {
                    alert("Đã Xảy Ra Lỗi");
                }
            })
            .catch((err) => {
                alert(err);
            });
    } else {
        alert("Vui Lòng Nhập Lại");
    }
}

async function getData(url = "") {
    let BookingApi = "https://bookingapiiiii.herokuapp.com/";
    const response = await fetch(BookingApi + url, {
        method: "GET",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
        },
    });
    return response.json();
}
async function postimg(formData) {
    const response = await fetch(
        "https://bookingapiiiii.herokuapp.com/upload-image",
        {
            method: "post",
            body: formData,
        }
    );
    return response.json();
}

async function put(url = "", bodyy) {
    let BookingApi = "https://bookingapiiiii.herokuapp.com/";
    const response = await fetch(BookingApi + url, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: bodyy,
    });
    return response.json();
}

async function delteleData(url = "") {
    let BookingApi = "https://bookingapiiiii.herokuapp.com/";
    console.log(BookingApi + url);
    const response = await fetch(BookingApi + url, {
        method: "DELETE",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
        },
    });

    return response.json();
}

function showDialog(idBill, date, money, tinhtrang) {
    let details = document.getElementById("DialogDetailsPay__Container");
    details.style.display = "block";
    if (tinhtrang == true) {
        TT = "true";
    } else {
        TT = "false";
    }
    $.ajax({
        url: "account-manager/" + idBill + "/" + date + "/" + money + "/" + TT,
        type: "GET",
    }).done((res) => {
        $("#DialogDetailsPay").empty();
        $("#DialogDetailsPay").html(res);
    });
}
