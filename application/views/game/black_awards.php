<div class="black_awards"><span class="coin"></span><span style="width: 250px;"> <?php echo number_format($score); ?></span> </div>
<style>
    .black_awards{
        font-size: 30px;
        color: #FBD65C;
        text-shadow: 2px 2px #BE7F27;
    }
    .coin{
        background-image: url("<?php echo base_url('files/images/dollar_coin.png'); ?>");
        background-size: 50px 50px;
        width: 60px;
        height: 60px;
        background-repeat: no-repeat;
        display: block;
        float: left;
    }
</style>