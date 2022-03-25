//Add New Book
const FormAddBook = document.getElementById("formNewBook");
FormAddBook.addEventListener("submit", submitFormAddBook);

function submitFormAddBook(e) {
    e.preventDefault();
    let tensach = document.getElementById("inputName").value;
    let mota = document.getElementById("inputDesc").value;
    let nxb = document.getElementById("inputNXB").value;
    let tacgia = document.getElementById("inputTG").value;
    let chude = document.getElementById("inputCD").value;
    let Soln = document.getElementById("inputSoLuong").value;
    let Gia = document.getElementById("inputPrice").value;

    let check = [];
    check.push(tensach != null);
    check.push(mota != null);
    check.push(nxb != null);
    check.push(tacgia != null);
    check.push(chude != null);
    check.push(Soln != null);
    check.push(Gia != null);

    if (check.every((va) => va === true)) {
        if (!(typeof img1 == "undefined")) {
            const chudearr = [];
            chudearr.push(chude);

            const files = document.getElementById("inputImage");
            const formData = new FormData();
            for (let i = 0; i < files.files.length; i++) {
                formData.append("img", files.files[i]);
            }
            postimg(formData).then(async (res) => {
                if (res.data != null) {
                    let linkAnh = res.data;
                    let body =
                        '{"Tensach":"' +
                        tensach +
                        '","Mota":"' +
                        mota +
                        '","Anhbia":"' +
                        linkAnh +
                        '","Soluongton":' +
                        Soln +
                        ',"Giaban":' +
                        Gia +
                        ',"MaCD":["' +
                        chudearr +
                        '"],"MaNXB":"' +
                        nxb +
                        '","MaTacGia":"' +
                        tacgia +
                        '"}';
                    await fetch("https://bookingapiiiii.herokuapp.com/sach", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: body,
                    })
                        .then((result) => {
                            alert("Thêm Thành Công");
                        })
                        .catch((err) => {
                            alert(err);
                        });
                } else {
                    alert(res.Messager);
                }
            });
        } else {
            alert("Vui Lòng Nhập Lại");
        }
    }
}
