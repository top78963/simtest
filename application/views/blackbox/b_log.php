<table border="1" class="data">
    <thead>
        <tr>
            <th>No.</th>
            <th>Test Case</th>
            <th>Expected Output</th>
            <th>Actual Result</th>
            <th>Status</th>
            <th>Bonus</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total = count($result);
        foreach ($result as $k=>$v) { ?>
            <tr>
                <td><?php echo $total-$k;  ?></td>
                <td><?php echo $v['test_case'] ?></td>
                <td><?php echo $v['Expected'] ?></td>
                <td><?php echo $v['actual_result'] ?></td>
                <td><?php echo $v['Status_result'] ?></td>
                <td><?php echo $v['Comments_result'] ?></td>
            </tr>


        <?php } ?>
    </tbody>
</table>
