<?php
/**
 * MIT License
 * ===========
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * -----------------------------------------------------------------------
 * The demo is running all the Mobile_Detect's internal methods.
 * Here you can spot detections errors instantly.
 * -----------------------------------------------------------------------
 *
 * @author      Serban Ghita <serbanghita@gmail.com>
 * @license     MIT License https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt
 *
 */

require_once '../Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <title>Mobile Detect Local Demo</title>
    <style type="text/css">
        html { font-size: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        body { margin: 0; padding: 0 1em; font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; font-size: 1em; color: #333333; background-color: #ffffff; max-width:320px; }
        body, td { font-size: 1em; }
        table th { text-align:left; }
        a { color: #0088cc; text-decoration: underline; }
        a:hover { color: #005580; text-decoration: underline; }
        header h1 small { font-size:small; }
        section { margin-bottom:2em; }
        section h1 { font-size:100%; }
        .infoText { font-size:85%; }
        .response { color:red; }
        .computer { background-color:blue; color:white; }
        .tablet { background-color:yellow; color:black; }
        .phone, .true { background-color:green; color:white; }
        .sendDataButton { border-radius: 1em; -moz-border-radius: 1em; -webkit-border-radius: 1em; padding:0.5em 1em; cursor: pointer; }
        .sendDataButton_yes {
                color:white;
                border: 1px solid #56A00E;
                background: #74B042;
                font-weight: bold;
                color: #ffffff;
                text-shadow: 0 1px 0 #335413;
                background-image: -webkit-gradient(linear, left top, left bottom, from( #74B042 ), to( #56A00E )); /* Saf4+, Chrome */
                background-image: -webkit-linear-gradient( #74B042 , #56A00E ); /* Chrome 10+, Saf5.1+ */
                background-image:    -moz-linear-gradient( #74B042 , #56A00E ); /* FF3.6 */
                background-image:     -ms-linear-gradient( #74B042 , #56A00E ); /* IE10 */
                background-image:      -o-linear-gradient( #74B042 , #56A00E ); /* Opera 11.10+ */
                background-image:         linear-gradient( #74B042 , #56A00E );
        }
        .sendDataButton_no {
                color:white;
                border: 1px solid #cd2c24;
                background: red;
                font-weight: bold;
                color: #ffffff;
                text-shadow: 0 1px 0 #444444;
                background-image: -webkit-gradient(linear, left top, left bottom, from( #e13027 ), to( #b82720 )); /* Saf4+, Chrome */
                background-image: -webkit-linear-gradient( #e13027 , #b82720 ); /* Chrome 10+, Saf5.1+ */
                background-image:    -moz-linear-gradient( #e13027 , #b82720 ); /* FF3.6 */
                background-image:     -ms-linear-gradient( #e13027 , #b82720 ); /* IE10 */
                background-image:      -o-linear-gradient( #e13027 , #b82720 ); /* Opera 11.10+ */
                background-image:         linear-gradient( #e13027 , #b82720 );
        }
        #feedbackForm fieldset { border:1px dotted #333; }
        #feedbackForm label { font-weight:bold; font-size:85%; }
        #feedbackForm textarea { width: 260px; }
    </style>
    <script src="//code.jquery.com/jquery-1.7.1.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('.sendDataButton').bind('click.demo', function(e){

                $button = $(this);
                e.preventDefault();

                $.ajax({
                    url: 'http://demo.mobiledetect.net/?page=addItem',
                    type: 'POST',
                    dataType: 'jsonp',
                    data: {
                            remoteDetails:  $('#remoteDetails').val(),
                            remoteAnswer:   $(this).attr('data-answer'),
                            uaStringFromJS: escape(navigator.userAgent),
                            deviceWidth:    $(window).width(),
                            deviceHeight:   $(window).height(),
                            source:         'demoFeedback'
                    },
                    beforeSend: function(){
                        $button.html('Loading...');
                    },
                    success: function(r){
                        $('#feedbackForm').html('<p class="response">'+r.msg+'</p>');
                    }
                });

            });

            $.ajax({
                url: 'http://demo.mobiledetect.net/?page=addItem',
                type: 'POST',
                dataType: 'jsonp',
                data: {
                        //uaStringFromJS: escape(navigator.userAgent),
                        deviceWidth:    $(window).width(),
                        deviceHeight:   $(window).height(),
                        devicePixelRatio: (typeof window.devicePixelRatio !== 'undefined' ? window.devicePixelRatio : 0),
                        'source':         'demoVisitor'
                },
                success: function(r){
                    try { console.log(r); } catch (e) { }
                }
            });


        });
    </script>


</head>
<body>

<header>
<h1><a href="https://github.com/serbanghita/Mobile-Detect">Mobile_Detect</a> <small>v. <?php echo $scriptVersion; ?></small></h1>
<p class="infoText">The lightweight PHP class for detecting mobile devices.</p>
</header>

<!-- copy to GitHub with a couple of changes -->
<section>

    <p>This is a <b><?php echo $deviceType; ?></b>. Your UA is <b class="<?php echo $deviceType; ?>"><?php echo htmlentities($_SERVER['HTTP_USER_AGENT']); ?></b></p>

    <p class="infoText">Please help us improve the mobile detection by choosing the correct answer.<br>
    Before sending an answer double check if you are using the browser in 'Desktop mode'.<br>
    You can contribute by:<br>
     1. <a href="https://github.com/serbanghita/Mobile-Detect">forking</a> the project<br>
     2. <a href="https://github.com/serbanghita/Mobile-Detect/issues/new?body=Please%20specify%20the%20User-Agent.%20Go%20to%20http://is.gd/mobiletest%20and%20copy-paste%20it%20here.">submiting an issue</a><br>
     3. sending us feedback below
    </p>

    <form id="feedbackForm">
         <fieldset>
            <legend>Contribute</legend>

            <h1>Is your device really a <?php echo $deviceType; ?>?</h1>

            <p>
            <label for="remoteDetails">Additional feedback:</label><br>
            <textarea name="remoteDetails" id="remoteDetails"></textarea>
            </p>
            <button class="sendDataButton sendDataButton_yes" data-answer="yes">♥ Yes, it's correct.</button> <button class="sendDataButton sendDataButton_no" data-answer="no">No, it's wrong!</button>
        </fieldset>
    </form>

</section>


<!-- copy to GitHub demo.php -->
<section>
    <h1>Supported methods</h1>
    <table cellspacing="0" cellpadding="0">
        <tbody>
        <tr>
            <th colspan="2">Basic detection methods</th>
        </tr>
        <tr>
            <td>isMobile()</td><td <?php $check = $detect->isMobile(); if($check): ?>class="true"<?php endif; ?>><?php var_dump($check); ?></td>
        </tr>
        <tr>
            <td>isTablet()</td><td <?php $check = $detect->isTablet(); if($check): ?>class="true"<?php endif; ?>><?php var_dump($check); ?></td>
        </tr>
        </tbody>
        <tbody>
        <tr>
            <th colspan="2">Custom detection methods</th>
        </tr>
        <?php foreach($detect->getRules() as $name => $regex):
                        $check = $detect->{'is'.$name}();
        ?>
            <tr>
                    <td>is<?php echo $name; ?>()</td>
                    <td <?php if($check): ?>class="true"<?php endif; ?>><?php var_dump($check); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tbody>
            <tr>
                <th colspan="2">Experimental version() method</th>
            </tr>
            <?php
            foreach($detect->getProperties() as $name => $match):
                $check = $detect->version($name);
                if($check!==false):
            ?>
            <tr>
                <td>version(<?php echo $name; ?>)</td>
                <td><?php var_dump($check); ?></td>
            </tr>
            <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
        <tbody>
            <tr>
                <th colspan="2">Other tests</th>
            </tr>
            <tr>
                <td>isiphone()</td>
                <td><?php var_dump($detect->isiphone()); ?></td>
            </tr>
            <tr>
                <td>isIphone()</td>
                <td><?php var_dump($detect->isIphone()); ?></td>
            </tr>
            <tr>
                <td>istablet()</td>
                <td><?php var_dump($detect->istablet()); ?></td>
            </tr>
            <tr>
                <td>isIOS()</td>
                <td><?php var_dump($detect->isIOS()); ?></td>
            </tr>
            <tr>
                <td>isWhateverYouWant()</td>
                <td class="randomcrap"><?php var_dump($detect->isWhateverYouWant()); ?></td>
            </tr>
        </tbody>
    </table>

</section>

</body>
</html>
