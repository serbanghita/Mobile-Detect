<?php
/**
 * Mobile Detect Demo Page
 * $Id$
 * 
 */
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

function writeToFile($file, $content){
  
    if (!$handle = fopen($file, 'a')) {
            echo "Cannot open file ($file)";
            exit;
    }

    if (fwrite($handle, $content) === FALSE) {
            echo "Cannot write to file ($file)";
            exit;
    }

    fclose($handle);

}
if (!function_exists('apache_request_headers')) { 

        function apache_request_headers() { 
            foreach($_SERVER as $key=>$value) { 
                if (substr($key,0,5)=="HTTP_") { 
                    //$key=str_replace(" ","-",ucwords(strtolower(str_replace("_"," ",substr($key,5))))); 
					$out[$key]=$value; 
                } 
            } 
            return $out; 
        } 
 
} 

writeToFile('ua.txt', print_r(apache_request_headers(),true));

?><!DOCTYPE html>
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
            .desktop { background-color:blue; color:white; } 
            .tablet { background-color:yellow; color:black; }
            .mobile,.true { background-color:green; color:white; }
            .randomcrap { background:#eee; color:#666; }
            
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
                $layout = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
            ?>            
            <p class="<?php echo $layout; ?>">This is <b><?php echo $layout; ?></b>. Your UA is <b><?php echo htmlentities($_SERVER['HTTP_USER_AGENT']); ?></b></p>
       </section>
	   
	   <section>
		   <header>
			   <h1>Tests</h1>
		   </header>
            <table>
                <?php foreach($detect->getRules() as $name => $regex):
                                $check = $detect->{'is'.$name}();
                ?>
                    <tr>
                            <td>is<?php echo $name; ?>()</td>
                            <td <?php if($check): ?>class="true"<?php endif; ?>><?php echo var_dump($check); ?></td>
                    </tr>
                <?php endforeach; ?>
                    <tr>
                        <td colspan="2"><hr></td>
                    </tr>
                    <tr>
                            <td>isRandomCrap()</td>
                            <td class="randomcrap"><?php echo var_dump($detect->isRandomCrap()); ?></td>
                    </tr> 
                    <tr>
                            <td>isIphone()</td>
                            <td><?php echo var_dump($detect->isIphone()); ?></td>
                    </tr>  
                    <tr>
                            <td>istablet()</td>
                            <td><?php echo var_dump($detect->istablet()); ?></td>
                    </tr>                  
            </table>
       </section>     
        
        
        <footer>
            <p>Copyright &copy; <?php echo date('Y'); ?></p>
        </footer>
    </body>
</html>