<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Surat Masuk-Sistem Management Surat</title>

        <link href="css/metro.css" rel="stylesheet">
    <link href="css/metro-icons.css" rel="stylesheet">
    <link href="css/metro-responsive.css" rel="stylesheet">
    <link href="css/metro-schemes.css" rel="stylesheet">

    <link href="css/docs.css" rel="stylesheet">

    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/metro.js"></script>
    <script src="js/docs.js"></script>
    <script src="js/prettify/run_prettify.js"></script>
    <script src="js/ga.js"></script>

    <style>
        html, body {
            height: 100%;
        }
        body {
        	background-color: white;

        }

        .page-content {
            padding-top: 3.125rem;
            min-height: 100%;
            height: 100%;
        }
        .table .input-control.checkbox {
            line-height: 1;
            min-height: 0;
            height: auto;
        }
        @media screen and (max-width: 800px){
            #cell-sidebar {
                flex-basis: 52px;
            }
            #cell-content {
                flex-basis: calc(100% - 52px);
            }
        }
        
        #tableuser{
            font-size: 14px;
            background-color: white;
            padding-bottom: 50px;
        }
    </style>

    <script>



        function pushMessage(t){
            var mes = 'Info|Implement independently';
            $.Notify({
                caption: mes.split("|")[0],
                content: mes.split("|")[1],
                type: t
            });
        }

        $(function(){
            $('.sidebar').on('click', 'li', function(){
                if (!$(this).hasClass('active')) {
                    $('.sidebar li').removeClass('active');
                    $(this).addClass('active');
                }
            });
        });

        function showDialog(id){
            var dialog = $("#"+id).data('dialog');
            if (!dialog.element.data('opened')) {
                dialog.open();
            } else {
                dialog.close();
            }
        }
        $(function(){
            $('#example_table').dataTable();
        });

    </script>
</head>
<body style=" overflow: hidden;">
<?php 
 require_once("koneksi.php");
//BUAT INPUT LOGIN

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tgl_terima = test_input($_POST["tgl_terima"]);
  $kd_surat = test_input($_POST["kd_surat"]);
  $tgl_surat = test_input($_POST["tgl_surat"]);
  $asal_surat = test_input($_POST["asal_surat"]);
  $surat_untuk = test_input($_POST["surat_untuk"]);
  $subjek_surat = test_input($_POST["subjek_surat"]);
  $deksripsi = test_input($_POST["deskripsi"]);
  $tipe_surat = test_input($_POST["tipe_surat"]);
  $no_id = test_input($_POST["no_id"]);

  //kodeotomatis
   $query = "SELECT max(id) as maxKode FROM mail";
  $hasil = mysqli_query($conn,$query);
  $data = mysqli_fetch_array($hasil);
  $kode_otomatis = $data['maxKode'];

  $noUrut = (int)substr($kode_otomatis, 2, 3);
  $noUrut++;
  $char = "SM";
  $kode_otomatis = $char . sprintf("%03s", $noUrut);
  //=============================================================

//UPLOAD FILE-----------------------------------------------------------------------
$eror = false;
$folder = 'upload/';
$file_type = array('jpg','jpeg','png','gif','bmp','doc','docx','xls','sql','PNG','JPG','JPEG');
$max_size = 1000000;
if (isset($_POST['btnUpload'])) {
    $file_name = $_FILES['data_upload']['name'];
    $file_size = $_FILES['data_upload']['size'];
    $explode = explode('.', $file_name);
    $extensi = $explode[count($explode)-1];
    if (!in_array($extensi, $file_type)) {
        $eror = true;
        $pesan = 'file yang anda upload tidak sesuai';
    }
    if ($file_size > $max_size) {
        $eror = true;
        $pesan = 'file yg anda upload terlalu besar';
    }
    if (file_exists("upload/" . $file_name)){
    $eror = true;
        $pesan = 'file yg anda upload sudah ada';
    }
    if ($eror == true ) {
         echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'warning', caption: 'Gagal', content: \"$pesan\"});
                    }, 30);
                });
            </script>";
    }else{
        if (move_uploaded_file($_FILES['data_upload']['tmp_name'], $folder.$file_name)) {
            $file_img = $file_name;
        }else{
             echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'warning', caption: 'Gagal', content: \"Terjadi Kesalahan Saat Upload file\"});
                    }, 30);
                });
            </script>";
        }
     $sql = "INSERT INTO mail (id, incoming_at, mail_code, mail_date, mail_from, mail_to, mail_subject, description, file_upload, mail_typeid, userid)
    VALUES ('$kode_otomatis', '$tgl_terima', '$kd_surat', '$tgl_surat', '$asal_surat', '$surat_untuk', '$subjek_surat', '$deksripsi', '$file_img', '$tipe_surat', '$no_id')";

    if ($conn->query($sql) == TRUE) {
        echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'success', caption: 'Berhasil', content: \"Data Berhasil Di tambahkan\"});
                    }, 30);
                });
            </script>";
    } else {
        echo "<script>
                $(function(){
                setTimeout(function(){
                    $.Notify({type: 'warning', caption: 'Gagal', content: \"Data Gagal di tambahkan\"});
                    }, 30);
                });
            </script>";
    }
    }
}
//======================================================================================================

   
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//BUAT VALIDATION SESSION
session_start();
if(!isset($_SESSION['username'])) {
header("location:login.php"); }
else{
    $username = $_SESSION['username'];
}
$sql = "SELECT id, fullname, level, picture FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $fullname = $row["fullname"];
        $level = $row["level"];
        $picture = $row["picture"];
        $user_id =  $row["id"];
    }
}
?>

<div data-role="dialog" id="dialog" class="padding20" data-close-button="true">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="3000" enctype="multipart/form-data">
            <h1 class="text-light">Surat Masuk</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control text mini-size" data-role="datepicker" data-date="1972-12-21" data-format="yyyy-mm-dd">
            <label for="tgl_terima">Tanggal Terima:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tgl_terima" id="tgl_terima">
                <button class="button"><span class="mif-calendar"></span></button>
            </div>
            <div class="input-control text mini-size" data-role="input">
                <label for="kd_surat">Kode Surat:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="kd_surat" id="kd_surat">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control text mini-size" data-role="datepicker" data-date="1972-12-21" data-format="yyyy-mm-dd">
            <label for="tgl_surat">Tanggal Surat:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tgl_surat" id="tgl_surat">
                <button class="button"><span class="mif-calendar"></span></button>
            </div>
            <div class="input-control text mini-size" data-role="input">
                <label for="asal_surat">Asal Surat:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="asal_surat" id="asal_surat">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control text mini-size" data-role="input">
                <label for="surat_untuk">Surat Untuk:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="surat_untuk" id="surat_untuk">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <div class="input-control text mini-size" data-role="input">
                <label for="subjek_surat">subjek Surat:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="subjek_surat" id="subjek_surat">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="deksripsi">deskripsi:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="deskripsi" id="deskripsi">
                <button class="button helper-button clear"><span class="mif-cross"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control file full-size" data-role="input">
                <label for="file_upload">File Upload:</label>
                <input type="file" data-validate-func="required" data-validate-hint="This field can not be empty"
                name="data_upload" id="file_upload">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
            <br />
            <br />
            <div class="input-control select full-size">
                <label for="class">Tipe Surat:</label>
                <select id="class" name="tipe_surat">
                <?php
                $sql = "SELECT id, type FROM mail_type";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["type"]; ?></option>
                    <?php
                }
            }
                    ?>
                </select>
            </div>
            <br />
            <br />
            <input type="hidden" name="no_id" value="<?php echo $user_id; ?>">
            <div class="form-actions">
                <button type="submit" class="button primary" name="btnUpload">Finish</button>
                <a href=""><button type="button" class="button link">Cancel</button></a>
            </div>
        </form>
</div>

    <?php
    require_once("judul.php");
    ?>
    <div class="page-content">
        <div class="flex-grid" style="height: 100%;">
            <div class="row" style="height: 100%;">
                <?php
                require_once("sidebar.php");
                ?>
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content div1" style="overflow: scroll;">
                     <div class="window" style="margin-top:25px;">
                            <div class="window-caption bg-grayDark fg-white">
                                <span class="window-caption-icon"><span class="mif-file-download"></span></span>
                                <span class="window-caption-title">Surat Masuk</span>
                            </div>
                            <div class="window-content bg-grayLighter padding20" style="height: auto;">
                            <?php
                            if ($level == 'pimpinan') {
                                
                            }else{
                                echo "<button class=\"button primary text-shadow\" onclick=\"showDialog('dialog')\" ><span class=\"mif-plus\"></span> Tambah</button>";
                            }
                            ?>
                            <a href="laporan/suratmasuk.php" target="_blank"><button class="button success text-shadow" onclick="return confirm('Cetak Laporan?')" ><span class="mif-print"></span> Laporan</button></a>
                    <table class="table dataTable striped hovered cell-hovered border bordered" data-role="datatable" data-searching="true" id="tableuser">
                        <thead>
                        <tr>
                            <td class="sortable-column sort-asc fg-white bg-blue" style="width: 80px;">ID</td>
                            <td class="fg-white bg-cyan">Diterima Tgl</td>
                            <td class="fg-white bg-cyan">Kode Surat</td>
                            <td class="fg-white bg-cyan">Tgl Surat</td>
                            <td class="fg-white bg-cyan">Pengirim</td>
                            <td class="fg-white bg-cyan">Subjek Surat</td>
                            <td class="fg-white bg-cyan">File Upload</td>
                            <td class="fg-white bg-cyan">Disposisi</td>
                            <td class="fg-white bg-cyan">Action</td>
                        </tr>
                        </thead>
                        <?php
                            $sql = "SELECT id, incoming_at, mail_code, mail_date, mail_from, mail_to, mail_subject, description, file_upload, mail_typeid, userid, disposisi FROM mail WHERE status='tidak'";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                 // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                    $id = $row["id"];

                        ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["incoming_at"]; ?></td>
                            <td><?php echo $row["mail_code"]; ?></td>
                            <td><?php echo $row["mail_date"]; ?></td>
                            <td><?php
                            if (strlen($row["mail_from"]) < 10 ) {
                                echo $row["mail_from"];
                            }else{
                                echo substr($row["mail_from"], 0,10).".....";
                            }
                            ?></td>
                            <td><?php echo substr($row["mail_subject"], 0,10);
                            $jumlahkata = strlen($row["mail_subject"]);
                            if ($jumlahkata > 10) {
                                echo "....";
                            }?>
                            </td>
                            <td><?php echo substr($row["file_upload"], 0,15);
                            $jumlahkata = strlen($row["file_upload"]);
                            if ($jumlahkata > 15) {
                                echo "....";
                            }?>
                            </td>
                            <td align="center">
                              <?php
                                if ($row["disposisi"] == 'belum') {
                                    echo "<span class=\"mif-cross fg-red mif-lg\"></span>";
                                }else{
                                    echo "<span class=\"mif-checkmark fg-green mif-2x\"></span>";
                                }
                              ?>  
                            </td>
                            <td>
                            <?php
                            if ($level == 'pimpinan') {
                                if ($row["disposisi"] == 'sudah') {
                                    echo "<a href=\"arsip.php?id=$id\"><button class=\"square-button small-button text-shadow bg-green fg-white\" data-role=\"hint\" data-hint-background=\"bg-lightGreen\" data-hint-color=\"fg-white\" data-hint-mode=\"2\" data-hint=\"Arsip Surat\" data-hint-position=\"left\" onclick=\"return confirm('Apakah Anda Yakin Untuk Mengarsipkan Surat?')\"><span class=\"mif-drafts\"></span></button></a>";
                                }else{
                                    echo "<a href=\"disposisi.php?id=$id\"><button class=\"square-button small-button text-shadow bg-green fg-white\" data-role=\"hint\" data-hint-background=\"bg-lightGreen\" data-hint-color=\"fg-white\" data-hint-mode=\"2\" data-hint=\"disposisi\" data-hint-position=\"left\"><span class=\"mif-paper-plane\"></span></button></a>";
                                }
                            }else{
                                if ($row["disposisi"] == 'sudah') {
                                echo "<a href=\"arsip.php?id=$id\"><button class=\"square-button small-button text-shadow bg-green fg-white\" data-role=\"hint\" data-hint-background=\"bg-lightGreen\" data-hint-color=\"fg-white\" data-hint-mode=\"2\" data-hint=\"Arsip Surat\" data-hint-position=\"left\" onclick=\"return confirm('Apakah Anda Yakin Untuk Mengarsipkan Surat?')\"><span class=\"mif-drafts\"></span></button></a>";
                                }else{
                                echo "<a href=\"editsurmas.php?id=$id\"><button class=\"square-button small-button text-shadow bg-green fg-white\" data-role=\"hint\" data-hint-background=\"bg-lightGreen\" data-hint-color=\"fg-white\" data-hint-mode=\"2\" data-hint=\"Edit\" data-hint-position=\"left\"><span class=\"mif-pencil\"></span></button></a>";
                                }
                            }
                            ?>                                
                                <a href="deletesurmas.php?id=<?php echo $row["id"]; ?>"><button class="square-button small-button text-shadow bg-darkRed fg-white" data-role="hint" data-hint-background="bg-red" data-hint-color="fg-white" data-hint-mode="2" data-hint="Hapus" data-hint-position="top" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Pesan?')"><span class="mif-bin"></span></button></a>
                                <a href="lihatsurat.php?id=<?php echo $row["id"]; ?>"><button class="square-button small-button text-shadow bg-darkCyan fg-white" data-role="hint" data-hint-background="bg-blue" data-hint-color="fg-white" data-hint-mode="2" data-hint="Lihat" data-hint-position="bottom"><span class="mif-eye"></span></button></a>
                            </td>
                        </tr>
                        <?php
                    }
                }
            
                        ?>
                    </table>
                                    <br />
                                    <br />
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
