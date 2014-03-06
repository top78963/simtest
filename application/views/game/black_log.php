<table style="font-size: 12px;padding: 2px;" class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Input</th>
            <th>Expected Output</th>
            <th>Actual Result</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody >
        <?php
        $total = count($logs);
        //$logs = array_reverse($logs);
        for ($i = count($logs) - 1; $i >= 0; $i--) {
            ?>
            <tr>
                <td><?php echo ($i + 1); ?></td>
                <td><?php echo @$logs[$i]['input'] ?></td>
                <td><?php echo $logs[$i]['expected_text'] ?></td>
                <td><?php echo $logs[$i]['actual_text'] ?></td>
                <td><?php echo $logs[$i]['message'] ?></td>

            </tr>


        <?php } ?>
    </tbody>
</table>
