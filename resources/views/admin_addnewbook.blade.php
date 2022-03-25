@extends('admin')

@section('admincontent')
    <div class="AddNewBook__Container">

        <form id="formNewBook">

            <div class="AddNewBook__Body">
                <div class="AddNewBook__Body-BookName">
                    <span>Tên Sách: </span>
                    <input type="text" name="" id="inputName">
                </div>
                <div class="AddNewBook__Body-Description">
                    <span>Mô Tả: </span>
                    <input type="text" name="" id="inputDesc">
                </div>
                <div class="AddNewBook__Body-Description">
                    <span>Số Lượng: </span>
                    <input type="number" name="" id="inputSoLuong">
                </div>
                <div class="AddNewBook__Body-Description">
                    <span>Giá: </span>
                    <input type="number" name="" id="inputPrice">
                </div>
                <div class="AddNewBook__Body-BookCategory">
                    <span>Nhà Xuất Bản: </span>
                    <select class="form-select" aria-label="Default select example" id="inputNXB" required>
                        <option selected>--Chọn Nhà Xuất Bản--</option>
                        <?php
                            foreach($list['NXB'] as $nxb){
                        ?>
                        <option value="<?php echo $nxb['_id']; ?>">
                            <?php echo $nxb['TenNXB']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="AddNewBook__Body-BookAuthor">
                    <span>Tác Giả: </span>
                    <select class="form-select" aria-label="Default select example" id="inputTG" required>
                        <option selected>--Chọn Tác Giả--</option>
                        <?php
                            foreach ($list['tacgia'] as $bk ) {
                        ?>
                        <option value="<?php echo $bk['_id']; ?>">
                            <?php echo $bk['TenTG']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="AddNewBook__Body-BookCategory">
                    <span>Thể Loại: </span>
                    <select class="form-select" aria-label="Default select example" id="inputCD" required>
                        <option selected>--Chọn Chủ Đề--</option>
                        <?php
                            foreach($list['chude'] as $cd){
                        ?>
                        <option value="<?php echo $cd['_id']; ?>">
                            <?php echo $cd['TenChuDe']; ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="AddNewBook__Body-BookImage">
                    <span>Ảnh: </span>
                    <input type="file" name="" id="inputImage" accept="image/*" onchange="loadimg(event)">
                    <div class="AddNewBook__Body-Image" *ngIf="true">
                        <img src="https://prices.vn/photos/8/product/sach-dac-nhan-tam-cua-dale-carnegie.gif" alt=""
                            id="anh1">
                    </div>
                </div>
                <button class="AddNewBook__Body-BtnAdd" type="submit">
                    Thêm Sách
                </button>
            </div>
        </form>
    </div>

    <script>
        let img1;

        function loadimg(event) {
            const anh = document.getElementById("anh1");
            anh.src = URL.createObjectURL(event.target.files[0]);
            img1 = event.target.files[0];
        }
    </script>
     <script type="text/javascript" src="/js/admin_addnewbook.js"> </script>
@endsection
