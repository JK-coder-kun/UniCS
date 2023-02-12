<?php


// print_r($filter);

$postFilter = "";
?>

<!-- also showing warning error on my side, so I put the foreach loop in a if condition -->
<?php
if ($filter) {
    // echo "filter is in";
    foreach ($filter as $key => $value) {
        $postFilter .= "<input type=\"hidden\" name=\"filter[" . $key . "]\" value=\"" . $value . "\">";
    }
} else {
    // echo "filter is empty";
}

?>
<div class="mt-3 mb-3 p-3">
    <!-- original filter -->
    <!-- <?php foreach ($filter as $key => $value) {
                $postFilter .= "<input type=\"hidden\" name=\"filter[" . $key . "]\" value=\"" . $value . "\">";
            } ?> -->

    <h4>Edit Schedule</h4>
    <hr>

    <div class="container-fluid">

        <form action="/UniCS/public/admin/listschedule" method="get" class='row g-2'>
            <label class='visually-hidden' for="filter[roomNo]">RoomNo</label>
            <span class='col-sm-2'>
                <input type="number" name="filter[roomNo]" id="" class='form-control' placeholder='Room Number' value=<?= $filter['roomNo'] ?? '' ?>>
            </span>

            <label class='visually-hidden' for="filter[period]">Period</label>
            <span class='col-sm-2'>
                <input type="number" name="filter[period]" id="" class='form-control' placeholder='Period' value=<?= $filter['period'] ?? '' ?>>
            </span>

            <label class='visually-hidden' for="filter[day]">Day</label>
            <span class='col-sm-auto'>
                <input type="text" name="filter[day]" id="" class='form-control' placeholder='Day' value=<?= $filter['day'] ?? '' ?>>
            </span>

            <label class='visually-hidden' for="filter[section]">Section</label>
            <span class='col-sm-2'>
                <input type="text" name="filter[section]" id="" class='form-control' placeholder='Section' value=<?= $filter['section'] ?? '' ?>>
            </span>

            <label class='visually-hidden' for="filter[subjectCode]">subjectCode</label>
            <span class='col-sm-2'>
                <input type="number" name="filter[subjectCode]" id="" class='form-control' placeholder='Subject Code' value=<?= $filter['subjectCode'] ?? '' ?>>
            </span>

            <span class="col-sm-auto">
                <input type="submit" class='btn btn-primary' value="Filter">
            </span>

            <span class="col-sm-auto">
                <a class='btn btn-primary' href="/UniCS/public/admin/listschedule">All</a>
            </span>
        </form>

        <!-- <hr> -->
        <br>

        <!-- <div class="container-fluid p-4" style='background-color:#66ffb3'> -->
            <div class="container-fluid p-4" style='background-color:lightgoldenrodyellow;'>
            <div class="row mb-3 gx-1">
                <span class="col-11">
                    <form action="" class="row">
                        <span class='col-sm-2'>
                            <input type="text" readonly class='form-control-plaintext dummy-form-title' value="Room Number">
                        </span>
                        <span class='col-sm-2'>
                            <input type="text" readonly class='form-control-plaintext dummy-form-title' value="Period">
                        </span>
                        <span class='col-sm-2'>
                            <input type="text" readonly class='form-control-plaintext dummy-form-title' value="Section">
                        </span>
                        <span class='col-sm-2'>
                            <input type="text" readonly class='form-control-plaintext dummy-form-title' value="Day">
                        </span>
                        <span class='col-sm-2'>
                            <input type="text" readonly class='form-control-plaintext dummy-form-title' value="Subject Code">
                        </span>
                    </form>
                </span>
                <!-- dummy code as placeholder -->
                <span class="col-1"></span>
            </div>

            <?php foreach ($result as $row) : ?>
                <div class='row mb-3 gx-1'>
                    <span class='col-11'>
                        <form action="/UniCS/public/admin/editschedule" method="post" class='row'>
                            <?= $postFilter ?>
                            <input type="hidden" name="schedule[id]" value=<?= $row->id ?>>
                            <span class='col-sm-2'>
                                <input type="number" name="schedule[roomNo]" id="" class='form-control' value=<?= $row->roomNo ?>>
                            </span>
                            <span class='col-sm-2'>
                                <input type="number" name="schedule[period]" id="" class='form-control' value=<?= $row->period ?>>
                            </span>
                            <span class='col-sm-2'>
                                <input type="text" name="schedule[day]" id="" class='form-control' value=<?= $row->day ?>>
                            </span>
                            <span class='col-sm-2'>
                                <input type="text" name="schedule[section]" id="" class='form-control' value=<?= $row->section ?>>
                            </span>
                            <span class='col-sm-2'>
                                <input type="number" name="schedule[subjectCode]" id="" class='form-control' value=<?= $row->subjectCode ?>>
                            </span>
                            <span class='col-sm-2'>
                                <input type="submit" class='form-control btn btn-primary' value="Edit">
                            </span>
                        </form>
                    </span>

                    <span class='col-1'>
                        <form action="/UniCS/public/admin/deleteschedule" method="post">
                            <input type="hidden" name="id" value=<?= $row->id ?>>
                            <?= $postFilter ?>
                            <input class='btn btn-danger' type="submit" value="Delete">
                        </form>
                    </span>
                </div>


            <?php endforeach; ?>
        </div>


        <!-- <hr> -->
        <br>

        <form action="/UniCS/public/admin/addschedule" method="post" class='row g-2'>
            <?= $postFilter ?>
            <span class='col-sm-2'>
                <input type="number" name="schedule[roomNo]" id="" class='form-control' placeholder='Room Number' value=<?= $filter['roomNo'] ?? '' ?> required>
            </span>
            <span class='col-sm-2'>
                <input type="number" name="schedule[period]" id="" class='form-control' placeholder='Period' value=<?= $filter['period'] ?? '' ?> required>
            </span>
            <span class='col-sm-2'>
                <input type="text" name="schedule[day]" id="" class='form-control' placeholder='Day' value=<?= $filter['day'] ?? '' ?>>
            </span>
            <span class='col-sm-2'>
                <input type="text" name="schedule[section]" id="" class='form-control' placeholder='Section' value=<?= $filter['section'] ?? '' ?>>
            </span>
            <span class='col-sm-2'>
                <input type="number" name="schedule[subjectCode]" id="" class='form-control' placeholder='Subject Code' value=<?= $filter['subjectCode'] ?? '' ?>>
            </span>
            <span class='col-sm-2'>
                <input class='btn btn-primary' type="submit" value="Add">
            </span>

        </form>
    </div>

</div>