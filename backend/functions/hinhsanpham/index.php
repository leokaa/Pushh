
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sản phẩm</title>

    <?php
         include_once( __DIR__ . '/../../layouts/style.php');
    ?>

    <link href="/Pushh/assects/vendor/DataTables/datatables.min.css" type="text/css" rel="stylesheet"></head>
    <link href="/Pushh/assects/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet"></head>
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
                   <h3>Danh sách hình san</h3>
                   <?php
                        // Hiển thị tất cả lỗi trong PHP
                        // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
                        // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);
                        // Truy vấn database
                        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                        include_once(__DIR__ . '/../../../connect.php');
                        // 2. Chuẩn bị câu truy vấn $sql
                        // Sử dụng HEREDOC của PHP để tạo câu truy vấn SQL với dạng dễ đọc, thân thiện với việc bảo trì code
                        $sql = <<<EOT
                        SELECT *
                        FROM `hinhsanpham` hsp
                        JOIN `sanpham` sp on hsp.sp_ma = sp.sp_ma
EOT;
                        // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                        $result = mysqli_query($conn, $sql);
                        // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                        // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                        // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                        $data = [];
                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        // Sử dụng hàm sprintf() để chuẩn bị mẫu câu với các giá trị truyền vào tương ứng từng vị trí placeholder
                        $sp_tomtat = sprintf(
                            "Sản phẩm %s, giá: %d",
                            $row['sp_ten'],
                            number_format($row['sp_gia'], 2, ".", ",") . ' vnđ'
                        );
                        $data[] = array(
                            'hsp_ma' => $row['hsp_ma'],
                            'hsp_tentaptin' => $row['hsp_tentaptin'],
                            'sp_tomtat' => $sp_tomtat,
                        );
                        }
                        /* --- End Truy vấn dữ liệu sản phẩm --- */
                        ?>
                        <!-- Nút thêm mới, bấm vào sẽ hiển thị form nhập thông tin Thêm mới -->
                        <a href="create.php" class="btn btn-primary">
                        Thêm mới
                        </a>
                        <table class="table table-bordered table-hover mt-2">
                        <thead class="thead-dark">
                            <tr>
                            <th>Mã Hình Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Sản phẩm</th>
                            <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $hinhsanpham): ?>
                            <tr>
                            <td><?= $hinhsanpham['hsp_ma'] ?></td>
                            <td>
                                <img src="/Pushh/assects/uploads/products/<?= $hinhsanpham['hsp_tentaptin'] ?>" class="img-fluid" width="100px" />
                            </td>
                            <td><?= $hinhsanpham['sp_tomtat'] ?></td>
                            <td>
                                <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `hsp_ma` -->
                                <a href="edit.php?hsp_ma=<?= $hinhsanpham['hsp_ma'] ?>" class="btn btn-warning">
                                Sửa
                                </a>
                                <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `sp_ma` -->
                                <a href="delete.php?hsp_ma=<?= $hinhsanpham['hsp_ma'] ?>" class="btn btn-danger">
                                Xóa
                                </a>
                            </td>
                            </tr>
                    <?php endforeach; ?>
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
<!--   Datatabales js -->   
    <script src="/Pushh/assects/vendor/DataTables/datatables.min.js"></script>
    <script src="/Pushh/assects/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/Pushh/assects/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/Pushh/assects/vendor/sweetalert/sweetalert.min.js"></script>

    <script>
   $(document).ready(function() {
       
        // Cảnh báo khi xóa
        // 1. Đăng ký sự kiện click cho các phần tử (element) đang áp dụng class .btnDelete
        $('.btnDelete').click(function() {
            // Click hanlder
            // Hiện cảnh báo khi bấm nút xóa
            swal({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "Một khi đã xóa, không thể phục hồi....",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                debugger;
                if (willDelete) { // Nếu đồng ý xóa
                    
                    // 2. Lấy giá trị của thuộc tính (custom attribute HTML) 'sp_ma'
                    // var sp_ma = $(this).attr('data-sp_ma');
                    var sp_ma = $(this).data('sp_ma');
                    var url = "delete.php?sp_ma=" + sp_ma;
                    
                    // Điều hướng qua trang xóa với REQUEST GET, có tham số sp_ma=...
                    location.href = url;
                } else {
                    swal("Cẩn thận hơn !!!");
                }
            });
           
        });
         // xử lý table danh sách
         $('#tblDanhsach').DataTable({
            dom: 'Blfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
    });
    </script>
</body>
</html>