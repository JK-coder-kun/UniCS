<div class='mt-3 mb-3 p-3'>


    <!-- <div class='container' style='width:50%'>
        <table class='table table-primary table-hover' style='text-align:center'>
            <tr>
                <th>Day</th>
                <th>Period</th>
            </tr>
            <?php
            if (isset($error)) echo "<p color='red'>" . $error . "</p></br>";
            $periods = ['0', '08:30-09:30', '09:40-10:40', '10:50-11:50', '12:40-01:40', '01:50-02:50', '03:00-04:00'];
            foreach ($roomSchedules as $key => $values) {
                sort($roomSchedules[$key]);
                foreach ($values as $value) {
                    echo "<tr>";
                    echo "<td>" . $key . "</td>";
                    echo "<td>" . $periods[$value['period']] . "</td>";
                    echo "</tr>";
                }
                // echo "</br>";
            }
            ?>
        </table>
    </div> -->

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
                if (isset($error)) echo "<p color='red'>" . $error . "</p></br>";

                foreach ($roomSchedules as $key => $values) {

                    echo "<tr>";
                    echo "<th>" . ucfirst($key) . "</th>";

                    $pArr = array();
                    foreach ($values as $v) {
                        array_push($pArr, $v[0]);
                    }
                    // print_r($pArr);
                    // spend a shit ton of time to get this working
                    for ($p = 1; $p < count($periods); $p++) {
                        if (in_array($p, $pArr)) {
                            echo '<td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                          </svg></td>';
                        } else echo "<td></td>";
                    }

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class='container'>
        <form action="request" method="post">
            <fieldset>
                <legend>Request Room</legend>
                <input type="hidden" name="request[roomNo]" value=<?= $roomNo ?>>
                <div class="row mb-2">
                    <label class='col-1 col-form-label' for="request[period]">Period</label>
                    <span class="col-auto">
                        <input class='form-control' type="number" name="request[period]" id="request" value=<?= $period ?> require>
                    </span>
                </div>
                <div class="row mb-2">
                    <label class='col-1 col-form-label' for="request[day]">Day</label>
                    <span class="col-auto">
                        <input class='form-control' type="text" name="request[day]" id="request" value="<?= $day ?>" require>
                    </span>

                </div>
                <!-- <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select> -->
                <div class="row mb-3">
                    <label class='col-1 col-form-label' for="request[reason]">Reason</label>
                    <span class="col-auto">
                        <select class="form-select">
                            <option selected>Choose Reason</option>
                            <option value="lecture">Lecture</option>
                            <option value="seminar">Seminar</option>
                            <option value="club activity">Club Activity</option>
                        </select>
                    </span>
                    <!-- Lecture:<input type="radio" name="request[reason]" id="request" value="lecture">
                    Seminer:<input type="radio" name="request[reason]" id="request" value="seminer">
                    Club activity<input type="radio" name="request[reason]" id="request" value="club activity"> -->
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