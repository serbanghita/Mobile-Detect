<?php
/**
 * Mobile Detect Demo Page
 * $Id$
 * 
 */
date_default_timezone_set('Europe/Bucharest');
// Enable all errors for debugging purposes.
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

/**
 * Generic write to file function.
 * 
 * @param string $file
 * @param string $content 
 */
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
/**
 * Get all HTTP headers plus visitor IP and
 * the date of the HTTP request.
 * 
 * @return array 
 */
function getHttpHeaders() { 
    
    $out = array();
    
    foreach($_SERVER as $key=>$value) { 
	if (substr($key,0,5)=="HTTP_" || in_array($key, array('REMOTE_ADDR', 'REQUEST_TIME'))) {  
		$out[$key]=($key=='REQUEST_TIME' ? date('d-m-Y H:i', $value) : $value); 
	} 
    } 
    
    return $out; 
    
} 
 
// Debug.
writeToFile('ua.txt', print_r(getHttpHeaders(),true));

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <meta charset="utf-8">
        <title>Desktop/Mobile detection page</title>        
        <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
        <style type="text/css">
            html {
                font-size: 100%;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
            }   
            body {
                margin: 0;
		padding: 0 1em;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                font-size: 100%;
                line-height: 1.2em;
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
                <h1><a href="http://code.google.com/p/php-mobile-detect/">Mobile_Detect</a></h1>
                <p>Test to check the mobile detection feature.</p>
		<p>Please report any bugs to the <a href="http://code.google.com/p/php-mobile-detect/issues/list">issue list</a> specifying the user agent below.</p>
            </header>
            <?php
		// Check for mobile device.
                require_once 'Mobile_Detect.php';
                $detect = new Mobile_Detect();
                $layout = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'mobile') : 'desktop');
            ?>            
            <p class="<?php echo $layout; ?>">This is <b><?php echo $layout; ?></b>. Your UA is <b><?php echo htmlentities($_SERVER['HTTP_USER_AGENT']); ?></b></p>
       </section>
	   
	   <section>
		   <header>
			   <h1>Supported methods tests</h1>
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
            </table>
       </section>  
	
	<section>
	    <header>
		<h1>Other tests</h1>
	    </header>
	    
	    <table>
		<tr>
			<td>isiphone()</td>
			<td><?php echo var_dump($detect->isiphone()); ?></td>
		</tr>		
		<tr>
			<td>isIphone()</td>
			<td><?php echo var_dump($detect->isIphone()); ?></td>
		</tr>  
		<tr>
			<td>istablet()</td>
			<td><?php echo var_dump($detect->istablet()); ?></td>
		</tr>
		<tr>
			<td>isIOS()</td>
			<td><?php echo var_dump($detect->isIOS()); ?></td>
		</tr>		
		<tr>
			<td>isWhateverYouWant()</td>
			<td class="randomcrap"><?php echo var_dump($detect->isWhateverYouWant()); ?></td>
		</tr>		
	    </table>
	    
	</section>
        
        
        <footer>
            <p>Copyright &copy; <?php echo date('Y'); ?></p>
        </footer>
    </body>
</html>