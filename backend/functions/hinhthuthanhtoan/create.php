
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
                </div>
                <div class="col-md-8">
                <h1>Thêm mới Hình thức thanh toán</h1>
                <form name="frmThemMoi" id="frmThemMoi" method="post" action="">
                    <table>
                        <tr>
                            <td><label for="exampleInputEmail1">Tên hình thức thanh toán</label></td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txt_httt_ten" id="txt_httt_ten" aria-describedby="emailHelp">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="btnLuuDuLieu" id="btnLuuDuLieu" value="Lưu dữ liệu" />
                                <a class="btn btn-outline-primary" href="index.php">Quay về danh sách</a>
                            </td>
                        </tr>
                    </table>
                </form>

                   <!-- 1. Phan tách dữ liệu từ người dùng gởi đến SERVER ... -->
                <?php
                    // Truy vấn database
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../connect.php');

                    // 2. Nếu người dùng có bấm nút "Lưu dữ liệu" thì kiểm tra VALIDATE dữ liệu
                    if (isset($_POST['btnLuuDuLieu'])) {
                        $httt_ten = $_POST['txt_httt_ten']; //12

                        // Kiểm tra ràng buộc dữ liệu (Validation)
                        // Tạo biến lỗi để chứa thông báo lỗi
                        $errors = [];

                        // --- FIELD Tên hình thức thanh toán ---------------------------------------------------
                        // validate control/field Tên hình thức thanh toán
                        // rule: required
                        if(empty($httt_ten)) {
                            $errors['txt_httt_ten'][] = [
                                'rule' => 'required',
                                'rule_value' => true,
                                'value' => $httt_ten,
                                'msg' => 'Vui lòng nhập Tên hình thức thanh toán'
                            ];
                        } 

                        // minlength 3
                        if (!empty($httt_ten) && strlen($httt_ten) < 3) {
                            $errors['txt_httt_ten'][] = [
                            'rule' => 'minlength',
                            'rule_value' => 3,
                            'value' => $httt_ten,
                            'msg' => 'Tên hình thức thanh toán Phải từ 3 ký tự trở lên'
                            ];
                        }

                        // maxlength 3
                        if (!empty($httt_ten) && strlen($httt_ten) > 50) {
                            $errors['txt_httt_ten'][] = [
                            'rule' => 'maxlength',
                            'rule_value' => 50,
                            'value' => $httt_ten,
                            'msg' => 'Tên hình thức thanh toán Phải < 50 ký tự'
                            ];
                        }
                        // --------------------------------------------------------

                        // print_r($errors);die;
                    }
                ?>

                <?php if(isset($_POST['btnLuuDuLieu']) 
                    && isset($errors)
                    && !empty($errors)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <!-- thong bao loi -->
                        <ul>
                        <?php foreach ($errors as $fields) : ?>
                            <?php foreach ($fields as $field) : ?>
                            <li><?php echo $field['msg']; ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>


                <?php
                // Nếu không có lỗi VALIDATE dữ liệu (tức là dữ liệu đã hợp lệ)
                // Tiến hành thực thi câu lệnh SQL Query Database
                // => giá trị của biến $errors là rỗng
                if (
                    isset($_POST['btnLuuDuLieu'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                    && (!isset($errors) || (empty($errors))) // Nếu biến $errors không tồn tại Hoặc giá trị của biến $errors rỗng
                ) {
                    // VALIDATE dữ liệu đã hợp lệ
                    // Thực thi câu lệnh SQL QUERY
                    // Câu lệnh INSERT
                    $sql = "INSERT INTO `hinhthucthanhtoan` (, txt_httt_ten, ) VALUES ('$', '$txt_httt_ten', '');";
                    // Thực thi INSERT
                    mysqli_query($conn, $sql) or die("<b>Có lỗi khi thực thi câu lệnh SQL: </b>" . mysqli_error($conn) . "<br /><b>Câu lệnh vừa thực thi:</b></br>$sql");
                    // Đóng kết nối
                    mysqli_close($conn);
                    // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
                    // Điều hướng bằng Javascript
                    echo '<script>location.href = "index.php";</script>';
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

<!-- <script>
    $(document).ready(function() {
         $("#frmThemMoi").validate({
            rules: {
                txt_httt_ten: {
                   required: true,
                    minlength: 3,
                   maxlength: 50
                 }
             },
            messages: {
                 txt_httt_ten: {
                     required: "Vui lòng nhập Tên hình thức thanh toán",
                     minlength: "Tên hình thức thanh toán phải có ít nhất 3 ký tự",
                    maxlength: "Tên hình thức thanh toán không được vượt quá 50 ký tự"
                }
            },
             errorElement: "em",
             errorPlacement: function(error, element) {
                 // Thêm class `invalid-feedback` cho field đang có lỗi
                 error.addClass("invalid-feedback");
                 if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                 } else {
                     error.insertAfter(element);
                 }
            },
             success: function(label, element) {},
             highlight: function(element, errorClass, validClass) {
                 $(element).addClass("is-invalid").removeClass("is-valid");
             },
             unhighlight: function(element, errorClass, validClass) {
                 $(element).addClass("is-valid").removeClass("is-invalid");
             }
         });
    });
    </script> -->
</body>
</html>