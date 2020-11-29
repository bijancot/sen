<?php
        echo form_hidden('karya_',set_value('karya_',@$peserta->karya, FALSE));
        echo form_upload('karya','','','File Proposal',form_error('karya'),"File Proposal berupa file pdf, dengan ukuran maksimal 25Mb");
        // echo '<p><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;  '.basename($peserta->karya).'</p>';
        if(@$peserta->karya){
                //<small class=\"form-text text-muted\"> $desc </small>
                echo '<small class="form-text text-success mb-3"><i class="fas fa-file-alt"></i>&nbsp;<label class="font-weight-bold">File :</label>&nbsp;&nbsp;&nbsp;'.basename(@$peserta->karya).'</small>';
        }

        echo form_hidden('karya2_',set_value('karya2_',@$peserta->karya2, FALSE));
        echo form_upload('karya2','','','File Karya Desain',form_error('karya2'),"File Karya Desain berupa <strong>file RAR</strong> yang berisi file jpg/png/pdf/gif dan PSD/AI/sketch, dengan ukuran maksimal 100Mb");
        // echo form_upload('karya2','','','File Hasil',form_error('karya2'),"File Karya Desain berupa file jpg/png/pdf/gif, dengan ukuran maksimal 100Mb");
        // echo '<p><i class="fas fa-file-alt"></i>&nbsp;&nbsp;&nbsp;  '.basename($peserta->karya2).'</p>';
        if(@$peserta->karya2){
                echo '<small class="form-text text-success"><i class="fas fa-file-alt"></i> <label class="font-weight-bold">File : </label>&nbsp;&nbsp;&nbsp;'.basename(@$peserta->karya2).'</small>';
        }

        
?>