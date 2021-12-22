<div>
    <label for="">Layout</label>
    <select name="" class="form-control" id="layout_seal">
        <?php
        $selected = '';
            foreach ($selects as $key => $value) {
                if($value->id == $layoutSeal->id) {
                    $selected = 'selected';
                }else{
                    $selected = '';
                }
                echo '<option value="'.$value->id.'" >'.$value->description.'</option>';
            }
        ?>
    </select>
</div>