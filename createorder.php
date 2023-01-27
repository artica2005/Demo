<!-- 
 **** AppzStory Shopping Cart System PHP MySQL ****
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบตะกร้าสั่งซื้อสินค้าอย่างง่าย appzstory.dev</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  
</head>
<body>
<?php
    require 'connect.php';
    /** เช็คว่ามีข้อมูลสินค้าในตะกร้า session หรือไม่ */
    if(isset($_SESSION['cart_item']) && isset($_POST['submit'])){
        try{
            /** เพิ่มข้อมูลลงใน orders */
            $params = array(
                'order_name' => $_POST['order_name'],
                'order_email' => $_POST['order_email'],
                'order_phone' => $_POST['order_phone'],
                'order_address' => $_POST['order_address'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            );
            $sql = "INSERT INTO orders (order_name, order_email, order_phone, order_address, created_at, updated_at) 
                    VALUES (:order_name, :order_email, :order_phone, :order_address, :created_at, :updated_at)";
            $stmt = $conn->prepare($sql);
            $stmt->execute($params);
            $lastInsertId = $conn->lastInsertId();
            
            if($lastInsertId){
                foreach ($_SESSION['cart_item'] as $value) {
                    /** เพิ่มข้อมูลลงใน order_details */
                    $paramsDetail = array(
                        'order_detail_amount' => $value['p_amount'],
                        'order_detail_price' => $value['p_price'],
                        'product_id' => $value['p_id'],
                        'order_id' => $lastInsertId,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    );
                    $sqlDetail = "INSERT INTO order_details (order_detail_amount, order_detail_price, product_id, order_id, created_at, updated_at) 
                        VALUES (:order_detail_amount, :order_detail_price, :product_id, :order_id, :created_at, :updated_at)";
                    $stmtDetail = $conn->prepare($sqlDetail);
                    $stmtDetail->execute($paramsDetail);
                }
            }
            session_destroy();
        } catch(Throwable $e) {
            echo '<script> alert("ระบบผิดพลาด โปรดติดต่อผู้ดูแลระบบ")</script>'; 
            header('Refresh:0; url=./');
        }
    } else {
        header("location: ./");
    }
?>
    <div class="flex-container">
        <div class="container py-3">
            <h3 class="mb-4">ระบบตะกร้าสั่งซื้อสินค้าอย่างง่ายด้วย PHP MySQL Bootstrap5</h3>
            <nav class="navbar navbar-light bg-white border-0 shadow-sm rounded-3 mb-4">
                <div class="container-fluid">
                    <a href="./" aria-current="page" class="navbar-brand">
                        <span class="brand-center">
                            <img src="https://appzstory.dev/_nuxt/img/logo.37c9600.png" width="50px" class="me-2"> 
                            <span class="d-none d-md-block"> AppzStory Studio <br> สอนเขียนเว็บไซต์ </span>
                        </span>
                    </a>
                    <span class="text-end position-relative me-3">
                        <div class="btn-group">
                            <a href="./" class="btn btn-outline-secondary">กลับสู่หน้าหลัก</a> 
                        </div>
                    </span>
                </div>
            </nav>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body text-center">
                            <div class="alert alert-success" role="alert">
                                สั่งซื้อสินค้าเสร็จเรียบร้อย!
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item border-0">รหัสสั่งซื้อ: #<?php echo str_pad($lastInsertId, 5, '0', STR_PAD_LEFT); ?> </li>
                                <li class="list-group-item border-0">ชื่อ: <?php echo $_POST['order_name'] ?> </li>
                                <li class="list-group-item border-0">เวลาสั่งซื้อ: <?php echo date("d/m/Y H:i:s") ?> </li>
                            </ul>
                            <hr>
                            <a href="./"> กลับสู่หน้าหลัก </a>
                        </div>
                    </div>
                </div>
            </div>
            <p class="author fw-bolder text-secondary text-center">
            สอนเขียนเว็บไซต์ด้วยตัวเอง <span class="text-pink fs-3" style="vertical-align: sub;">♥️</span>
            <a class="border-bottom border-2 border-primary text-decoration-none" href="https://appzstory.dev">AppzStory Studio</a>
            </p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>