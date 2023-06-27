<?php
    session_start();
    include('../includes/koneksi.php');
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/google-plus.png">
    <title>Produk Masuk Detail</title>
    <link href="../assets/extra-libs/c3/c3.min.css" rel="stylesheet">
    <link href="../assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="../dist/css/style.min.css" rel="stylesheet">

    
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        
        <header class="topbar" data-navbarbg="skin6">
            <?php include 'includes/navigation.php'?>
        </header>

        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <?php include 'includes/sidebar.php'?>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Lengkap</h4>
                        <div class="d-flex align-items-center">
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                <div class="card">
                 <div class="card-body">
                 
                    <div class="row">
                    
                    <div class="table-responsive">
                                  <table id="zctb" class="table table-striped table-bordered no-wrap">

                                      <tbody>

                                      <?php	
                                      
                                      $id=$_GET['id'];
                                        $ret="SELECT * from produk_fb_masuk where id_masuk=?";
                                        $stmt= $koneksi->prepare($ret) ;
                                    $stmt->bind_param('i',$id);
                                    $stmt->execute() ;
                                    $res=$stmt->get_result();                                
                                    while($row=$res->fetch_object())
                                    {
                                              ?>
                                        

                                          <tr>
                                              <td colspan="4"><b>Tanggal Masuk: <?php echo $row->tanggal_masuk;?></b></td>
                                              
                                          </tr>

                                          <tr>
                                          <td><b>Kode Produk :</b></td>
                                          <td><?php echo $row->kode_produk;?></td>
                                          <td><b>Satuan :</b></td>
                                          <td><?php echo $row->satuan;?></td>
                                          </tr>


                                          <tr>
                                          <td><b>Nama Produk :</b></td>
                                          <td><?php echo $row->nama_produk;?></td>
                                          <td><b>Kategori :</b></td>
                                          <td><?php echo $row->kategori;?></td>
                                          </tr>


                                          <tr>
                                          <td><b>Kuantitas :</b></td>
                                          <td><?php echo $row->jumlah_masuk;?></td>
                                          </tr>                                                
                                          <?php } ?>

                                      </tbody>
                                  </table>                                 
                              </div>                                        
                    </div>                                  
                 </div>               
               </div>
            </div>
            <?php include '../includes/footer.php' ?>

        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <script src="../dist/js/feather.min.js"></script>
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../assets/extra-libs/c3/d3.min.js"></script>
    <script src="../assets/extra-libs/c3/c3.min.js"></script>
    <script src="../assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="../assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="../dist/js/pages/dashboards/dashboard1.min.js"></script>

</body>

</html>