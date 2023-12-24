<?php
require_once("Connet.php");
require_once("auth.php"); // Session
logged_admin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/logo_bireuen.jpeg">
    <title>Mengelola User | Dinas Kependudukan dan Pencatatan Sipil Bireuen</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/admin.css" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link rel="stylesheet" type="text/css" href="vendor/datatables/extra/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/datatables/extra/buttons.dataTables.min.css">
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- export plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/extra/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables/extra/buttons.print.min.js"></script>
    <script src="vendor/datatables/extra/jszip.min.js"></script>
    <script src="vendor/datatables/extra/pdfmake.min.js"></script>
    <script src="vendor/datatables/extra/vfs_fonts.js"></script>
    <script src="vendor/datatables/extra/buttons.html5.min.js"></script>


</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index">Dinas Kependudukan dan Pencatatan Sipil Bireuen</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav sidebar-menu" id="exampleAccordion">

                <li class="sidebar-profile nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
                    <div class="profile-main">
                        <p class="image">
                            <img alt="image" src="images/avatar1.png" width="80">
                            <span class="status"><i class="fa fa-circle text-success"></i></span>
                        </p>
                        <p>
                            <span class="">Admin</span><br>
                            <span class="user" style="font-family: monospace;"><?php echo $divisi; ?></span>
                        </p>
                    </div>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Kelola">
                    <a class="nav-link" href="tables">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Kelola</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="User">
                    <a class="nav-link" href="user">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Mengelola User</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Ekspor">
                    <a class="nav-link" href="export">
                        <i class="fa fa-fw fa-print"></i>
                        <span class="nav-link-text">Ekspor</span>
                    </a>
                </li>

            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-envelope"></i>
                        <span class="d-lg-none">Messages
                            <span class="badge badge-pill badge-primary">12 New</span>
                        </span>
                        <span class="indicator text-primary d-none d-lg-block">
                            <i class="fa fa-fw fa-circle"></i>
                        </span>
                    </a>
                    <?php
                    $statement = $db->query("SELECT * FROM laporan ORDER BY laporan.id DESC LIMIT 1");
                    foreach ($statement as $key) {
                        $mysqldate = $key['tanggal'];
                        $phpdate = strtotime($mysqldate);
                        $tanggal = date('d/m/Y', $phpdate);
                    ?>
                        <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">Laporan Baru :</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                                <strong><?php echo $key['nama']; ?></strong>
                                <span class="small float-right text-muted"><?php echo $key['tanggal']; ?></span>
                                <div class="dropdown-message small"><?php echo $key['isi']; ?></div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item small" href="#">View all messages</a>
                        </div>
                    <?php
                    }
                    ?>

                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <body class="fixed-nav sticky-footer" id="page-top">
        <div class="content-wrapper">
            <div class="container-fluid">
                <!-- DataTables Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-table"></i> Tabel Mengelola User
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="example" width="100%">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Divisi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $userData = $db->query("SELECT * FROM `admin` ORDER BY 'id_admin' DESC");
                                    foreach ($userData as $user) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                                            <td><?php echo htmlspecialchars($user['password']); ?></td>
                                            <td><?php echo htmlspecialchars($user['divisi']); ?></td>
                                            <td>
                                                <!-- Update User Button -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal<?php echo $user['id_admin']; ?>">
                                                    Update
                                                </button>

                                                <!-- Update User Modal -->
                                                <div class="modal fade" id="updateModal<?php echo $user['id_admin']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateModalLabel">Update User</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="update_user.php">
                                                                    <input type="hidden" name="id_admin" value="<?php echo $user['id_admin']; ?>">
                                                                    <div class="form-group">
                                                                        <label for="username">Username:</label>
                                                                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="newPassword">Password:</label>
                                                                        <input type="text" class="form-control" id="newPassword" name="new_password" placeholder="Enter  password" required>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label for="divisi">Divisi:</label>
                                                                        <select class="form-control" id="divisi" name="divisi" required>
                                                                            <option value="1">Divisi 1</option>
                                                                            <option value="2">Divisi 2</option>
                                                                            <option value="3">Divisi 3</option>
                                                                            <option value="4">Divisi 4</option>
                                                                        </select>
                                                                    </div>

                                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Delete User Button -->
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $user['id_admin']; ?>">
                                                    Delete
                                                </button>

                                                <!-- Delete User Modal -->
                                                <div class="modal fade" id="deleteModal<?php echo $user['id_admin']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel">Hapus User</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Apakah Anda yakin ingin menghapus user ini?</p>
                                                                <form method="post" action="delete_user.php">
                                                                    <input type="hidden" name="id_admin" value="<?php echo $user['id_admin']; ?>">
                                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid-->
        </div>
    </body>

</html>


<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright &copy; Dinas Kependudukan dan Pencatatan Sipil Bireuen</small>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" jika anda ingin mengakhiri sesi.</div>
            <div class="modal-footer">
                <button class="btn btn-close card-shadow-2 btn-sm" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary btn-sm card-shadow-2" href="logout">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Version Info Modal -->
<!-- Modal -->
<div class="modal fade" id="VersionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Admin Versi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-close card-shadow-2 btn-sm" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/admin.js"></script>
<!-- Custom scripts for this page-->
<script src="js/admin-datatables.js"></script>
</div>
<!-- /.content-wrapper-->
</body>

</html>