const formProfile = document.getElementById("Profile");
formProfile.addEventListener("submit", submitFormprofile);

function submitFormprofile(e) {
    e.preventDefault();
    //Tạo 1 Mảng Rỗng
    let check = [];
    //Lấy Tất Cả Các Thẻ Có Đầu Input và Từ 1->5 Sẽ Lần Lượt Là Họ Ten, Email, Địa Chỉ, Số Điện Thoại và Ngày Sinh
    var ArrayInput = document.getElementsByTagName("input");
    for (let i = 1; i <= 5; i++) {
        check.push(!(typeof ArrayInput[i].value == "undefined"));
        check.push(typeof ArrayInput[i].value == "string");
    }

    let isTrue = (va) => va === true;

    if (check.every(isTrue)) {
        if (typeof idUser == "string" && !(idUser == "")) {
            if (!(typeof imgchoose == "undefined")) {
                const formData = new FormData();
                for (let i = 0; i < imgchoose.files.length; i++) {
                    formData.append("img", imgchoose.files[i]);
                }
                postimg(formData)
                    .then(async (res) => {
                        if (res.data != null) {
                            let linkAnh = res.data;
                            await UpdateProfileHaveImg(
                                ArrayInput[1].value, //Họ Tên
                                ArrayInput[2].value, //Email
                                ArrayInput[3].value, //Địa Chỉ
                                ArrayInput[4].value, //Số Điện Thoại
                                linkAnh,
                                ArrayInput[5].value //Ngày Sinh
                            )
                                .then((res) => {
                                    alert(res.Messenger);
                                    window.location.href = "/profile";
                                })
                                .catch((err) => {
                                    alert(err);
                                });
                        } else {
                            alert("Upload Ảnh Thất bại");
                        }
                    })
                    .catch((err) => {
                        alert(err);
                    });
            } else {
                UpdateProfile(
                    ArrayInput[1].value, //Họ Tên
                    ArrayInput[2].value, //Email
                    ArrayInput[3].value, //Địa Chỉ
                    ArrayInput[4].value, //Số Điện Thoại
                    ArrayInput[5].value //Ngày Sinh
                )
                    .then((res) => {
                        alert(res.Messenger);
                        window.location.href = "/profile";
                    })
                    .catch((err) => {
                        alert(err);
                    });
            }
        } else {
            alert("Bạn Chưa Đăng Nhập");
        }
    } else {
        alert("Lỗi");
    }
}

const changepass = document.getElementById("changepass");
changepass.addEventListener("submit", Submitchangepass);
async function Submitchangepass(e) {
    e.preventDefault();

    let check = [];
    let ArrayInput = document.getElementsByTagName("input");

    // 6: oldpass 7: newpass 8: compass
    for (let i = 6; i <= 8; i++) {
        check.push(!(typeof ArrayInput[i].value == "undefined"));
        check.push(!(ArrayInput[i].value == ""));
    }

    let isTrue = (va) => va === true;

    // 6: oldpass 7: newpass 8: compass
    if (check.every(isTrue)) {
        if (typeof idUser == "string" && !(idUser == "")) {
            ChangePass(
                ArrayInput[6].value,
                ArrayInput[7].value,
                ArrayInput[8].value
            )
                .then((res) => {
                    if (res.Messenger == "Cập Nhật Thành Công") {
                        alert(res.Messenger);
                        window.location.href = "/profile";
                    } else {
                        alert(res.Messenger);
                    }
                })
                .catch((err) => {
                    alert(err);
                });
        } else {
            alert("Bạn Chưa Đăng Nhập");
        }
    } else {
        alert("Lỗi");
    }
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

async function UpdateProfileHaveImg(
    HoTen,
    Email,
    DiaChi,
    DienThoai,
    Anh,
    Ngaysinh
) {
    let data =
        '{\n"id" : "' +
        idUser +
        '",\n "HoTen": "' +
        HoTen +
        '", \n "Email": "' +
        Email +
        '",\n "DiachiKH": "' +
        DiaChi +
        '",\n "DienthoaiKH" : "' +
        DienThoai +
        '",\n "Ngaysinh": "' +
        Ngaysinh +
        '",\n "Anh":"' +
        Anh +
        '"\n}';
    const response = await fetch(
        "https://bookingapiiiii.herokuapp.com/khachhang",
        {
            method: "put",
            headers: {
                "Content-Type": "application/json",
            },
            body: data,
        }
    );
    return response.json();
}
async function UpdateProfile(HoTen, Email, DiaChi, DienThoai, Ngaysinh) {
    let data =
        '{\n"id" : "' +
        idUser +
        '",\n "HoTen": "' +
        HoTen +
        '", \n "Email": "' +
        Email +
        '",\n "DiachiKH": "' +
        DiaChi +
        '",\n "DienthoaiKH" : "' +
        DienThoai +
        '",\n "Ngaysinh": "' +
        Ngaysinh +
        '"\n}';

    const response = await fetch(
        "https://bookingapiiiii.herokuapp.com/khachhang",
        {
            method: "put",
            headers: {
                "Content-Type": "application/json",
            },
            body: data,
        }
    );
    return response.json();
}
async function ChangePass(Matkhaued, newMatkhau, ConfirmMatKhau) {
    let data =
        '{"id":"' +
        idUser +
        '","Matkhaued":"' +
        Matkhaued +
        '","newMatkhau":"' +
        newMatkhau +
        '","ConfirmMatKhau":"' +
        ConfirmMatKhau +
        '"}';

    const response = await fetch(
        "https://bookingapiiiii.herokuapp.com/khachhangmk",
        {
            method: "put",
            headers: {
                "Content-Type": "application/json",
            },
            body: data,
        }
    );
    return response.json();
}
