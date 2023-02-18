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
                    <option selected disabled>Period</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </span>

            <label class='visually-hidden' for="filter[day]">Day</label>
            <span class='col-sm-auto'>
                <!-- <input type="text" name="filter[day]" id="" class='form-control' placeholder='Day' value=<?= $filter['day'] ?? '' ?>> -->
                <select name="filter[day]" class="form-select">
                    <option selected disabled>Day</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                </select>
            </span>

            <label class='visually-hidden' for="filter[section]">Section</label>
            <span class='col-sm-auto'>
                <!-- <input type="text" name="filter[section]" id="" class='form-control' placeholder='Section' value=<?= $filter['section'] ?? '' ?>> -->
                <select name="filter[section]" class="form-select">
                    <option selected disabled>Section</option>
                    <option value="a">A</option>
                    <option value="b">B</option>
                    <option value="c">C</option>
                    <option value="d">D</option>
                    <option value="e">E</option>
                    <option value="e">F</option>
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