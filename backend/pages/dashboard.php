<?php
    if (session_id() === '') {
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
         include_once( __DIR__ . '/../layouts/style.php');
    ?>

    <link href="/Pushh/assects/vendor/DataTables/datatables.min.css" type="text/css" rel="stylesheet"></head>
    <link href="/Pushh/assects/vendor/DataTables/Buttons-1.6.3/css/buttons.bootstrap4.min.css" type="text/css" rel="stylesheet"></head>
<body>
    <!-- Phần header -->
        <?php
        include_once( __DIR__ . '/../layouts/partials/header.php');
        ?> 
    <!-- header -->


    <!-- Phần sidebar -->
    <body class="d-flex flex-column h-100">
  <!-- header -->
  <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
  <!-- end header -->
  
  <div class="container-fluid">
    <div class="row">
      <!-- sidebar -->
      <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>
      <!-- end sidebar -->
      <main role="main" class="col-md-10 ml-sm-auto px-4 mb-2">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Bảng tin DASHBOARD</h1>
        </div>
        <!-- Block content -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoSanPham_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số mặt hàng</div>
                </div>
              </div>
              <button class="btn btn-primary btn-sm form-control" id="refreshBaoCaoSanPham">Refresh dữ liệu</button>
            </div> <!-- Tổng số mặt hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-success mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoKhachHang_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số khách hàng</div>
                </div>
              </div>
              <button class="btn btn-success btn-sm form-control" id="refreshBaoCaoKhachHang">Refresh dữ liệu</button>
            </div> <!-- Tổng số khách hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-warning mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoDonHang_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số đơn hàng</div>
                </div>
              </div>
              <button class="btn btn-warning btn-sm form-control" id="refreshBaoCaoDonHang">Refresh dữ liệu</button>
            </div> <!-- Tổng số đơn hàng -->
            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-danger mb-2">
                <div class="card-body pb-0">
                  <div class="text-value" id="baocaoGopY_SoLuong">
                    <h1>0</h1>
                  </div>
                  <div>Tổng số góp ý</div>
                </div>
              </div>
              <button class="btn btn-danger btn-sm form-control" id="refreshBaoCaoGopY">Refresh dữ liệu</button>
            </div> <!-- Tổng số góp ý -->
            <div id="ketqua"></div>
          </div><!-- row -->
          <div class="row">
            <!-- Biểu đồ thống kê loại sản phẩm -->
            <div class="col-sm-6 col-lg-6">
              <canvas id="chartOfobjChartThongKeLoaiSanPham"></canvas>
              <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeLoaiSanPham">Refresh dữ liệu</button>
            </div><!-- col -->
          </div><!-- row -->
        </div>
        <!-- End block content -->
      </main>
    </div>
  </div>
<!-- sidebar -->
                
    
    <!-- Phần footer -->
   <?php
        include_once( __DIR__ . '/../layouts/partials/footer.php');
    ?> 
    <!-- header -->
    
    <?php
         include_once( __DIR__ . '/../layouts/js.php');
    ?>
      
    <script src="/Pushh/assects/vendor/Chart.js/Chart.min.js"></script>

    <script>
        /*    Tong so mat hang   */        
       
        $(document).ready(function(){
            function getDuLieuBaoCaoTongSoMatHang() {
                $.ajax('/Pushh/assects/vendor/chart.js/api/api-du-lieu-thong-ke.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                        $('#baocaoSanPham_SoLuong').html(htmlString);
                    },
                    error: function() {
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#baocaoSanPham_SoLuong').html(htmlString);
                    }
                });
            }
            $('#refreshBaoCaoSanPham').click(function(event) {
                event.preventDefault();
                getDuLieuBaoCaoTongSoMatHang();
            });
            
            //Tong so gop y
            function getDuLieuGopY() {
                $.ajax('/Pushh/backend/api/api-du-lieu-gop-y.php', {
                    success: function(data) {
                        var dataObj = JSON.parse(data);
                        var htmlString = `<h1>${dataObj.SoLuong}</h1>`;
                        $('#baocaoGopY_SoLuong').html(htmlString);
                    },
                    error: function() {
                        var htmlString = `<h1>Không thể xử lý</h1>`;
                        $('#baocaoGopY_SoLuong').html(htmlString);
                    }
                });
            }
            $('#refreshBaoCaoGopY').click(function(event) {
                event.preventDefault();
                getDuLieuGopY();
            });
            getDuLieuBaoCaoTongSoMatHang();

            
            //Xet bieu dong
            function renderChartThongKeLoaiSanPham() {
                $.ajax({
                url: '/Pushh/backend/api/api-thong-ke-loai-san-pham.php',
                type: "GET",
                success: function(response) {
                    var data = JSON.parse(response);
                    var myLabels = [];
                    var myData = [];
                    $(data).each(function() {
                    myLabels.push((this.TenLoaiSanPham));
                    myData.push(this.SoLuong);
                    });
                    myData.push(0); // tạo dòng số liệu 0
                    if (typeof $objChartThongKeLoaiSanPham !== "undefined") {
                    $objChartThongKeLoaiSanPham.destroy();
                    }
                    $objChartThongKeLoaiSanPham = new Chart($chartOfobjChartThongKeLoaiSanPham, {
                    // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
                    type: "bar",
                    data: {
                        labels: myLabels,
                        datasets: [{
                        data: myData,
                        borderColor: "#9ad0f5",
                        backgroundColor: "#9ad0f5",
                        borderWidth: 1
                        }]
                    },
                    // Cấu hình dành cho biểu đồ của ChartJS
                    options: {
                        legend: {
                        display: false
                        },
                        title: {
                        display: true,
                        text: "Thống kê Loại sản phẩm"
                        },
                        responsive: true
                    }
                    });
                }
                });
            };
            $('#refreshThongKeLoaiSanPham').click(function(event) {
                event.preventDefault();
                renderChartThongKeLoaiSanPham();
            });
        });

        
    </script>
</body>
</html>