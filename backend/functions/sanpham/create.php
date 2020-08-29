
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?php
         include_once( __DIR__ . '/../../layouts/style.php');
    ?>
</head>
<body>
    <!-- Phần header -->
        <?php
        include_once( __DIR__ . '/../../layouts/partials/header.php');
        ?> 
    <!-- header -->


    <!-- Phần sidebar -->
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Phần sidebar -->
                        <?php
                            include_once( __DIR__ . '/../../layouts/partials/sidebar.php');
                        ?> 
                    <!-- Phần sidebar -->
                </div>
                <div class="col-md-8">
                    <?php
                         
                         // Truy vấn database
                         // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                         include_once(__DIR__ . '/../../../connect.php');
                         /* --- 
                         --- 2.Truy vấn dữ liệu Loại sản phẩm 
                         --- 
                         */
                         // Chuẩn bị câu truy vấn Loại sản phẩm
                         $sqlLoaiSanPham = "select * from `loaisanpham`";
                         // Thực thi câu truy vấn SQL để lấy về dữ liệu
                         $resultLoaiSanPham = mysqli_query($conn, $sqlLoaiSanPham);
                         // Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                         // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                         // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                         $dataLoaiSanPham = [];
                         while ($rowLoaiSanPham = mysqli_fetch_array($resultLoaiSanPham, MYSQLI_ASSOC)) {
                             $dataLoaiSanPham[] = array(
                                 'lsp_ma' => $rowLoaiSanPham['lsp_ma'],
                                 'lsp_ten' => $rowLoaiSanPham['lsp_ten'],
                                 'lsp_mota' => $rowLoaiSanPham['lsp_mota'],
                             );
                         }

                         // Chuẩn bị câu truy vấn Nhà sản xuất
                        $sqlNhaSanXuat = "select * from `nhasanxuat`";
                        $resultNhaSanXuat = mysqli_query($conn, $sqlNhaSanXuat);
                        
                        $dataNhaSanXuat = [];
                        while ($rowNhaSanXuat = mysqli_fetch_array($resultNhaSanXuat, MYSQLI_ASSOC)) {
                            $dataNhaSanXuat[] = array(
                                'nsx_ma' => $rowNhaSanXuat['nsx_ma'],
                                'nsx_ten' => $rowNhaSanXuat['nsx_ten'],
                            );
                        }
                        $sqlKhuyenMai = "select * from `khuyenmai`";
                        $resultKhuyenMai = mysqli_query($conn, $sqlKhuyenMai);
                      
                        $dataKhuyenMai = [];
                        while ($rowKhuyenMai = mysqli_fetch_array($resultKhuyenMai, MYSQLI_ASSOC)) {
                            $km_tomtat = '';
                            if (!empty($rowKhuyenMai['km_ten'])) {
                                $km_tomtat = sprintf(
                                    "Khuyến mãi %s, nội dung: %s, thời gian: %s-%s",
                                    $rowKhuyenMai['km_ten'],
                                    $rowKhuyenMai['km_noidung'],
                                    date('d/m/Y', strtotime($rowKhuyenMai['km_tungay'])),    
                                    date('d/m/Y', strtotime($rowKhuyenMai['km_denngay']))
                                );  
                            }
                            $dataKhuyenMai[] = array(
                                'km_ma' => $rowKhuyenMai['km_ma'],
                                'km_tomtat' => $km_tomtat,
                            );
                        }
                        /* --- End Truy vấn dữ liệu Khuyến mãi --- */
                    ?>
                   <h3>Thêm sản phẩm</h3>
                   <form name="frmsanpham" id="frmsanpham" method="post" action="">
                    <div class="form-group">
                        <label for="sp_ten">Tên Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_ten" name="sp_ten" placeholder="Tên Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_gia">Giá Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_gia" name="sp_gia" placeholder="Giá Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_giacu">Giá cũ Sản phẩm</label>
                        <input type="text" class="form-control" id="sp_giacu" name="sp_giacu" placeholder="Giá cũ Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_mota_ngan">Mô tả ngắn</label>
                        <input type="text" class="form-control" id="sp_mota_ngan" name="sp_mota_ngan" placeholder="Mô tả ngắn Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_mota_chitiet">Mô tả chi tiết</label>
                        <input type="text" class="form-control" id="sp_mota_chitiet" name="sp_mota_chitiet" placeholder="Mô tả chi tiết Sản phẩm" value="">
                    </div>
                    <div class="form-group">
                        <label for="sp_ngaycapnhat">Ngày cập nhật</label>
                        <input type="text" class="form-control" id="sp_ngaycapnhat" name="sp_ngaycapnhat" placeholder="Ngày cập nhật Sản phẩm" value="">
                    </div>
                        <!-- Them select cho loai san pham -->                    
                        <div class="form-group">
                        <label for="lsp_ma">Loại sản phẩm</label>
                        <select class="form-control" id="lsp_ma" name="lsp_ma">
                            <?php foreach ($dataLoaiSanPham as $loaisanpham) : ?>
                                <option value="<?= $loaisanpham['lsp_ma'] ?>"><?= $loaisanpham['lsp_ten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Them select nha san xuat -->                    
                    <div class="form-group">
                        <label for="nsx_ma">Nhà sản xuất</label>
                        <select class="form-control" id="nsx_ma" name="nsx_ma">
                            <?php foreach ($dataNhaSanXuat as $nhasanxuat) : ?>
                                <option value="<?= $nhasanxuat['nsx_ma'] ?>"><?= $nhasanxuat['nsx_ten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>                        
                    <!-- Them select cho khuyen mai -->                    
                    <div class="form-group">
                        <label for="km_ma">Khuyến mãi</label>
                        <select class="form-control" id="km_ma" name="km_ma">
                            <option value="">Không áp dụng khuyến mãi</option>
                            <?php foreach ($dataKhuyenMai as $khuyenmai) : ?>
                                <option value="<?= $khuyenmai['km_ma'] ?>"><?= $khuyenmai['km_tomtat'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" name="btnSave">Lưu dữ liệu</button>

                    </form>    
                        
                    <?php 
                         if (isset($_POST['btnSave'])) {
                            // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                            $ten = $_POST['sp_ten'];
                            $gia = $_POST['sp_gia'];
                            $giacu = $_POST['sp_giacu'];
                            $motangan = $_POST['sp_mota_ngan'];
                            $motachitiet = $_POST['sp_mota_chitiet'];
                            $ngaycapnhat = $_POST['sp_ngaycapnhat'];
                            $lsp_ma = $_POST['lsp_ma'];
                            $nsx_ma = $_POST['nsx_ma'];
                            $km_ma = (empty($_POST['km_ma']) ? '' : 'NULL');
                            // Câu lệnh INSERT
                            $sql = "INSERT INTO `sanpham` (sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma, km_ma) VALUES ('$ten', $gia, $giacu, '$motangan', '$motachitiet', '$ngaycapnhat', $soluong, $lsp_ma, $nsx_ma, $km_ma);";
                            // Thực thi INSERT
                            mysqli_query($conn, $sql);
                            // Đóng kết nối
                            mysqli_close($conn);
                            // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
                            //echo "<script>location.href = 'index.php';</script>";
                        }
                    ?>
                </div>

            </div>
        </div>
                    <!-- sidebar -->
                
    
    <!-- Phần footer -->
   <?php
        include_once( __DIR__ . '/../../layouts/partials/footer.php');
    ?> 
    <!-- header -->
    
  


    <?php
         include_once( __DIR__ . '/../../layouts/js.php');
    ?>
</body>
</html>