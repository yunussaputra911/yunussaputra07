<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Laporan-Sistem Management Surat</title>

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
            overflow: hidden;
        }
        body {
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
        
        #tabeldetail{
            font-size: 14px;
            
            padding-bottom: 50px;
        }
    </style>

    <script>

    $(function(){
        $('html, body').css('overflow', 'hidden');

        function updateSize(){
            var winWidth = $(window).width(),
                winHeight = $(window).height(),

                $('#Tside').css({
                    height:winHeight
                });
        }
        updateSize();
        $(window).resize(function(){
            updateSize();
        });
    }
        );

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
  $tgl_awal = $_POST["tgl_awal"];
  $tgl_akhir = $_POST["tgl_akhir"];
  $tgl_satu = $tgl_awal.'/'.$tgl_akhir;

  $ta = $tgl_satu;
  header("location: laporan.php?id=$ta");
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
    <?php
    require_once("judul.php");
    ?>

    <div class="page-content">
        <div class="flex-grid no-responsive-future" style="height: 100%;">
            <div class="row" style="height: 100%" id="Tside">
                <?php
                require_once("sidebar.php");
                ?>
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content div1" style="overflow: scroll;">
                     <div class="window" style="margin-top:25px;">
                            <div class="window-caption bg-grayDark fg-white">
                                <span class="window-caption-icon"><span class="mif-print"></span></span>
                                <span class="window-caption-title">Laporan Surat Masuk & Keluar</span>
                                <a href="suratmasuk.php"><span class="btn-close bg-grayDark fg-white"></span></a>
                            </div>
                            <div class="window-content bg-white padding10" style="height: auto;">
            <div class="tabcontrol2" data-role="tabcontrol">
                            <ul class="tabs">
                                <li><a href="#frame_1_1">Surat Masuk</a></li>
                                <li><a href="#frame_1_2">Surat Keluar</a></li>
                            </ul>
                            <div class="frames bg-grayLight">
                                <div class="frame" id="frame_1_1">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="3000" enctype="multipart/form-data">
            <div class="input-control text mini-size" data-role="datepicker" data-date="1972-12-21" data-format="yyyy-mm-dd">
            <label for="tgl_terima">Tanggal Awal:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tgl_awal" id="tgl_terima">
                <button class="button"><span class="mif-calendar"></span></button>
            </div>
            <div class="input-control text mini-size" data-role="datepicker" data-date="1972-12-21" data-format="yyyy-mm-dd">
            <label for="tgl_terima">Tanggal Akhir:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tgl_akhir" id="tgl_terima">
                <button class="button"><span class="mif-calendar"></span></button>
            </div>
               <button type="submit" class="button primary" name="btnUpload">Oke</button>
        </form>              
        <?php
        if (isset($_REQUEST["id"])) {
        $ambil = $_REQUEST["id"];
        $ambiltgl = explode("/", $ambil);
        $tgl1 = $ambiltgl[0];
        $tgl2 = $ambiltgl[1];
        echo "<iframe height=\"450px\" width=\"100%\" src=\"laporan/tglsuratmasuk.php?id=$ambil\" name=\"iframe_a\"></iframe> ";
        }else{
            echo "<iframe height=\"450px\" width=\"100%\" src=\"laporan/suratmasuk.php\" name=\"iframe_a\"></iframe> ";
        }
        ?>
                                   
                                </div>
                                <div class="frame" id="frame_1_2">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="3000" enctype="multipart/form-data">
            <div class="input-control text mini-size" data-role="datepicker" data-date="1972-12-21" data-format="yyyy-mm-dd">
            <label for="tgl_terima">Tanggal Awal:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tgl_awal" id="tgl_terima">
                <button class="button"><span class="mif-calendar"></span></button>
            </div>
            <div class="input-control text mini-size" data-role="datepicker" data-date="1972-12-21" data-format="yyyy-mm-dd">
            <label for="tgl_terima">Tanggal Akhir:</label>
                <input data-validate-func="required" data-validate-hint="This field can not be empty"
                type="text" name="tgl_akhir" id="tgl_terima">
                <button class="button"><span class="mif-calendar"></span></button>
            </div>
               <button type="submit" class="button primary" name="btnUpload">Oke</button>
        </form>
        <?php
        if (isset($_REQUEST["id"])) {
        $ambil = $_REQUEST["id"];
        $ambiltgl = explode("/", $ambil);
        $tgl1 = $ambiltgl[0];
        $tgl2 = $ambiltgl[1];
        echo "<iframe height=\"450px\" width=\"100%\" src=\"laporan/tglsuratkeluar.php?id=$ambil\" name=\"iframe_a\"></iframe> ";
        }else{
            echo "<iframe height=\"450px\" width=\"100%\" src=\"laporan/suratkeluar.php\" name=\"iframe_a\"></iframe> ";
        }
        ?>
                                </div>
                            </div>
                        </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>