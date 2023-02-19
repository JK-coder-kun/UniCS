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

        <form action="/UniCS/public/admin/listschedule" method="get" class='row g-2 justify-content-center'>
            <label class='visually-hidden' for="filter[roomNo]">RoomNo</label>
            <span class='col-sm-auto'>
                <input type="number" name="filter[roomNo]" id="" class='form-control' placeholder='Room Number' value=<?= $filter['roomNo'] ?? '' ?>>
            </span>

            <label class='visually-hidden' for="filter[period]">Period</label>
            <span class='col-sm-auto'>
                <select class='form-select' name='filter[period]'>
                    <option selected name='filter[period]' value="">Period</option>
                    <option name='filter[period]' value="1" <?= ($filter['period'] == '1') ? 'selected' : '' ?>>1</option>
                    <option name='filter[period]' value="2" <?= ($filter['period'] == '2') ? 'selected' : '' ?>>2</option>
                    <option name='filter[period]' value="3" <?= ($filter['period'] == '3') ? 'selected' : '' ?>>3</option>
                    <option name='filter[period]' value="4" <?= ($filter['period'] == '4') ? 'selected' : '' ?>>4</option>
                    <option name='filter[period]' value="5" <?= ($filter['period'] == '5') ? 'selected' : '' ?>>5</option>
                    <option name='filter[period]' value="6" <?= ($filter['period'] == '6') ? 'selected' : '' ?>>6</option>
                </select>
            </span>

            <label class='visually-hidden' for="filter[day]">Day</label>
            <span class='col-sm-auto'>
                <select name="filter[day]" class="form-select">
                    <option selected value="">Day</option>
                    <option value="monday" <?= ($filter['day'] == 'monday') ? 'selected' : '' ?>>Monday</option>
                    <option value="tuesday" <?= ($filter['day'] == 'tuesday') ? 'selected' : '' ?>>Tuesday</option>
                    <option value="wednesday" <?= ($filter['day'] == 'wednesday') ? 'selected' : '' ?>>Wednesday</option>
                    <option value="thursday" <?= ($filter['day'] == 'thursday') ? 'selected' : '' ?>>Thursday</option>
                    <option value="friday" <?= ($filter['day'] == 'friday') ? 'selected' : '' ?>>Friday</option>
                </select>
            </span>

            <label class='visually-hidden' for="filter[section]">Section</label>
            <span class='col-sm-auto'>
                <select name="filter[section]" class="form-select">
                    <option selected value="">Section</option>
                    <option value="a" <?= ($filter['section'] == 'a') ? 'selected' : '' ?>>A</option>
                    <option value="b" <?= ($filter['section'] == 'b') ? 'selected' : '' ?>>B</option>
                    <option value="c" <?= ($filter['section'] == 'c') ? 'selected' : '' ?>>C</option>
                    <option value="d" <?= ($filter['section'] == 'd') ? 'selected' : '' ?>>D</option>
                    <option value="e" <?= ($filter['section'] == 'e') ? 'selected' : '' ?>>E</option>
                    <option value="f" <?= ($filter['section'] == 'f') ? 'selected' : '' ?>>F</option>
                </select>
            </span>

            <label class='visually-hidden' for="filter[subjectCode]">subjectCode</label>
            <span class='col-sm-auto'>
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

        <!-- <div class="container-fluid p-4" style='background-color:#66ffb3;border-radius:20px;'> -->
        <div class="container-fluid p-4" style='background-color:lightgoldenrodyellow;border-radius:20px;'>
            <!-- <div class="container-fluid p-4"> -->
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
                            <input type="text" readonly class='form-control-plaintext dummy-form-title' value="Day">
                        </span>
                        <span class='col-sm-2'>
                            <input type="text" readonly class='form-control-plaintext dummy-form-title' value="Section">
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
                                <input type="number" name="schedule[roomNo]" id="" class='form-control' value=<?= $row->roomNo ?> required>
                            </span>
                            <span class='col-sm-2'>
                                <input type="number" name="schedule[period]" id="" class='form-control' value=<?= $row->period ?> required>
                            </span>
                            <span class='col-sm-2'>
                                <input type="text" name="schedule[day]" id="" class='form-control' value=<?= $row->day ?> required>
                            </span>
                            <span class='col-sm-2'>
                                <input type="text" name="schedule[section]" id="" class='form-control' value=<?= $row->section ?> required>
                            </span>
                            <span class='col-sm-2'>
                                <input type="text" name="schedule[subjectCode]" id="" class='form-control' value=<?= $row->subjectCode ?> required>
                            </span>
                            <span class='col-sm-2'>
                                <input type="submit" class='form-control btn btn-primary' style='border:0' value="Edit">
                            </span>
                        </form>
                    </span>

                    <span class='col-1'>
                        <form action="/UniCS/public/admin/deleteschedule" method="post">
                            <input type="hidden" name="id" value=<?= $row->id ?>>
                            <?= $postFilter ?>
                            <input class='btn btn-danger' type="submit" style='border:0' value="Delete">
                        </form>
                    </span>
                </div>


            <?php endforeach; ?>
        </div>


        <!-- <hr> -->
        <br>

        <form action="/UniCS/public/admin/addschedule" method="post" class='row g-2 justify-content-center'>
            <?= $postFilter ?>
            <span class='col-sm-2'>
                <input type="number" name="schedule[roomNo]" id="" class='form-control' placeholder='Room Number' value=<?= $filter['roomNo'] ?? '' ?> required>
            </span>
            <span class='col-sm-2'>
                <select class='form-select' name='schedule[period]' required>
                    <option selected disabled>Period</option>
                    <option name='filter[period]' value="1" <?= ($filter['period'] == '1') ? 'selected' : '' ?>>1</option>
                    <option name='filter[period]' value="2" <?= ($filter['period'] == '2') ? 'selected' : '' ?>>2</option>
                    <option name='filter[period]' value="3" <?= ($filter['period'] == '3') ? 'selected' : '' ?>>3</option>
                    <option name='filter[period]' value="4" <?= ($filter['period'] == '4') ? 'selected' : '' ?>>4</option>
                    <option name='filter[period]' value="5" <?= ($filter['period'] == '5') ? 'selected' : '' ?>>5</option>
                    <option name='filter[period]' value="6" <?= ($filter['period'] == '6') ? 'selected' : '' ?>>6</option>
                </select>
            </span>
            <span class='col-sm-2'>
                <select name="schedule[day]" class="form-select" required>
                    <option selected disabled>Day</option>
                    <option value="monday" <?= ($filter['day'] == 'monday') ? 'selected' : '' ?>>Monday</option>
                    <option value="tuesday" <?= ($filter['day'] == 'tuesday') ? 'selected' : '' ?>>Tuesday</option>
                    <option value="wednesday" <?= ($filter['day'] == 'wednesday') ? 'selected' : '' ?>>Wednesday</option>
                    <option value="thursday" <?= ($filter['day'] == 'thursday') ? 'selected' : '' ?>>Thursday</option>
                    <option value="friday" <?= ($filter['day'] == 'friday') ? 'selected' : '' ?>>Friday</option>
                </select>
            </span>
            <span class='col-sm-2'>
                <select name="schedule[section]" class="form-select" required>
                    <option selected disabled>Section</option>
                    <option value="a" <?= ($filter['section'] == 'a') ? 'selected' : '' ?>>A</option>
                    <option value="b" <?= ($filter['section'] == 'b') ? 'selected' : '' ?>>B</option>
                    <option value="c" <?= ($filter['section'] == 'c') ? 'selected' : '' ?>>C</option>
                    <option value="d" <?= ($filter['section'] == 'd') ? 'selected' : '' ?>>D</option>
                    <option value="e" <?= ($filter['section'] == 'e') ? 'selected' : '' ?>>E</option>
                    <option value="f" <?= ($filter['section'] == 'f') ? 'selected' : '' ?>>F</option>

                </select>
            </span>
            <span class='col-sm-2'>
                <input type="number" name="schedule[subjectCode]" id="" class='form-control' placeholder='Subject Code' value=<?= $filter['subjectCode'] ?? '' ?> required>
            </span>
            <span class='col-sm-auto'>
                <input class='btn btn-primary' type="submit" value="Add">
            </span>
            <span class='col-sm-auto'>
                <span class='unselectable' style='color:white'>filterdd</span>
            </span>
        </form>
    </div>

</div>