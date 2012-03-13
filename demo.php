<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta charset="utf-8">
        <title>Desktop/Mobile detection page</title>        
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <style type="text/css">
            html {
                font-size: 100%;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }   
            body {
                margin: 0;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 13px;
                line-height: 18px;
                color: #333333;
                background-color: #ffffff;
            }
            a {
                color: #0088cc;
                text-decoration: underline;
            }
            a:hover {
                color: #005580;
                text-decoration: underline;
            }  
            .mobile { background-color:green; color:white; }
            .desktop { background-color:blue; color:white; } 
        </style>
    </head>
    <body>
        <section>
            <header>
                <h1>Mobile_Detect</h1>
                <p>Test to check the mobile detection feature.</p>
            </header>
            <?php
                require_once 'Mobile_Detect.php';
                $detect = new Mobile_Detect();
                $layout = ($detect->isMobile() ? 'mobile' : 'desktop');
            ?>            
            <p class="<?php echo $layout; ?>">This is <b><?php echo $layout; ?></b>. Your UA is <b><?php echo htmlentities($_SERVER['HTTP_USER_AGENT']); ?></b></p>
            
        </section>
        
        <footer>
            <p>Copyright &copy; <?php echo date('Y'); ?></p>
        </footer>
    </body>
</html>