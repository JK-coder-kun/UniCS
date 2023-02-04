
    <?php foreach($filter as $key=>$value){
        $postFilter=`<input type="hidden" name="filter[`.$key.`]" value="`.$value.`">`;
    }?>

    <?php foreach($filter as $key=>$value):?>
        <input type="hidden" name="filter[<?=$key?>]" value="<?=$value?>">
    <?php endforeach;?>