<?php
$d = 7;
for($i = 1;$i <= 5;$i += 1){
?>
$code = fromHexValue(data.d<?php echo $d;?><?php echo $i;?>.charAt(0));<br />
if($code == 'r' || $code == 'b' || $code == 'l' || $code == 'p' || $code == 'g' || $code == 'o') $code = 't' + $code;<br />
$('#d<?php echo $d;?><?php echo $i;?>t').attr('src','images/odontogram/' + $code + '.png');<br />
$code = fromHexValue(data.d<?php echo $d;?><?php echo $i;?>.charAt(1));<br />
if($code == 'r' || $code == 'b' || $code == 'l' || $code == 'p' || $code == 'g' || $code == 'o') $code = 'l' + $code;<br />
$('#d<?php echo $d;?><?php echo $i;?>l').attr('src','images/odontogram/' + $code + '.png');<br />
$code = fromHexValue(data.d<?php echo $d;?><?php echo $i;?>.charAt(2));<br />
if($code == 'r' || $code == 'b' || $code == 'l' || $code == 'p' || $code == 'g' || $code == 'o') $code = 'b' + $code;<br />
$('#d<?php echo $d;?><?php echo $i;?>b').attr('src','images/odontogram/' + $code + '.png');<br />
$code = fromHexValue(data.d<?php echo $d;?><?php echo $i;?>.charAt(3));<br />
if($code == 'r' || $code == 'b' || $code == 'l' || $code == 'p' || $code == 'g' || $code == 'o') $code = 'r' + $code;<br />
$('#d<?php echo $d;?><?php echo $i;?>r').attr('src','images/odontogram/' + $code + '.png');<br />
$code = fromHexValue(data.d<?php echo $d;?><?php echo $i;?>.charAt(4));<br />
if($code == 'r' || $code == 'b' || $code == 'l' || $code == 'p' || $code == 'g' || $code == 'o') $code = 'c' + $code;<br />
$('#d<?php echo $d;?><?php echo $i;?>c').attr('src','images/odontogram/' + $code + '.png');<br />
$code = fromHexValue(data.d<?php echo $d;?><?php echo $i;?>.charAt(5));<br />
if($code == 'n') $code = 'bk';<br />
$('#d<?php echo $d;?><?php echo $i;?>s').attr('src','images/odontogram/' + $code + '.png');<br />
<?php
}
?>