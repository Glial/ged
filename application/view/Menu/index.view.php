<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo $data['menu'];


use Glial\Html\Form;

echo '<form method="post" id="form-menu" action="">';
echo ($data['menum']['menu_ul']);

echo '';
?>
<button type="submit" id="btn-save-menu" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
<button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-floppy-remove"></span> Reset</button>

</form>


<br />
<form method="post" id="form-add-menu" action="">

    <div class="row">
        <div class="col-md-2"><label class="control-label" for="inputSuccess1">Name</label>
            <input type="text" name="menu[title]" class="form-control" id="menu-title"></div>
        <div class="col-md-2"><label class="control-label" for="inputSuccess1">Controller / Action</label>
            
              <?php
        echo Form::select('menu', 'url', $data['ressource'], array("class"=> "form-control"));
        
        ?>
          </div>
        <div class="col-md-3">
            <label class="control-label" for="inputSuccess1">Paramètres</label>
            <input type="text" class="form-control" id="inputSuccess1">
        </div>   
        <div class="col-md-3">
            <label class="control-label" for="inputSuccess1">Paramètres</label>
            <input type="text" class="form-control" id="inputSuccess1">
        </div>   
        <div class="col-md-2"> <label class="control-label right">&nbsp;</label><br />
            <button id="form-add-menu" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add an item</button>  

        </div>


</form>


<script>
    var _BASE_URL = './';
    var current_group_id = 1;
</script>
