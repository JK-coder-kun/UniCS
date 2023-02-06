<?php
// print_r($priorityOrder);
?>

<div class="container-fluid mt-3 mb-3 p-3">

    <h3>Edit Priority</h3>

    <hr>

    <div class="container-fluid p-4">
        <form action="/UniCS/public/admin/priority" >
            <?php foreach ($priorityOrder as $priority) : ?>
                <div class="row mb-3 g-3">
                    <span class='col-sm-auto'>
                        <input type="text" class='form-control dummy-form bg-dark' placeholder="<?php echo $priority->reason ?>">
                    </span>
                    <span class="col-sm-auto">
                        <input type='number' class='form-control' name='<?php echo $priority->reason; ?>' value=<?php echo $priority->priority; ?>>
                    </span>
                </div>
            <?php endforeach; ?>
            <input class='btn btn-primary' type='submit' value='Change Priority'>
        </form>
    </div>

</div>