<div class="row" style="margin-bottom: 15px;">

    <div class="col-md-2">
        <img style="height: 150px;"src="<?php echo base_url('files/images/simtest_av.png'); ?>" alt="รูปตัวแทน" class="img-thumbnail">
    </div>
    <div class="col-md-8">
        <textarea  class="form-control"  style="width: 100%; height: 150px;" readonly><?php echo $command; ?></textarea> 
    </div>
    <div class="col-md-2">

        <a class="btn btn-primary btn-lg" style="width: 100%;margin-top: 50px;" href="http://th.lipsum.com/"> <span class="glyphicon glyphicon-chevron-right"></span> Next Question</a>
    </div>

</div>
<div class="row ">
    <div class="col-md-8 ">
        <div class="row highlight">
            <label>Requirements</label>
            <div class="bg-info">
                <?php echo $requirement; ?>
            </div>
        </div>
        <div class="row highlight">
            <div class="col-md-6">
                <p>
                    <label for="b_tc">Test case Input</label>
                    <input class="form-control" type="text"  name="b_tc" id="b_tc" autocomplete="">
                </p>
            </div>
            <div class="col-md-6">
                <p>
                    <label for="b_exp">Expected Output</label>
                    <?php echo form_dropdown('b_exp', $exp_options, '', 'class="form-control" id="b_exp"') ?>
                </p>
            </div>
            <div class="col-md-12">
                <p>
                    <input class="btn btn-primary btn-lg" type="button" name="" value="Test execution" id="b_sent_test_btn">
                    
                </p>
            </div>
        </div>
        <div id="b_result" class="row highlight" style="height: 100px;">
            *** Test results ***
        </div>
        <div id="b_feedback" class="row highlight" style="height: 100px;">
            *** Feedback ***
        </div>

    </div>
    <div class="col-md-4">


        <div id="b_log" class="col-md-12 highlight" style="height: 360px;">
            Log
        </div>
        <div id="b_awards" class="col-md-12 highlight">
            <?php echo $score; ?>
        </div>
    </div>
</div>
<script>
    var allow_next = false;


    function sent_test() {
        var data = 'b_exp=' + $("#b_exp").val();
        data = data + '&b_tc=' + $("#b_tc").val();
        data = data + '&quest_id=' + quest_id;
        console.log(data);
        $.ajax({
            type: "POST",
            url: sent_test_url,
            data: data,
            dataType: "json"
        }).done(function(json) {
            $("#b_result").html(json.result);
            $("#b_feedback").html(json.feedback);
            //$("#b_log").html(json.log);
            $("#b_awards").html(json.awards);

        });
    }
    $(function() {
        $('#b_tc').val('');
        $("#b_next_btn").click(function() {
            if (!allow_next) {
                alert("not allow");
                return false;
            }
            return true;
        });
        $("#b_sent_test_btn").click(function() {
           
            sent_test();
        });

    });
</script>



















