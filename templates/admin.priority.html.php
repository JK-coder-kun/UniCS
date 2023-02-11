

<div class="container-fluid mt-3 mb-3 p-3">

    <h3>Edit Priority</h3>

    <hr>
    <?=$error??''?></br>
    <div class="container-fluid p-4">
        <form action="/UniCS/public/admin/priority" method="post" >
            <?php foreach ($priorityOrder as $priority) : ?>
                <div class="row mb-3 g-3">
                    <span class='col-sm-auto'>
                        <input type="text" class='form-control dummy-form bg-dark' placeholder="<?php echo $priority->reason ?>">
                    </span>
                    <span class="col-sm-auto">
                        <input type='number' class='form-control' name=priorityOrder[<?php echo $priority->reason; ?>] value=<?php echo $priority->priority; ?> required>
                    </span>
                </div>
            <?php endforeach; ?>
            <input class='btn btn-primary' type='submit' value='Change Priority'>
        </form>
    </div>

</div>

<div class="data-mdb-sortable">

</div>

