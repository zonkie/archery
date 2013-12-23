<?php
@require_once('config/__conf.inc');

?>
<html><head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
String.prototype.format = function()
{
   var content = this;
   for (var i=0; i < arguments.length; i++)
   {
        var replacement = '{' + i + '}';
        content = content.replace(replacement, arguments[i]); 
   }
   return content;
};

var statsString = "{0}:<br /> arrows:{1} points:{2}<br />";

jQuery(document).ready(function(){
    jQuery('.ring').click(function(){
        jQuery('.ring').unbind('click');
        ring(this);
    });
    getStats();
});

var ring = function(event){
    jQuery.post('<?=$baselink?>savehit.php', {hit: jQuery(event).attr('data-points') }, function(data){
        console.log(data);
        jQuery('#success').text(data.result);
        jQuery('#success').fadeIn(900, function(){jQuery('#success').fadeOut('slow', function(){
            jQuery('.ring').click(function(){
                jQuery('.ring').unbind('click');
                ring(this);
            });

        })});
        getStats();
    }, 'JSON');

}

var getStats = function() {
    jQuery.get('<?=$baselink?>stats.php', function (event,data){
        jQuery('#stats').text('');
        jQuery.each(event,function(date,stats){
            console.log("stats");
            console.log(stats);
		console.log("date");
		console.log(date);
            jQuery('#stats').append(statsString.format(date,stats.arrows, stats.points));
        });
    }, 'JSON');
}
</script>

<style>
*{
    width: 100%;
    height: 100%;
}

body {
    background-color: #EEEEEE;
    font-family: arial, verdana, helvetica;
    font-size: 1em;
    color: #666666;
    width: 100%;
    height: 100%;
    position: relative;
}

#success {
    position: fixed;
    top: 0px;
    left: 0px;
    height: 5%;
    background: #FFFFFF;
    display:none;
    margin: auto;
    text-align: center;
    color: #444444;
    opacity: 0.8;
    border: 1px solid #444444;
   
}
#stats{
    background: none repeat scroll 0 0 #FFFFFF;
    bottom: 0;
    color: #000000;
    font-size: 0.8em;
    height: 200px;
    left: 10px;
    position: absolute;
    width: 150px;
    opacity: 0.8;
    border: 1px solid #444444;
}
.ring {
    width: 100%;
    height: 8%;
    clear: both;
    float:left;
    border: none;
    border-top: 1px dotted #111111;
    margin: auto;
    text-align: center;
}

.ring.points_-1{
   background-image:url('<?=$baselink?>src/img/wall.jpg');
   color: #000000;
}
.ring.points_0 {
    background-color: #cccccc;
}
.ring.points_1,
.ring.points_2 {
    background-color: #000000;
    color:#ffffff;
}
.ring.points_3,
.ring.points_4 {
    background-color: #FFFFFF;
}
.ring.points_5,
.ring.points_6 {
    background-color: #0000FF;
    color: #000000;
}
.ring.points_7,
.ring.points_8 {
    background-color: #FF0000;
    color: #000000;
}
.ring.points_9,
.ring.points_10 {
    background-color: #FFFF00;
}
</style>
</head><body>
<div id="success"></div>
<div id="stats">

</div>
<?php

$aPoints = array('-1','0','1','2','3','4','5','6','7','8','9','10');

foreach ($aPoints AS $ring){
    echo "<div class='ring points_{$ring}' data-points='{$ring}'> {$ring} </div>";
}
?>

</body></html>
