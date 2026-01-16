<option value="">Pilih Daerah</option>
            <?php foreach ($senarai_town as $town) {?>
                <option value="<?php echo $town['id'];?>"
                
                <?php if ($id_daerah == $town['id']) { echo 'selected';}?>
                
                ><?php echo $town['name'];?></option>

                <?php } ?>