<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?php
         include_once( __DIR__ . '/../layouts/style.php');
    ?>
</head>
<body>
    <!-- Phần header -->
   <?php
    include_once( __DIR__ . '/../layouts/partials/header.php');
   ?> 
    <!-- Phần header -->


    <!-- Phần sidebar -->
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Phần sidebar -->
                        <?php
                            include_once( __DIR__ . '/../layouts/partials/sidebar.php');
                        ?> 
                    <!-- Phần sidebar -->
                </div>
                <div class="col-md-8">
                    Nội dụngggg
                </div>
            </div>
        </div>
    <!-- Phần sidebar -->
    
    
    <!-- Phần footer -->
   <?php
    include_once( __DIR__ . '/../layouts/partials/footer.php');
   ?> 
    <!-- Phần header -->
    
  


    <?php
         include_once( __DIR__ . '/../layouts/js.php');
    ?>
</body>
</html>