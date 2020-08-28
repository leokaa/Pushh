
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
                    <h1>Tạo mới Hình thức Thanh toán</h1>
                        <form name="frmHTTT" id="frmHTTT" method="post" action="">
                        Tên hình thức thanh toán: <input type="text" name="httt_ten" id="httt_ten" />
                        <br />
                        <input type="submit" name="btnSave" id="btnSave" value="Lưu dữ liệu" />
                        </form>
                    <?php
                    if(isset($_POST['btnSave'])) {
                        include_once(__DIR__ . '/../../../connect.php');
                        $httt_ten = $_POST['httt_ten']; 
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
      $("#frThemMoi").validate({
        rules: {
          category_code: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
          category_name: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
          description: {
            required: true,
            minlength: 3,
            maxlength: 255
          }
        },
        messages: {
          category_code: {
            required: "Vui lòng nhập Mã Loại sản phẩm",
            minlength: "Mã Loại sản phẩm phải có ít nhất 3 ký tự",
            maxlength: "Mã Loại sản phẩm không được vượt quá 50 ký tự"
          },
          category_name: {
            required: "Vui lòng nhập tên Loại sản phẩm",
            minlength: "Tên Loại sản phẩm phải có ít nhất 3 ký tự",
            maxlength: "Tên Loại sản phẩm không được vượt quá 50 ký tự"
          },
          description: {
            required: "Vui lòng nhập mô tả cho Loại sản phẩm",
            minlength: "Mô tả cho Loại sản phẩm phải có ít nhất 3 ký tự",
            maxlength: "Mô tả cho Loại sản phẩm không được vượt quá 255 ký tự"
          },
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