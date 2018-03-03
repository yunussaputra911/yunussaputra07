<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Metro, a sleek, intuitive, and powerful framework for faster and easier web development for Windows Metro Style.">
    <meta name="keywords" content="HTML, CSS, JS, JavaScript, framework, metro, front-end, frontend, web development">
    <meta name="author" content="Sergey Pimenov and Metro UI CSS contributors">

    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />

    <title>Lihat Surat-Sistem Management Surat</title>

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
                <div class="cell auto-size padding20 no-padding-top bg-white container" id="cell-content div1" style="overflow: scroll">
                     <div class="window" style="margin-top:25px;">
                            <div class="window-caption bg-grayDark fg-white">
                                <span class="window-caption-icon"><span class="mif-eye"></span></span>
                                <span class="window-caption-title">Detail Surat</span>
                                <a href="suratmasuk.php"><span class="btn-close bg-grayDark fg-white"></span></a>
                            </div>
                            <div class="window-content bg-white padding10" style="height: auto;">
             <?php
                $id = $_REQUEST['id'];
                $sql = "SELECT id, incoming_at, mail_code, mail_date, mail_from, mail_to, mail_subject, description, file_upload, mail_typeid, userid, disposisi FROM mail where id = '$id'";
                            $result = mysqli_query($conn, $sql);
                            if ($result->num_rows > 0) {
                                 // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                    $id_surat = $row["id"];
            ?>
            <div class="tabcontrol2" data-role="tabcontrol">
                            <ul class="tabs">
                                <li><a href="#frame_1_1">Detail Surat</a></li>
                                <li><a href="#frame_1_2">Disposisi Surat</a></li>
                            </ul>
                            <div class="frames bg-grayLight">
                                <div class="frame" id="frame_1_1">                
                                    <table class="table striped hovered" id="tabeldetail">
                <tr>
                    <td>ID SURAT</td><td>: <?php echo $row["id"];?></td>
                </tr>
                <tr>
                    <td>Diterima Tanggal</td><td>: <?php echo $row["incoming_at"];?></td>
                </tr>
                <tr>
                    <td>Kode Surat</td><td>: <?php echo $row["mail_code"];?></td>
                </tr>
                <tr>
                    <td>Tanggal Surat</td><td>: <?php echo $row["mail_date"];?></td>
                </tr>
                <tr>
                    <td>Pengirim</td><td>: <?php echo $row["mail_from"];?></td>
                </tr>
                <tr>
                    <td>Surat Untuk</td><td>: <?php echo $row["mail_to"];?></td>
                </tr>
                <tr>
                    <td>Subjek Surat</td><td>: <?php echo $row["mail_subject"];?></td>
                </tr>
                <tr>
                    <td>Deskripsi</td><td>: <?php echo $row["description"];?></td>
                </tr>
                <tr>
                    <td>File Upload</td><td>: <a href="simpanfile.php?file=<?php echo $row["file_upload"]; ?>"><?php echo $row["file_upload"];?></a></td>
                </tr>
                <tr>
                    <td>Operator Surat</td><td>: <?php echo $row["userid"];?></td>
                </tr>
                <tr>
                    <td>Disposisi</td><td>: <?php echo $row["disposisi"];?></td>
                </tr>
                <tr>
                    <td>Tipe Surat</td><td>: <?php
                     $mail_id = $row["mail_typeid"];
                     $sql = "SELECT type FROM mail_type WHERE id = '$mail_id'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                           echo $row["type"];
                        }
                    }
                     ?>

                     </td>
                </tr>
            </table>
            <a href="laporan/detailsurmas.php?id=<?php echo $id_surat; ?>" target="_blank"><button class="button warning text-shadow" onclick="return confirm('Cetak Laporan?')" ><span class="mif-print"></span> Laporan</button></a>
                                </div>
                                <div class="frame" id="frame_1_2">
                                    <?php
                                        $sql = "SELECT * FROM disposition WHERE mailid = '$id'";
                                        $result = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <table class="table striped hovered" id="tabeldispo">
                <tr>
                    <td>ID Disposisi</td><td>: <?php echo $row["id"];?></td>
                </tr>
                <tr>
                    <td>Disposisi Tanggal</td><td>: <?php echo $row["disposition_at"];?></td>
                </tr>
                <tr>
                    <td>ID Surat</td><td>: <?php echo $row["mailid"];?></td>
                </tr>
                <tr>
                    <td>Disposisi Oleh</td><td>: <?php echo $row["reply_at"];?></td>
                </tr>
                <tr>
                    <td>Tanggapan</td><td>: <?php echo $row["notification"];?></td>
                </tr>
                <tr>
                    <td>Keterangan</td><td>: <?php echo $row["description"];?></td>
                </tr>
            </table>
            <a href="laporan/disposisi.php?id=<?php echo $id_surat; ?>" target="_blank"><button class="button warning text-shadow" onclick="return confirm('Cetak Laporan?')" ><span class="mif-print"></span> Laporan</button></a>
             <?php
        }
    }else{
        echo " <span class=\"tag warning\">Surat Belum di Disposisi</span>";
    }
            ?>

                                </div>
                            </div>
                        </div>
            
            <?php
        }
    }
            ?>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>