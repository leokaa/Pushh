
<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sản phẩm</title>

    <?php
         include_once( __DIR__ . '/layouts/styles.php');
    ?>

    <link href="/Pushh/assects/vendor/DataTables/datatables.min.css" type="text/css" rel="stylesheet"></head>
    <link href="/Pushh/assects/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet"></head>
<body class="d-flex flex-column h-100">
    <!-- Phần header -->
        <?php
        include_once( __DIR__ . '/layouts/partials/header.php');
        ?> 
    <!-- header -->
    <main role="main" class="mb-2">
        <!-- Block content -->
        <?php
        // Hiển thị tất cả lỗi trong PHP
        // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
        // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Truy vấn database để lấy danh sách
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__ . '/../connect.php');

        // 2. Chuẩn bị câu truy vấn $sql
        $sqlDanhSachSanPham = <<<EOT
        SELECT sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_soluong, lsp.lsp_ten, MAX(hsp.hsp_tentaptin) AS hsp_tentaptin
        FROM `sanpham` sp
        JOIN `loaisanpham` lsp ON sp.lsp_ma = lsp.lsp_ma
        LEFT JOIN `hinhsanpham` hsp ON sp.sp_ma = hsp.sp_ma
        GROUP BY sp.sp_ma, sp.sp_ten, sp.sp_gia, sp.sp_giacu, sp.sp_mota_ngan, sp.sp_soluong, lsp.lsp_ten
EOT;

        // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
        $result = mysqli_query($conn, $sqlDanhSachSanPham);

        // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
        $dataDanhSachSanPham = [];
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $dataDanhSachSanPham[] = array(
                'sp_ma' => $row['sp_ma'],
                'sp_ten' => $row['sp_ten'],
                'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
                'sp_giacu' => number_format($row['sp_giacu'], 2, ".", ","),
                'sp_mota_ngan' => $row['sp_mota_ngan'],
                'sp_soluong' => $row['sp_soluong'],
                'lsp_ten' => $row['lsp_ten'],
                'hsp_tentaptin' => $row['hsp_tentaptin'],
            );
        }

        ?>
         <!-- Giải thuật duyệt và render Danh sách sản phẩm theo dòng, cột của Bootstrap -->
         <div class="sanphams py-5 bg-light">
            <div class="container">
                <div class="row row-cols-3">
                    <?php foreach ($dataDanhSachSanPham as $sanpham) : ?>
                        <div class="col">
                            <div class="card mb-4 shadow-sm">
                                <div class="card-header">
                                    <div class="ribbon-wrapper">
                                        <div class="ribbon red">MỚI</div>
                                    </div>

                                    <!-- Nếu có hình sản phẩm thì hiển thị -->
                                    <?php if (!empty($sanpham['hsp_tentaptin'])) : ?>
                                        <div class="container-img">
                                            <a href="/Pushh/frontend/sanpham/detail.php?sp_ma=<?= $sanpham['sp_ma'] ?>">
                                                <img class="bd-placeholder-img card-img-top img-fluid" width="100%" height="350" src="/Pushh/assects/uploads/products/<?= $sanpham['hsp_tentaptin'] ?>" />
                                            </a>
                                        </div>
                                        <!-- Nếu không có hình sản phẩm thì hiển thị ảnh mặc định -->
                                    <?php else : ?>
                                        <div class="container-img">
                                            <a href="/Pushh/frontend/sanpham/detail.php?sp_ma=<?= $sanpham['sp_ma'] ?>">
                                                <img class="bd-placeholder-img card-img-top img-fluid" width="100%" height="350" src="/Pushh/assects/shared/img/default.png" />
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <a href="/Pushh/frontend/sanpham/detail.php?sp_ma=<?= $sanpham['sp_ma'] ?>">
                                        <h5><?= $sanpham['sp_ten'] ?></h5>
                                    </a>
                                    <h6><?= $sanpham['lsp_ten'] ?></h6>
                                    <p class="card-text"><?= $sanpham['sp_mota_ngan'] ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-outline-secondary" href="/Pushh/frontend/sanpham/detail.php?sp_ma=<?= $sanpham['sp_ma'] ?>">Xem chi tiết</a>
                                        </div>
                                        <small class="text-muted text-right">
                                            <s><?= $sanpham['sp_giacu'] ?></s>
                                            <b><?= $sanpham['sp_gia'] ?></b>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- End block content -->
    </main>
        
    
    
    
    <!-- Phần footer -->
   <?php
        include_once( __DIR__ . '/layouts/partials/footer.php');
    ?> 
    <!-- footer -->
    
  


    <?php
         include_once( __DIR__ . '/layouts/js.php');
    ?>
<!--   Datatabales js -->   
    <script src="/Pushh/assects/vendor/DataTables/datatables.min.js"></script>
    <script src="/Pushh/assects/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/Pushh/assects/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/Pushh/assects/vendor/sweetalert/sweetalert.min.js"></script>

   
</body>
</html>