<div>
    <label for="">Layout</label>
    <select name="" class="form-control" id="layout_seal">
        <option value="0" selected="selected"> --Selecione-- </option>
        <?php
        $selected = '';
            foreach ($selects as $key => $value) {
                if($value->id == $layoutSeal) {
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
                echo '<option value="'.$value->id.'" >'.$value->description.'</option>';
            }
        ?>
    </select>
</div>