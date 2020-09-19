
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
         include_once( __DIR__ . '/../layouts/styles.php');
    ?>

    <link href="/Pushh/assects/vendor/DataTables/datatables.min.css" type="text/css" rel="stylesheet"></head>
    <link href="/Pushh/assects/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet"></head>
<body class="d-flex flex-column h-100">
    <!-- Phần header -->
        <?php
        include_once( __DIR__ . '/../layouts/partials/header.php');
        ?> 
    <!-- header -->
    <main role="main" class="mb-2">
        <!-- Content -->
        <div class="container mt-2">
            <h1 class="text-center">Liên hệ với Nền tảng</h1>
            <div class="row">
                <div class="col col-md-4">
                    <img src="/Pushh/assects/shared/img/L.jpg" class="img-fluid" />
                </div>
                <div class="col col-md-6">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="email">Email của bạn</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email của bạn">
                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề của bạn</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Tiêu đề của bạn">
                        </div>
                        <div class="form-group">
                            <label for="message">Lời nhắn của bạn</label>
                            <textarea name="message" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary" name="btnGoiLoiNhan">Gởi lời nhắn</button>
                    </form>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col col-md-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.7235485722294!2d105.78061631523369!3d10.039656175103817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a062a768a8090b%3A0x4756d383949cafbb!2zMTMwIFjDtCBWaeG6v3QgTmdo4buHIFTEqW5oLCBBbiBI4buZaSwgTmluaCBLaeG7gXUsIEPhuqduIFRoxqEsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1556697525436!5m2!1svi!2s" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
        <?php
            // Load các thư viện (packages) do Composer quản lý vào chương trình
            require_once __DIR__.'/../../duan/vendor/autoload.php';
            // Sử dụng thư viện PHP Mailer
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;
            if (isset($_POST['btnGoiLoiNhan'])) {
                // Lấy dữ liệu người dùng hiệu chỉnh gởi từ REQUEST POST
                $email = $_POST['email'];
                $title = $_POST['title'];
                $message = $_POST['message'];
                // Gởi mail kích hoạt tài khoản
                $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
                try {
                    //Server settings
                    //$mail->SMTPDebug = 2;                                   // Enable verbose debug output
                    $mail->isSMTP();                                        // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';                         // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                    $mail->Username = 'linhduy8a5@gmail.com'; // SMTP username
                    $mail->Password = 'qootyimeqvwgjhkc';                   // SMTP password
                    $mail->SMTPSecure = 'tls';                              // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                      // TCP port to connect to
                    $mail->CharSet = "UTF-8";
                    // Bật chế bộ tự mình mã hóa SSL
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );
                    //Recipients
                    $mail->setFrom('linhduy8a5@gmail.com', 'Mail Liên hệ');
                    $mail->addAddress('linhduy8a5@gmail.com');               // Add a recipient
                    $mail->addReplyTo($email);
                    // $mail->addCC('cc@example.com');
                    // $mail->addBCC('bcc@example.com');
                    //Attachments
                    // $mail->addAttachment('/var/tmp/file.tar.gz');        // Add attachments
                    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
                    //Content
                    $mail->isHTML(true);                                    // Set email format to HTML
                    // Tiêu đề Mail
                    $mail->Subject = "[Có người liên hệ] - $title";         
                    // Nội dung Mail
                    // Lưu ý khi thiết kế Mẫu gởi mail
                    // - Chỉ nên sử dụng TABLE, TR, TD, và các định dạng cơ bản của CSS để thiết kế
                    // - Các đường link/hình ảnh có sử dụng trong mẫu thiết kế MAIL phải là đường dẫn WEB có thật, ví dụ như logo,banner,...
                    $body = <<<EOT
                    <table border ="1">
                        <tr>
                            <td>
                                 <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7f/L_Old_London.svg/1200px-L_Old_London.svg.png"  weight ="100px" high="200px" />
                            </td>
                            <td>
                                Có người liên hệ cần giúp đỡ.
                            </td>
                        </tr>
                    </table>
       <br />
        Email của khách: $email <br />
        Nội dung: <br />
        $message
EOT;
                    $mail->Body    = $body;
                    $mail->send();
                } catch (Exception $e) {
                    echo 'Lỗi khi gởi mail: ', $mail->ErrorInfo;
                }
            }
        ?>
        <!-- Content -->
    </main>
    
    
    <!-- Phần footer -->
   <?php
        include_once( __DIR__ . '/../layouts/partials/footer.php');
    ?> 
    <!-- footer -->
    
  


    <?php
         include_once( __DIR__ . '/../layouts/js.php');
    ?>
<!--   Datatabales js -->   
    <script src="/Pushh/assects/vendor/DataTables/datatables.min.js"></script>
    <script src="/Pushh/assects/vendor/DataTables/Buttons-1.6.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/Pushh/assects/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/Pushh/assects/vendor/sweetalert/sweetalert.min.js"></script>

   
</body>
</html>