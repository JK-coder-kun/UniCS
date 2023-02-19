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

    <h4>Schedules</h4>
    <hr>

    <div class="container-fluid">
        <form action="/UniCS/public/searchschedule" method="get" class='row g-2 justify-content-center'>
            <label class='visually-hidden' for="filter[roomNo]">RoomNo</label>
            <span class='col-sm-auto'>
                <input type="number" name="filter[roomNo]" id="" class='form-control' placeholder='Room Number' value=<?= $filter['roomNo'] ?? '' ?>>
            </span>

            <label class='visually-hidden' for="filter[period]">Period</label>
            <span class='col-sm-auto'>
                <!-- <input type="number" name="filter[period]" id="" class='form-control' placeholder='Period' value=<?= $filter['period'] ?? '' ?>> -->
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
                <!-- <input type="text" name="filter[day]" id="" class='form-control' placeholder='Day' value=<?= $filter['day'] ?? '' ?>> -->
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
                <!-- <input type="text" name="filter[section]" id="" class='form-control' placeholder='Section' value=<?= $filter['section'] ?? '' ?>> -->
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
                <a class='btn btn-primary' href="/UniCS/public/searchschedule">All</a>
            </span>
        </form>


        <br>

        <table class='table table-hover table-light table-bordered' style='text-align:center;'>
            <thead>
                <tr class='table-dark'>
                    <th class='th-top-left-dark'>Room Number</th>
                    <th class='th-rl-light'>Period</th>
                    <th class='th-rl-light'>Day</th>
                    <th class='th-rl-light'>Section</th>
                    <th class='th-top-right-dark'>Subject Code</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                    <tr class='border-dark'>
                        <td><?= $row->roomNo ?></td>
                        <td><?= $row->period ?></td>
                        <td><?= ucfirst($row->day) ?></td>
                        <td><?= ucfirst($row->section) ?></td>
                        <td><?= $row->subjectCode ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>