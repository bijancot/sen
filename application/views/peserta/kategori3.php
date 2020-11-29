<?php
        echo form_hidden('karya_',set_value('karya_',@$peserta->karya, FALSE));
        echo form_upload('karya','','','File Proposal',form_error('karya'),"File proposal berupa file pdf, dengan ukuran maksimal 10Mb");
        // echo '<p><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;  '.basename($peserta->karya).'</p>';
        if(@$peserta->karya){
                //echo '<p class="text-success"><label class="font-weight-bold">File karya</label><br><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;'.basename(@$peserta->karya).'</p>';
                echo '<small class="fomr-text text-success"><i class="fas fa-file-alt"></i> <label class="font-weight-bold">File : </label>&nbsp;&nbsp;&nbsp;'.basename($peserta->karya).'</small>';
        }
?>