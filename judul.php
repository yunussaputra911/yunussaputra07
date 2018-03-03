<style>
  #judul table{
            width: 160px;
            color: white;
        }
        
        #gambarpp{
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin: auto;
        }

        #gambarpp2{
            width: 55px;
            height: 55px;
            border-radius: 50%;
            margin: auto;
        }
</style>
<script type="text/javascript">
  function showDialog(id){
            var dialog = $("#"+id).data('dialog');
            if (!dialog.element.data('opened')) {
                dialog.open();
            } else {
                dialog.close();
            }
        }
</script>
<div data-role="dialog" id="dialog2" class="padding20" data-close-button="true">
<br />
<br />
 <form method="post" action="gantifoto.php"  data-role="validator" data-show-required-state="false" data-hint-mode="line" data-hint-background="bg-red" data-hint-color="fg-white" data-hide-error="3000" enctype="multipart/form-data">   
            <div class="input-control file full-size" data-role="input">
                <label for="file_upload">Pilih Foto:</label>
                <input type="file" data-validate-func="required" data-validate-hint="This field can not be empty"
                name="data_upload" id="file_upload">
                <button class="button"><span class="mif-folder"></span></button>
            </div>
            <input type="hidden" name="no_id" value="<?php echo $user_id; ?>">
            <div class="form-actions">
                <button type="submit" class="button primary" name="btnUpload">Finish</button>
                <a href=""><button type="button" class="button link">Cancel</button></a>
            </div>
        </form>           
            
</div>
<div class="app-bar fixed-top darcula" data-role="appbar" id="judul">
        <a class="app-bar-element branding" id="judul2"><span class="mif-books mif-2x fg-lighterBlue"></span> <b>Management Surat</b></a>
        <div class="app-bar-element place-right" id="judul2">
           <span class="dropdown-toggle"><img src="<?php echo "img/$picture"; ?>" id="gambarpp"> <?php echo $fullname;?></span>
            <div class="app-bar-drop-container place-right fg-grayLighter padding10" data-role="dropdown" data-no-close="true" style="width: 250px">
               <table>
                   <tr>
                       <td rowspan="2"><img src="<?php echo "img/$picture"; ?>" id="gambarpp2"></td><td><b><?php echo $fullname;?></b></td>
                   </tr>
                   <tr>
                       <td><i><?php echo $level;?></i></td>
                   </tr>
               </table>
                <ul class="unstyled-list fg-grayLighter">
                    <li><button class="image-button small-button" onclick="showDialog('dialog2')">
                            Ganti Foto
                            <span class="icon mif-image fg-white"></span>
                        </button>
                        <a href="keluar.php" class="fg-white fg-hover-yellow">
                      <button class="image-button small-button">
                            Keluar
                            <span class="icon mif-exit fg-white"></span>
                        </button>
                    </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>