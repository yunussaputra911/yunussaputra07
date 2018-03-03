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
    border: 1px solid black;
    padding: 8px;
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
    <p align="center"><b>LEMBAR DISPOSISI</b></p>
     <?php
            require_once("../koneksi.php");
            $id_surat = $_REQUEST["id"];
            $sql = "SELECT * FROM mail WHERE id='$id_surat'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
                                        ?>
    <table id="laporan">
        <tr>
            <td style="width: 20%;">Surat Dari</td><td style="width: 30%;"><?php echo $row["mail_from"];?></td><td style="width: 20%;">Diterima Tanggal</td><td style="width: 30%;"><?php echo $row["incoming_at"];?></td>
        </tr>
        <tr>
            <td style="width: 20%;">Tanggal Surat</td><td style="width: 30%;"><?php echo $row["mail_date"];?></td><td style="width: 20%;">Nomor Surat</td><td style="width: 30%;"><?php echo $row["mail_code"];?></td>
        </tr>
        <tr>
            <td style="width: 20%; height:50px; vertical-align: top;">Perihal</td><td style="width: 30%; vertical-align: top;"><?php echo $row["mail_subject"];?></td><td style="width: 20%; vertical-align: top;">Deskripsi</td><td style="width: 30%; vertical-align: top;"><?php echo $row["description"];?></td>
        </tr>
    </table>
    <br>
    <?php
}
            require_once("../koneksi.php");
            $id_surat = $_REQUEST["id"];
            $sql = "SELECT * FROM disposition WHERE mailid='$id_surat'";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
                                        ?>
    <table id="laporan">
        <tr>
            <td style="width: 50%;">Di Disposisi Oleh :</td><td style="width: 50%;">Isi Disposisi :</td>
        </tr>
        <tr>
            <td style="width: 50%;  height:50px; vertical-align: top;"><?php echo $row["reply_at"];?></td><td style="width: 50%; vertical-align: top;"><?php echo $row["description"];?></td>
        </tr>
    </table>
    <?php
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
    $html2pdf->Output('detailsurmas.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
