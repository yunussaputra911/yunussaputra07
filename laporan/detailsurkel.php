<?php
/**
 * HTML2PDF Library - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2016 Laurent MINGUET
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

ob_start();
?>
<style type="text/css">
<!--
    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
-->
#laporan {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#laporan td, th {
    border: 1px solid #DDDDDD;
    padding: 8px;
    word-wrap: break-word;
}
</style>
<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" pagegroup="new">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 100%; text-align: left">
                    Sistem Management Surat SMKN 2 Kota Bekasi
                </td>
            </tr>
        </table>
    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>
            <td style="width: 50%; text-align: left">
                    Copyright &copy; 2018 Rekayasa Perangkat Lunak
                </td>
                <td style="width: 50%; text-align: right">
                    page [[page_cu]]/[[page_nb]]
                </td>
            </tr>
        </table>
    </page_footer>
    <table>
        <tr><td rowspan="3"><img src="smkn2.png" width="65px;"></td><td><b>Management Surat</b></td></tr>
        <tr><td>SMK NEGERI 2 KOTA BEKASI</td></tr>
        <tr><td>Jl. Lapangan Bola Rawa Butun-Ciketingudik-Bantargebang-Kota Bekasi</td></tr>
    </table>
    <hr />
    <p align="center"><b>DATA DETAIL SURAT KELUAR</b></p>
    <p align="right">Tanggal : <b><?php echo date('d/m/Y  H:i:s'); ?></b></p>
     <?php
            require_once("../koneksi.php");
            $id_surat = $_REQUEST["id"];
            $sql = "SELECT * FROM mail_out WHERE id='$id_surat'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                                        ?>
    <table id="laporan">
        <tr>
            <td style="width: 160px; font-weight: bold;">ID SURAT</td><td style="width:480px;">: <?php echo $row["id"];?></td>
        </tr>
        <tr>
            <td style="width: 160px; font-weight: bold;">KODE SURAT</td><td style="width:480px;">: <?php echo $row["mail_code"];?></td>
        </tr>
        <tr>
            <td style="width: 160px; font-weight: bold;">TANGGAL SURAT</td><td style="width:480px;">: <?php echo $row["mail_date"];?></td>
        </tr>
        <tr>
            <td style="width: 160px; font-weight: bold;">SURAT UNTUK</td><td style="width:480px;">: <?php echo $row["mail_to"];?></td>
        </tr>
        <tr>
            <td style="width: 160px; font-weight: bold;">SUBJEK SURAT</td><td style="width:480px;">: <?php echo $row["mail_subject"];?></td>
        </tr>
        <tr>
            <td style="width: 160px; font-weight: bold;">DESKRIPSI</td><td style="width:480px;">: <?php echo $row["description"];?></td>
        </tr>
        <tr>
            <td style="width: 160px; font-weight: bold;">FILE UPLOAD</td><td style="width:480px;">: <?php echo $row["file_upload"];?></td>
        </tr>
        <tr>
            <td style="width: 160px; font-weight: bold;">JENIS SURAT</td><td style="width:480px;">: 
            <?php
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
    <?php
}
}
    ?>
</page>
<?php


$content = ob_get_clean();

require_once(dirname(__FILE__).'/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 0);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('detailsurkel.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
