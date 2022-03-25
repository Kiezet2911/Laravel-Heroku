let img1;
function loadimg(event) {
    const anh = document.getElementById("banner1");
    if (event.target.files != null) {
        if (!event.target.files[0].name.match(/\.(png|jpg)$/)) {
            alert("Không Hỗ Trợ File");
            return;
        }
        anh.src = URL.createObjectURL(event.target.files[0]);
        img1 = event.target.files[0];
    }
}
let img2;
function loadimg2(event) {
    const anh = document.getElementById("banner2");
    if (event.target.files != null) {
        if (!event.target.files[0].name.match(/\.(png|jpg)$/)) {
            alert("Không Hỗ Trợ File");
            return;
        }
        anh.src = URL.createObjectURL(event.target.files[0]);
        img2 = event.target.files[0];
    }
}
let img3;
function loadimg3(event) {
    const anh = document.getElementById("banner3");
    if (event.target.files != null) {
        if (!event.target.files[0].name.match(/\.(png|jpg)$/)) {
            alert("Không Hỗ Trợ File");
            return;
        }
        anh.src = URL.createObjectURL(event.target.files[0]);
        img3 = event.target.files[0];
    }
}

const form = document.getElementById("form");
form.addEventListener("submit", submitForm);
function submitForm(e) {
    e.preventDefault();

    if (!(typeof img1 == "undefined")) {
        const files = document.getElementById("Banner1");
        const formData = new FormData();
        for (let i = 0; i < files.files.length; i++) {
            formData.append("img", files.files[i]);
        }

        postimg(formData).then(async (res) => {
            if (res.data != null) {
                let linkAnh = '{"Image":"' + res.data + '"}';
                await fetch(
                    "https://bookingapiiiii.herokuapp.com/Banner1/Anh1",
                    {
                        method: "put",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: linkAnh,
                    }
                );
                alert("Cập Nhật Thành Công");
            } else {
                alert(res.Messager);
            }
        });
    } else {
        alert("Vui Lòng Chọn Ảnh Cho Banner 1");
    }
}

const form2 = document.getElementById("form2");
form2.addEventListener("submit", submitForm2);
async function submitForm2(e) {
    e.preventDefault();
    if (!(typeof img2 == "undefined")) {
        const files2 = document.getElementById("Banner2");
        const formData2 = new FormData();
        for (let i = 0; i < files2.files.length; i++) {
            formData2.append("img", files2.files[i]);
        }

        postimg(formData2).then(async (res) => {
            if (res.data != null) {
                let linkAnh = '{"Image":"' + res.data + '"}';
                await fetch(
                    "https://bookingapiiiii.herokuapp.com/Banner1/Anh2",
                    {
                        method: "put",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: linkAnh,
                    }
                );
                alert("Cập Nhật Thành Công");
            } else {
                alert(res.Messager);
            }
        });
    } else {
        alert("Vui Lòng Chọn Ảnh Cho Banner 2");
    }
}

const form3 = document.getElementById("form3");
form3.addEventListener("submit", submitForm3);
async function submitForm3(e) {
    e.preventDefault();
    if (!(typeof img3 == "undefined")) {
        const files3 = document.getElementById("Banner3");
        const formData3 = new FormData();
        for (let i = 0; i < files3.files.length; i++) {
            formData3.append("img", files3.files[i]);
        }
        postimg(formData3).then(async (res) => {
            if (res.data != null) {
                let linkAnh = '{"Image":"' + res.data + '"}';
                await fetch(
                    "https://bookingapiiiii.herokuapp.com/Banner1/Anh3",
                    {
                        method: "put",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: linkAnh,
                    }
                );
                alert("Cập Nhật Thành Công");
            } else {
                alert(res.Messager);
            }
        });
    } else {
        alert("Vui Lòng Chọn Ảnh Cho Banner 3");
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
