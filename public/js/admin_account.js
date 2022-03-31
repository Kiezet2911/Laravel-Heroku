let arrayid = [];

function SetRole(id) {
    let checkk = true;
    for (let i = 0; i < arrayid.length; i++) {
        if (arrayid[i] == id) {
            arrayid.splice(i, 1);
            checkk = false;
        }
    }
    if (checkk) {
        arrayid.push(id);
    }
}

function CapQuyenAdmin() {
    if (arrayid.length == 0) {
        alert("Vui Lòng Chọn Người Bạn Muốn Set Quyền!!");
    } else {
        let body = new reqid(arrayid);
        put("setRole", JSON.stringify(body))
            .then((res) => {
                alert("Cấp Quyền Thành Công");
                window.location.href = "/admin/account-manager";
            })
            .catch((err) => {
                alert(err);
            });
    }
}

class reqid {
    constructor(id) {
        this.id = id;
    }
    id = [];
}

function DeleteAccount() {
    if (this.Role) {
        alert("Không Thể Xóa Tài Khoản Admin");
    } else {
        this.userid;
        this.delteleData("khachhangbyid/" + this.userid)
            .then((result) => {
                alert("Xóa Thành Công");
                window.location.href = "/admin/account-manager";
            })
            .catch((err) => {
                alert(err);
            });
    }
}

