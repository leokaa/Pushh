
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
                    <?php
                    if(isset($_POST['btnLuuDuLieu'])) {
                        include_once(__DIR__ . '/../../../connect.php');
                        $httt_ten = $_POST['txt_httt_ten']; 
                        $sql = "INSERT INTO `hinhthucthanhtoan`(httt_ten) VALUES('$httt_ten');";
                        mysqli_query($conn, $sql);
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

     <script>
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
    </script>
</body>
</html>