<div class="cell size-x200" id="cell-sidebar Tside" style="background-color: #71b1d1; height: 100%;">
                    <ul class="sidebar">
                            <li
                            <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'index.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="index.php">
                                <span class="mif-home icon"></span>
                                <span class="title">Dashboard</span>
                               
                            </a></li>
                            <?php
                            if ($level == 'admin'){
                            }else{
                                echo "<style>
                                    #sideuser {
                                        display: none;
                                    }
                                    </style>";
                            }
                            ?>
                            <li id="sideuser"
                            <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'user.php' or $uri_segment[2] == 'edituser.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="user.php">
                                <span class="mif-users icon"></span>
                                <span class="title">USER</span>
                                <span class="counter">
                                    <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM user";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                </span>
                            </a></li>
                            <li
                            <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'suratmasuk.php' or $uri_segment[2] == 'lihatsurat.php' or $uri_segment[2] == 'editsurmas.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="suratmasuk.php">
                                <span class="mif-folder-download icon"></span>
                                <span class="title">SURAT MASUK</span>
                                <span class="counter">
                                    <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM mail WHERE status='tidak'";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                </span>
                            </a></li>
                            <li
                             <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'suratkeluar.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="suratkeluar.php">
                                <span class="mif-folder-upload icon"></span>
                                <span class="title">SURAT KELUAR</span>
                                <span class="counter">
                                    <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM mail_out";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                </span>
                            </a></li>
                            <li
                            <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'disposisisurat.php' or $uri_segment[2] == 'editdisposisi.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="disposisisurat.php">
                                <span class="mif-paper-plane icon"></span>
                                <span class="title">DISPOSISI</span>
                                <span class="counter">
                                     <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM disposition";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                </span>
                            </a></li>
                            <li
                            <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'arsipsurat.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="arsipsurat.php">
                                <span class="mif-drafts icon"></span>
                                <span class="title">Arsip Surat</span>
                                <span class="counter">
                                     <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM mail WHERE status='arsip' and disposisi='sudah'";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                </span>
                            </a></li>
                            <?php
                            if ($level == 'pimpinan'){
                                 echo "<style>
                                    #sidepengaturan {
                                        display: none;
                                    }
                                    </style>";
                            }else{
                            }
                            ?>
                            <li id="sidepengaturan"
                            <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'pengaturan.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="pengaturan.php">
                                <span class="mif-cogs icon"></span>
                                <span class="title">Pengaturan</span>
                                <span class="counter">
                                    <?php
                                    require_once("koneksi.php");
                                    $sql = "SELECT id FROM mail_type";
                                    $result = mysqli_query($conn, $sql);
                                    echo mysqli_num_rows($result);
                                    ?>
                                </span>
                            </a></li>
                            <li
                            <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'laporan.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="laporan.php">
                                <span class="mif-print icon"></span>
                                <span class="title">Laporan</span>
                            </a></li>
                            <li
                            <?php
                            $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                            $uri_segment = explode('/', $uri_path);
                            if ($uri_segment[2] == 'about.php') {
                                echo "class='active'";
                            }else{

                            }
                            ?>
                            ><a href="about.php">
                                <span class="mif-info icon"></span>
                                <span class="title">About</span>
                            </a></li>
                        </ul>
                </div>