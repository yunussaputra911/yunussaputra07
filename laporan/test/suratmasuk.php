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
    text-align: left;
    padding: 8px;
}

#laporan tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
<page orientation="paysage">
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
    <p align="center"><h2>MANAGEMENT SURAT</h2></p>
    <hr />
    <p align="center"><h4>DATA SURAT MASUK</h4></p>
    <p align="right">Tanggal : <b><?php echo date('d/m/Y  H:i:s'); ?></b></p>
    <table border="1" align="center" id="laporan">
        <tr align="center" bgcolor="#dddddd">
            <th style="width: 30px;" align="center">No</th>
            <th style="width: 80px;">ID Surat</th>
            <th>Tanggal Masuk</th>
            <th>Kode Surat</th>
            <th>Tanggal Surat</th>
            <th>Pengirim</th>
            <th>Surat Untuk</th>
            <th>Subjek Surat</th>
            <th>Deskripsi</th>
            <th>File Upload</th>
            <th>Jenis Surat</th>
        </tr>
        <?php
            require_once("../koneksi.php");
            $sql = "SELECT * FROM mail";
            $result = mysqli_query($conn, $sql);
            if ($result->num_rows > 0) {
            // output data of each row
            $n = 0;
            while($row = $result->fetch_assoc()) {
                $n++;
                                        ?>
        <tr>
        <td align="center"><?php echo $n;?></td>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["incoming_at"]; ?></td>
        <td><?php echo $row["mail_code"]; ?></td>
        <td><?php echo $row["mail_date"]; ?></td>
        <td><?php echo $row["mail_from"]; ?></td>
        <td><?php echo $row["mail_to"]; ?></td>
        <td><?php echo $row["mail_subject"]; ?></td>
         <td><?php echo $row["description"]; ?></td>
         <td><?php echo $row["file_upload"]; ?></td>
         <td><?php echo $row["mail_typeid"]; ?></td>
        </tr>
        <?php
    }
}
        ?>
    </table>
</page>
</page>
<?php


$content = ob_get_clean();

require_once(dirname(__FILE__).'/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'fr');
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('datasurmas.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
