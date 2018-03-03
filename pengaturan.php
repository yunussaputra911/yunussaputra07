<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Pengaturan-Sistem Management Surat</title>

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
        	background-color: #F0F0F0;
            overflow: hidden;
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
<body>
<?php 
 require_once("koneksi.php");
//BUAT INPUT LOGIN

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $tipe = test_input($_POST["tipe"]);

  //kodeotomatis
   $query = "SELECT max(id) as maxKode FROM mail_type";
  $hasil = mysqli_query($conn,$query);
  $data = mysqli_fetch_array($hasil);
  $kode_otomatis = $data['maxKode'];

  $noUrut = (int)substr($kode_otomatis, 2, 3);
  $noUrut++;
  $char = "JS";
  $kode_otomatis = $char . sprintf("%03s", $noUrut);
  //=============================================================

    $sql = "INSERT INTO mail_type (id, type)
    VALUES ('$kode_otomatis', '$tipe')";

    if ($conn->query($sql) == TRUE) {
        header("location:pengaturan.php"); 
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="3000">
            <h1 class="text-light">Tambah Data</h1>
            <hr class="thin"/>
            <br />
            <div class="input-control text full-size" data-role="input">
                <label for="first">Tipe Surat:</label>
                <input   data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tipe" id="first">
                <span class="input-state-error mif-warning"></span>
                <span class="input-state-success mif-checkmark"></span>
            </div>
            <br />
            <br />
            <div class="form-actions">
                <button type="submit" class="button primary">Finish</button>
                <a href=""><button type="button" class="button link">Cancel</button></a>
            </div>
        </form>
</div>

    <?php
    require_once("judul.php");
    ?>

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%">
                <?php
                require_once("sidebar.php");
                ?>
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content div1" style="overflow: scroll">
                    <div class="window" style="margin-top:25px;">
                            <div class="window-caption bg-grayDark fg-white">
                                <span class="window-caption-icon"><span class="mif-cogs"></span></span>
                                <span class="window-caption-title">Pengaturan</span>
                            </div>
                            <div class="window-content bg-grayLighter padding20" style="height: auto;">
                                    <button class="button primary text-shadow" onclick="showDialog('dialog')" ><span class="mif-plus"></span> Tambah</button>
                    <table class="table dataTable striped hovered cell-hovered border bordered bg-white" data-role="datatable" data-searching="true" id="tableuser">
                        <thead>
                        <tr>
                            <td class="sortable-column sort-asc fg-white bg-blue" style="width:10px;">ID</td>
                            <td class="fg-white bg-cyan">Tipe</td>
                            <td class="fg-white bg-cyan" style="width:300px;">Action</td>
                        </tr>
                        </thead>
                        <?php
                            $sql = "SELECT id,type FROM mail_type";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                 // output data of each row
                                 while($row = $result->fetch_assoc()) {

                        ?>
                        <tr>
                            <td style="width:10px;"><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["type"] ?></td>
                            <td style="width: 30px">
                                <a href="editpengaturan.php?id=<?php echo $row["id"]; ?>"><button class="image-button small-button bg-lightGreen fg-white text-shadow" onclick="">
                                Edit
                                <span class="icon mif-pencil bg-green"></span>
                                </button>
                                <a href="hapuspengaturan.php?id=<?php echo $row["id"]; ?>"><button class="image-button small-button bg-red fg-white text-shadow" onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Pengaturan?')">
                                Hapus
                                <span class="icon mif-bin bg-darkRed"></span>
                                </button></a>
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
