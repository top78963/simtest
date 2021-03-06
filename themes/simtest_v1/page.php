<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

        <title>Signin Template for Bootstrap</title>

        <!-- Bootstrap core CSS -->

        <link rel="stylesheet" href="<?php echo $template_url . 'css/bootstrap.min.css'; ?>" />
        <link rel="stylesheet" href="<?php echo $template_url . 'css/master.css'; ?>" />
        <script>
            function site_url(uri) {
                uri = (uri == undefined) ? '' : uri;
                return '<?php echo site_url() ?>' + uri;
            }
            function base_url(uri) {
                uri = (uri == undefined) ? '' : uri;
                return '<?php echo base_url() ?>' + uri;
            }
        </script>
        <?php echo $script; ?>
        <?php echo $link; ?>

        <!-- Custom styles for this template -->


        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <div class="navbar navbar-inverse " role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url(); ?>">Simtest</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo site_url(); ?>">Home</a></li>
                        <li><a href="<?php echo site_url('page/about_game'); ?>">About Game</a></li>


                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if ($is_login) { ?>
                            <li class="active"><a>Hello <?php echo $display_name; ?></a></li>
                            <li><a href="<?php echo site_url('user/logout'); ?>">Logout</a></li>
                        <?php } else { ?>
                            <li class="active"><a>..</a></li>
                        <?php } ?>
                    </ul>
                </div>

            </div>
        </div>
        <div class="container">

            <?php echo $content; ?>
        </div> 
    </body>
</html>
