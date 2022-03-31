@extends('admin')

@section('admincontent')
<?php if (isset($mess)) : ?>
    <h1>{{ $mess }}</h1>
<?php else : ?>
    <h1>{{ Session::get('mess') }}</h1>
<?php endif; ?>
<div class="Admin__Setting-Container">
    <div class="Admin__Setting-Banner">
        <h1>Banner</h1>
        <form id="form" enctype="multipart/form-data">
            <div class="Setting__Banner">
                <div class="Setting__Banner-Feature">
                    <div>Banner 1</div>
                    <input type="file" name="Banner1" id="Banner1" onchange="loadimg(event)" accept="image/*">
                </div>
                <img id="banner1" src="">
            </div>
            <button type="submit" class="Setting__Banner-Feature-Btn">
                Cập Nhật
            </button>
        </form>
        <form id="form2" enctype="multipart/form-data">
            <div class="Setting__Banner">
                <div class="Setting__Banner-Feature">
                    <div>Banner 2</div>
                    <input type="file" name="Banner2" id="Banner2" onchange="loadimg2(event)">
                </div>
                <img id="banner2" src="" alt="">
            </div>
            <button type="submit" class="Setting__Banner-Feature-Btn">
                Cập Nhật
            </button>
        </form>
        <form id="form3" enctype="multipart/form-data">
            <div class="Setting__Banner">
                <div class="Setting__Banner-Feature">
                    <div>Banner 3</div>
                    <input type="file" name="Banner3" id="Banner3" onchange="loadimg3(event)">
                </div>
                <img id="banner3" src="#" alt="">
            </div>
            <button type="submit" class="Setting__Banner-Feature-Btn">
                Cập Nhật
            </button>
        </form>
    </div>
    <div class="Admin__Setting-AddNew">
        <div class="Admin__Setting-Author">
            <h1>Thêm Tác Giả Mới</h1>
            <form class="Add__Container" method="POST">
                @csrf
                <div class="AddAuthor">
                    <div>Tên Tác Giả</div>
                    <input type="text" name="inputAuthorName" id="">
                </div>
                <div class="AddAuthor">
                    <div>Địa Chỉ</div>
                    <input type="text" name="inputAuthorAddr" id="">
                </div>
                <div class="AddAuthor">
                    <div>Tiểu Sử</div>
                    <input type="text" name="inputAuthorHist" id="">
                </div>
                <div class="AddAuthor">
                    <div>Điện Thoại</div>
                    <input type="tel" name="inputAuthorPhone" id="">
                </div>
                <input type="submit" class="Add__Btn" value="Thêm" name="BtnAddAuthor" />
            </form>

            <div class="Delete__Container">
				<label for="author">Chọn Tác Giả: </label>
				<select name="author" id="category">
                    <option selected>--Chọn Tác Giả--</option>
                    <?php
                        foreach ($listTG as $tg ) {
                    ?>
                            <option value="<?php echo $tg['_id']; ?>">
                                <?php echo $tg['TenTG']; ?>
                            </option>
                    <?php } ?>
              
				</select>

				<button class="Delete__Btn" type="submit" onclick="Deletetacgia()"> xóa tác giả </button>
			</div>
        </div>

        <div class="Admin__Setting-Author">
            <h1>Thêm Chủ Đề Mới</h1>
            <form method="POST">
                @csrf
                <div class="Add__Container">
                    <div class="AddCategory">
                        <div>Chủ Đề</div>
                        <input type="text" name="inputCategory" id="">
                    </div>
                    <input type="submit" class="Add__Btn" value="Thêm" name="BtnAddCategory" />
                </div>
            </form>
            <div class="Delete__Container">
				<label for="category">Chọn Chủ Đề: </label> 
				<select name="category"
					id="category">
				<option selected>--Chọn chủ đề --</option>
                    <?php  
                        foreach($listChuDe as $cd){
                    ?>
                    <option value="<?php echo $cd['_id']   ?>">
                         <?php echo $cd['TenChuDe'];   ?>
                     <?php } ?>
				</select>

				<button type="submit" class="Delete__Btn" value="xóa chủ đề " onclick="Deletechude()">xóa chủ đề</button>
			</div>
        </div>

        <div class="Admin__Setting-Author">
            <h1>Nhà Xuất Bản Mới</h1>
            <form class="Add__Container" method="POST">
                @csrf
                <div class="AddAuthor">
                    <div>Tên Nhà Xuất Bản</div>
                    <input type="text" name="inputNXB" id="inputNXB">
                </div>
                <div class="AddAuthor">
                    <div>Địa Chỉ</div>
                    <input type="text" name="inputAddress" id="inputAddress">
                </div>
                <div class="AddAuthor">
                    <div>Số Điện Thoại</div>
                    <input type="text" name="inputPhone" id="inputPhone">
                </div>
                <input type="submit" class="Add__Btn" value="Thêm" name="BtnAddNXB" />
            </form>

            <div class="Delete__Container">
				<label for="nxb">Chọn NXB: </label> 
				<select name="nxb" id="category">

                <option selected>--Chọn nhà xuất bản--</option>
                     <?php  
                        foreach($listNXB as $nxb){
                    ?>
                    <option value="<?php echo $nxb['_id']   ?>">
                         <?php echo $nxb['TenNXB'];   ?>
                     <?php } ?>
				</select>

                <button type="submit" class="Delete__Btn" value="xóa NXB"onclick="DeleteNXB()">Xóa NXB</button>
			</div>
        </div>
    </div>
</div>

<script type="text/javascript" src="/js/admin-setting.js"> </script>
@endsection