
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
                   <h3>Danh sách hình</h3>
                        <?php
                            include_once(__DIR__.'/../../../connect.php');
                            $sql= <<<EOT
                            SELECT sp.*
                            , lsp.lsp_ten
                            , nsx.nsx_ten
                            , km.km_ten, km.km_noidung, km.km_tungay, km.km_denngay
                        FROM `sanpham` sp
                        JOIN `loaisanpham` lsp ON sp.lsp_ma = lsp.lsp_ma
                        JOIN `nhasanxuat` nsx ON sp.nsx_ma = nsx.nsx_ma
                        LEFT JOIN `khuyenmai` km ON sp.km_ma = km.km_ma
                        ORDER BY sp.sp_ma DESC

EOT;
                            $data = [];
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                $km_tomtat='';
                                $km_ten=$row['km_ten'];
                                if(!empty($km_ten)){
                                    $km_tomtat=sprintf("Khuyến mãi: %s, Nội dung: %s, Từ ngày %s đến %s",$row['km_ten'],$row['km_noidung'],
                                    date('d/m/y',strtotime($row['km_tungay'])),
                                    date('d/m/y',strtotime($row['km_tungay'])));

                                }
                                
                                
                                $data [] = array(
                                    'sp_ma'=> $row['sp_ma'],
                                    'sp_ten'=> $row['sp_ten'],
                                    // Sử dụng hàm number_format(số tiền, số lẻ thập phân, dấu phân cách số lẻ, dấu phân cách hàng nghìn) 
                                    // để định dạng số khi hiển thị trên giao diện. 
                                    // Vd: 15800000 -> format thành 15,800,000.66 vnđ
                                    'sp_gia' => number_format($row['sp_gia'], 2, ".", ",") . ' vnđ',
                                    'lsp_ten'=> $row['lsp_ten'],
                                    'nsx_ten'=> $row['nsx_ten'],
                                    'km_tomtat'=> $km_tomtat,
                                );
                            }

                        ?>
                        <button type="button" class="btn btn-info">                        
                            <a href="create.php">Thêm dữ liệu</a>
                        </button>

                        <table class="table" border="1">
                            <tr>
                            <thead class="thead-dark">
                                <th>Mã sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá sản phẩm</th>
                                <th>Loại sản phẩm</th>
                                <th>Nhà sản xuất</th>
                                <th>Khuyến mãi</th>
                                <th>Thực thi</th>
                            </thead>
                            </tr>
                            <?php   foreach($data as $sanpham): ?>
                                <tr>
                                    <td> <?= $sanpham['sp_ma'] ?></td>
                                    <td> <?= $sanpham['sp_ten'] ?></td>
                                    <td> <?= $sanpham['sp_gia'] ?></td>
                                    <td> <?= $sanpham['lsp_ten'] ?></td>
                                    <td> <?= $sanpham['nsx_ten'] ?></td>
                                    <td> <?= $sanpham['km_tomtat'] ?></td>
                                    <td>
                                        <a href="delete.php?sp_ma=<?= $sanpham['sp_ma'];?>">Xóa</a>
                                        <a href="edit.php?sp_ma=<?= $sanoham['sp_ma'];?>">sửa</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
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