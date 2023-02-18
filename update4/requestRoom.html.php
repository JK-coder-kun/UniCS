<!-- <?php echo "<pre>";
        print_r($roomSchedules);
        echo "</pre>"; ?> -->
<div class='mt-3 mb-3 p-3'>

    <?php
    $days = ['monday', "tuesday", "wednesday", "thursday", "friday"];
    $periods = ['0', '08:30-09:30', '09:40-10:40', '10:50-11:50', '12:40-01:40', '01:50-02:50', '03:00-04:00'];
    ?>

    <div class="container mb-5">
        <?php
        echo "<h3>Room: " . $roomNo . "</h3><br>";
        ?>
        <table class='table table-hover table-light table-bordered border-dark' style='text-align:center;'>
            <thead>
                <tr>
                    <th></th>
                    <?php
                    foreach ($periods as $p) {
                        if ($p == '0') continue;
                        echo "<th>" . $p . "</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($error)) echo "<p style=\"color:'red';\">" . $error . "</p></br>";

                foreach ($roomSchedules as $key => $values) {

                    echo "<tr>";
                    echo "<th>" . ucfirst($key) . "</th>";

                    $pArr = array();
                    $infoArr = array();
                    foreach ($values as $v) {
                        array_push($pArr, $v['period']);
                        $v['section'] ? array_push($infoArr, ($v['subjectCode'] . '(' . $v['section'] . ')')) : array_push($infoArr, ($v['reason']));
                    }
                    // print_r($infoArr);
                    // print_r($pArr);
                    // spend a shit ton of time to get this working
                    for ($p = 1; $p < count($periods); $p++) {
                        if (in_array($p, $pArr)) {
                            echo '<td>' . array_shift($infoArr) . '</td>';
                            //     echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            //     <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            //   </svg></td>';
                        } else echo "<td></td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class='container' style="display:<?= ($user->permissions >= 1) ? '' : 'none;' ?>">
        <form action="request" method="post">
            <fieldset>
                <legend>Request Room</legend>
                <input type="hidden" name="request[roomNo]" value=<?= $roomNo ?>>
                <div class="row mb-2">
                    <label class='col-1 col-form-label' for="request[period]">Period</label>
                    <span class="col-auto">
                        <!-- <input class='form-control' type="number" name="request[period]" id="request" value=<?= $period ?> require> -->
                        <select class='form-select' name='request[period]'>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                    </span>
                </div>
                <div class="row mb-2">
                    <label class='col-1 col-form-label' for="request[day]">Day</label>
                    <span class="col-auto">
                        <!-- <input class='form-control' type="text" name="request[day]" id="request" value="<?= $day ?>" require> -->
                        <select class='form-select' name="request[day]">
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                        </select>
                    </span>

                </div>
                <div class="row mb-3">
                    <label class='col-1 col-form-label' for="request[reason]">Reason</label>
                    <span class="col-auto">
                        <select class="form-select" name="request[reason]">
                            <?php foreach ($priority as $reason) : ?>
                                <option value="<?= $reason->reason ?>"><?= ucfirst($reason->reason) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </span>

                </div>
                <div class="row mb-2">
                    <span class='col-auto'>
                        <input class='btn btn-primary' type="submit" value="Send Request">
                    </span>
                </div>

            </fieldset>

        </form>
    </div>


</div>