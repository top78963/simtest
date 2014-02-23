<?php
$title = (isset($title)) ? $title : '';
$heading = (isset($heading)) ? $heading : $title;
?>
<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Refresh" content="<?php echo (isset($time)) ? $time : 0; ?>;URL=<?php echo (isset($url)) ? $url : site_url() ?>" />
        <title><?php echo $title; ?></title>
        <style type="text/css">

            ::selection{ background-color: #E13300; color: white; }
            ::moz-selection{ background-color: #E13300; color: white; }
            ::webkit-selection{ background-color: #E13300; color: white; }

            body {
                background-color: #fff;
                margin: 40px;
                font: 13px/20px normal Helvetica, Arial, sans-serif;
                color: #4F5155;
            }

            a {
                color: #003399;
                background-color: transparent;
                font-weight: normal;
            }

            h1 {
                color: #ffffff;
                background-color: #029FEB;
                border-bottom: 1px solid #D0D0D0;
                font-size: 19px;
                font-weight: bold;
                margin: 0 0 14px 0;
                padding: 14px 15px 10px 15px;
                text-align: center;
            }

            code {
                font-family: Consolas, Monaco, Courier New, Courier, monospace;
                font-size: 12px;
                background-color: #f9f9f9;
                border: 1px solid #D0D0D0;
                color: #002166;
                display: block;
                margin: 14px 0 14px 0;
                padding: 12px 10px 12px 10px;
            }

            #container {
                margin: 10px;
                border: 1px solid #D0D0D0;
                -webkit-box-shadow: 0 0 8px #D0D0D0;
                margin: 10px auto;
                max-width: 500px;
            }

            p {
                margin: 12px 15px 12px 15px;
                font-size: 16px;
            }
            span.error{
                color: red;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <h1><?php echo $heading; ?></h1>
            <p><?php echo (isset($message)) ? $message : ''; ?></p>
            <p><a href=" <?php echo (isset($url)) ? $url : ''; ?>">ข้ามหน้านี้</a></p>
        </div>
    </body>
</html>