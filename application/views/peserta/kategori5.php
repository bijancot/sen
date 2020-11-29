<?php
        echo form_input('youtube',set_value('youtube',@$peserta->youtube),'','Link Youtube',form_error('youtube'));

        echo form_hidden('karya_',set_value('karya_',@$peserta->karya, FALSE));
        echo form_upload('karya','','','File Video',form_error('karya'),"File video berupa file mp4/avi/mpeg, dengan ukuran maksimal 250Mb");
        // echo '<p><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;  '.basename($peserta->karya).'</p>';
        if(@$peserta->karya){
                //echo '<p class="text-success"><label class="font-weight-bold">File Video</label><br><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;'.basename(@$peserta->karya).'</p>';
                echo '<small class="fomr-text text-success"><i class="fas fa-file-alt"></i> <label class="font-weight-bold">File : </label>&nbsp;&nbsp;&nbsp;'.basename($peserta->karya).'</small>';
        }
?>