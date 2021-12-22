<div>
    <label for="">Layout</label>
    <select name="" class="form-control" id="">
        <?php
            foreach ($selects as $key => $value) {
                echo '<option value="'.$value->id.'">'.$value->description.'</option>';
            }
        ?>
    </select>
</div>