<div id="game_wrapper">
    <div id="bg_title" class="clearfix"> 
        <div id="b_logo" >Lv.1
        </div>
        <div id="b_username" >Name...Points...
        </div>
    </div>
    <div id="bg_command"class="clearfix"> 
        <div id="b_avatar">
            <img src="<?php echo base_url('files/images/simtest_av.png'); ?>"/>
        </div>

        <a id="b_next_btn" href="http://th.lipsum.com/">Next</a>

        <div id="b_command"> 
            <textarea readonly><?php echo $command; ?></textarea>
        </div>

    </div>

    <div class="clearfix"> 
        <div id="b_left"> 
            <div id="b_requirement"> 
                <label>Requirements</label>
                <?php echo $requirement; ?>
            </div>
            <div > 
                <div id="input_area">
                    <label>Test case Input</label>
                    <input type="text"  name="b_tc" id="b_tc">
                    <label>Expected Output</label>
                    <?php echo form_dropdown('b_exp', $exp_options, '', 'id="b_exp"') ?>
                  
                </div>
                <div id="input_exe_btn" class="center_wrapper">
                    <input type="button" name="" value="Test execution" id="b_sent_test_btn">
                </div>

            </div>
            <div id="b_result"> 
                Test results
            </div>
            <div id="b_feedback"> 
                Feedback
            </div>
        </div>

        <div id="b_right"> 
            <div id="b_log">
                b_log
            </div>
            <div id="b_awards"> 
                b_awards
            </div>
        </div>
    </div>
</div>
<!--______________________________CSS____________________________-->
<style>
    #game_wrapper{

    }
    /*----------กรอบLayout---------*/
    #game_wrapper div{
        /*        border:  #FFF 1px solid;*/
    }
    #bg_title{
/*        background-color: #B8C4CF;*/
    }
    /*----------ส่วนบนซ้าย---------*/
    #b_logo{
        width: 50px;
        height: 30px;
        float: left;

    }
    /*----------ส่วนบนขวา---------*/
    #b_username{
        width: 100px;
        height: 30px;
        float: right;
    }
    /*----------ส่วนรูปอวต้า---------*/
    #b_avatar{
        
        width: 100px;
        height: 100px;
        float: left;
    }
    #b_avatar img{
        width: 100px;
        height: 100px;

    }
    /* --------ส่วนกรอบคำสั่ง---------*/
    #b_command {
        width: 770px;
        float: right;
        margin-top: 10px;
        margin-right: 10px;
    }
    #b_command textarea{
        width: 740px;
        height: 70px;
        resize: none;
        font-size: 18px;
        color: #000066;
    }
    #b_next_btn{
        width: 35px;
        float: right;
        margin-top: 20px;
        margin-right: 10px;
    }
    #bg_command{
        background-color: #B8C4CF;
        /*        background-image: url("<?php echo site_url('files/images/bg_sgreen.jpg'); ?>")*/
    }

    #b_next_btn {
        -moz-box-shadow:inset 0px 1px 0px 0px #9acc85;
        -webkit-box-shadow:inset 0px 1px 0px 0px #9acc85;
        box-shadow:inset 0px 1px 0px 0px #9acc85;
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #74ad5a), color-stop(1, #68a54b));
        background:-moz-linear-gradient(top, #74ad5a 5%, #68a54b 100%);
        background:-webkit-linear-gradient(top, #74ad5a 5%, #68a54b 100%);
        background:-o-linear-gradient(top, #74ad5a 5%, #68a54b 100%);
        background:-ms-linear-gradient(top, #74ad5a 5%, #68a54b 100%);
        background:linear-gradient(to bottom, #74ad5a 5%, #68a54b 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#74ad5a', endColorstr='#68a54b',GradientType=0);
        background-color:#74ad5a;
        border:1px solid #3b6e22;
        display:inline-block;
        cursor:pointer;
        color:#ffffff;
        font-family:arial;
        font-size:13px;
        font-weight:bold;
        padding:6px 12px;
        text-decoration:none;
    }
    #b_next_btn:hover {
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #68a54b), color-stop(1, #74ad5a));
        background:-moz-linear-gradient(top, #68a54b 5%, #74ad5a 100%);
        background:-webkit-linear-gradient(top, #68a54b 5%, #74ad5a 100%);
        background:-o-linear-gradient(top, #68a54b 5%, #74ad5a 100%);
        background:-ms-linear-gradient(top, #68a54b 5%, #74ad5a 100%);
        background:linear-gradient(to bottom, #68a54b 5%, #74ad5a 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#68a54b', endColorstr='#74ad5a',GradientType=0);
        background-color:#68a54b;
    }
    #b_next_btn:active {
        position:relative;
        top:1px;
    }
    /*-------ขนาดกรอบRequirement------------*/
    #b_requirement{
     
        height: 120px;
    }
    #b_requirement label{

        font-weight: bold;
        /*                font-style: italic;*/
        width: 2000px;
        margin-left: 10px;
    }
    #b_requirement li{
        list-style: circle;
    }

    /*-------ห้ามปรับ ส่วนขนาดกรอบซ้ายมือ-------*/
    #b_left{
        width: 550px;
        float: left;
    }

    /*------ห้ามปรับ ส่วนขนาดกรอบขวามือ--------*/
    #b_right{
        width: 390px;
        float: right;
    }

    .center_wrapper{
        text-align: center;
        width: 100%;
    }
    .right_wrapper{
        text-align: right;
        width: 100%;
    }
    
    /* ----------รูปแบบข้อความ Input-expected------------*/
    #input_area label{
        font-weight: bold;
        /*                font-style: italic;*/
        width: 2000px;
        margin-left: 10px;
    }
    #input_area input,#input_area select{

        width: 120px;
        margin-left: 10px;
        border: solid 2px #000066;
    }

    #input_area{
        background-color: #B8C4CF;
        height: 30px;
        padding-top: 10px;
    }
    /*ขนาดปุ่ม TestExecute*/
    #input_exe_btn{
        background-color: #B8C4CF;
        height: 40px;
        padding-bottom: 5px;
        
    }
    #b_sent_test_btn{
        width: 350px;
        height: 35px;
    } 
    /* ----------ส่วนResult------------*/
    #b_result{
/*        background-color: #ff9;*/
        height: 70px;
    }
    /* ----------ส่วนfeedback------------*/
    #b_feedback{
        
        height: 130px;

    }
    #b_feedback img{
        width: 130px;
        height: 130px;
    }
    #b_log{
        border:  #FFF 2px solid;
        height: 130px;

    }
    #b_awards{
        border:  #FFF 2px solid;
        height: 130px;

    }
    /* ----------เปลี่ยนสีBackgrounf bodyนอก------------*/
    body{
        /*        background-image: url("<?php echo site_url('files/images/background.jpg'); ?>")*/
    }


</style>
<script>
    var allow_next = false;
    var sent_test_url = '<?php echo $sent_test_url; ?>';

    function sent_test() {
        var data = 'b_exp=' + $("#b_exp").val();
        data = data + '&b_tc=' + $("#b_tc").val();
        console.log(data);
        $.ajax({
            type: "POST",
            url: sent_test_url,
            data: data,
            dataType: "json"
        }).done(function(json) {
            $("#b_result").html(json.result);
            $("#b_feedback").html(json.feedback);
            $("#b_log").html(json.log);
            $("#b_awards").html(json.awards);

        });
    }
    $(function() {
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