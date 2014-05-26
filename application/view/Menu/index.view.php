<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo $data['menu'];




echo '<form method="post" id="form-menu" action="'.LINK.'menu/save_position/id_menu:1/">';
echo ($data['menum']['menu_ul']);

echo '';

?>
<button type="submit" id="btn-save-menu" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove"></span> Reset</button>
</form>


<script>
var _BASE_URL = './';
var current_group_id = 1;
</script>
