<div class="mt-3 mb-3 p-3">
    <h4>Edit Priority</h4>
    <hr>
    <!-- </br> -->
    <div class="container-fluid">
        <form action="/UniCS/public/admin/priority" method="post">
            <?php foreach ($priorityOrder as $priority) : ?>
                <div class="row mb-3 g-3">
                    <span class='col-sm-auto'>
                        <input type="text" readonly class='form-control-plaintext dummy-form-title' value="<?php echo $priority->reason ?>">
                    </span>
                    <span class="col-sm-auto">
                        <input type='number' class='form-control' name=priorityOrder[<?php echo $priority->reason; ?>] value=<?php echo $priority->priority; ?> required>
                    </span>
                </div>
            <?php endforeach; ?>
            <input class='btn btn-primary' type='submit' value='Change Priority'>
        </form>
        <span style='color:red'><?= $error ?? '' ?></span>
    </div>
</div>

<div class="data-mdb-sortable">

</div>