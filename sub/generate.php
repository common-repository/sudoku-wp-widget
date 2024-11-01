<?php

$soptions = $_GET['opts'];
$options = explode(',',urldecode($soptions));

$option = array(
'holes' => 6,
'colo' => 'black',
'back0' => '#aaccff',
'fsiz' => 16,
'ffam' => 'Arial',
'side' => 200,                                    
'bucol' => 'black',
'buback' => 'lightgray',
'bumar' => 40
);

$iopt = 0;
foreach($option as $key => $val) {
if ( empty($options[$iopt]) ||  is_null($options[$iopt]) || ! isset($options[$iopt]) || ($options[$iopt])=='' ) {} else { $option[$key] = $options[$iopt]; };
$iopt++;
};

$q = array(array(1,2,3,4,5,6,7,8,9),array(0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0),array(0,0,0,0,0,0,0,0,0));

gen(&$q);
echo print_table(&$q,$option);
return;

#-------------------------------------------------------------------------------------------------------------
function print_table($q,$o) {
$ret = '';
$rows = array();
$row = 0;
$inp = '<input type="text" maxlength="1" style="width:'.intval($o['side']/12).'px;height:'.intval($o['side']/12).'px;font-size:'.$o['fsiz'].'px;text-align:center;" />';
$inph = '<input type="hidden" value="';
$td = '<td style="border:1px solid black;text-align:center;width:'.intval($o['side']/10).'px ;height:'.intval($o['side']/10).'px ;background-color:'.$o['back0'].';">';
$tabl = '<table cellspacing="0" cellpadding="0" style="color:'.$o['colo'].';font-size:'.$o['fsiz'].'px;width:'.$o['side'].'px;height:'.$o['side'].'px;font-family:'.$o['ffam'].';">';
$h = array(0,1,2,3,4,5,6,7,8);
shuffle($h);

for($i = 0 ; $i < 9 ; $i++) {
for($j = 0 ; $j < 9 ; $j++) {
$eq = intval($j/3)*6+$j+intval($i/3)*18+$i*3;
$rows[$eq] = $q[$i][$j];
}}
$ret .= $tabl;
$ret .= '<tr>';
for($k = 0 ; $k < 81 ; $k++) {
$ret .= $td;
switch ($o['holes']) {
case 0:
$ret .= $rows[$k];
break;
case 1:
if ($k==$h[0]+($row*9)) {
$ret .= $inph.$rows[$k].'" />'.$inp; } else { $ret .= $rows[$k]; };
break;
case 2:
if ($k==$h[0]+($row*9) || $k==$h[1]+($row*9)) {
$ret .= $inph.$rows[$k].'" />'.$inp; } else { $ret .= $rows[$k]; };
break;
case 3:
if ($k==$h[0]+($row*9) || $k==$h[1]+($row*9) || $k==$h[2]+($row*9)) {
$ret .= $inph.$rows[$k].'" />'.$inp; } else { $ret .= $rows[$k]; };
break;
case 4:
if ($k==$h[0]+($row*9) || $k==$h[1]+($row*9) || $k==$h[2]+($row*9) || $k==$h[3]+($row*9)) {
$ret .= $inph.$rows[$k].'" />'.$inp; } else { $ret .= $rows[$k]; };
break;
case 5:
if ($k==$h[0]+($row*9) || $k==$h[1]+($row*9) || $k==$h[2]+($row*9) || $k==$h[3]+($row*9) || $k==$h[4]+($row*9)) {
$ret .= $inph.$rows[$k].'" />'.$inp; } else { $ret .= $rows[$k]; };
break;
case 6:
if ($k==$h[0]+($row*9) || $k==$h[1]+($row*9) || $k==$h[2]+($row*9) || $k==$h[3]+($row*9) || $k==$h[4]+($row*9) || $k==$h[5]+($row*9)) {
$ret .= $inph.$rows[$k].'" />'.$inp; } else { $ret .= $rows[$k]; };
break;
default:
if ($k==$h[0]+($row*9) || $k==$h[1]+($row*9) || $k==$h[2]+($row*9)) {
$ret .= $inph.$rows[$k].'" />'.$inp; } else { $ret .= $rows[$k]; };
}
$ret .= '</td>';
if ( is_int(($k+1) / 9) ) {
$ret .= '</tr><tr>';
shuffle($h);
$row++;
};
}
$bustyle = 'font-family:'.$o['ffam'].';font-size:'.intval($o['fsiz']/2).'px;color:'.$o['bucol'].';background-color:'.$o['buback'].';margin-left:'.$o['bumar'].'px;';
$ret .= '</tr></table><br /><button class="sudoku_wpwidg_bu_by_oreste" style="'.$bustyle.'">Hint</button><button class="sudoku_wpwidg_bu_by_oreste" style="'.$bustyle.'">Solution</button>';
return $ret;
}
#-------------------------------------------------------------------------------------------------------------
function gen($q) {
$loo = 0; $ind = 0;
while ( $ind<9 ) {
if ($loo>999) {echo 'gen $loo = '.$loo; return false;}
$funz = 'q'.$ind;
if ($funz(&$q)) { $ind++; } else {
for($i = 0 ; $i < 9 ; $i++) { $q[$ind][$i] = 0; $q[$ind-1][$i] = 0; } ; $ind-- ; }
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function q0($q) {shuffle($q[0]); return true; }
#-------------------------------------------------------------------------------------------------------------
function q1($q) {
$loo = 0; $check = 0; $ind = 0; $temp;
while ( $ind<9 ) {
if ($loo>999) {return false;}
if ( $ind<3 ) {$temp = saa($q[1],array($q[0][0],$q[0][1],$q[0][2]));};
if ( $ind>2 && $ind<6 ) {$temp = saa($q[1],array($q[0][3],$q[0][4],$q[0][5]));};
if ( $ind>5 && $check<3 ) {
for ($i=0; $i<6; $i++) {
if ($q[0][6]==$q[1][$i] || $q[0][7]==$q[1][$i] || $q[0][8]==$q[1][$i]) { $check++; if ($check==3) {break;}; }; 
};
if ($check<3) {$temp = -1;}
}
if ( $ind>5 && $check==3 ) {$temp = saa($q[1],array($q[0][6],$q[0][7],$q[0][8]));}
if ($temp == -1 || $temp == '') {$ind=0;} else {$q[1][$ind] = $temp;$ind++;}
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function q2($q) {
$loo = 0; $check = 0; $ind = 0;
$tarr = array($q[0][6],$q[0][7],$q[0][8],$q[1][6],$q[1][7],$q[1][8]); # list of cumpulsory numbers
#$texc = list of excluded numbers
while ( $ind<9 ) {
if ($loo>999) {return false;}
if ( $ind<3 ) {
$texc = array($q[0][0],$q[0][1],$q[0][2],$q[1][0],$q[1][1],$q[1][2]);
$temp = saa($q[2],$texc,$tarr);
}
if ( $ind>2 && $ind<6 ) {
$texc = array($q[0][3],$q[0][4],$q[0][5],$q[1][3],$q[1][4],$q[1][5]);
$temp = saa($q[2],$texc,$tarr);
}
if ( $ind>5 ) {
$texc = array($q[0][6],$q[0][7],$q[0][8],$q[1][6],$q[1][7],$q[1][8]);
$temp = saa($q[2],$texc);
}
if ($temp == -1 || $temp == '') {$ind=0;} else {$q[2][$ind] = $temp; $ind++;}
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function q3($q) {
$loo = 0; $ind = 0;
while ($ind<9) {
if ($loo>999) {return false;}
switch ($ind) {
case 0:
$temp = saa($q[3],array($q[0][0],$q[0][3],$q[0][6]));
break;
case 1:
$temp = saa($q[3],array($q[0][1],$q[0][4],$q[0][7]));
break;
case 2:
$temp = saa($q[3],array($q[0][2],$q[0][5],$q[0][8]));
break;
case 3:
$temp = saa($q[3],array($q[0][0],$q[0][3],$q[0][6]));
break;
case 4:
$temp = saa($q[3],array($q[0][1],$q[0][4],$q[0][7]));
break;
case 5:
$temp = saa($q[3],array($q[0][2],$q[0][5],$q[0][8]));
break;
case 6:
$temp = saa($q[3],array($q[0][0],$q[0][3],$q[0][6]));
break;
case 7:
$temp = saa($q[3],array($q[0][1],$q[0][4],$q[0][7]));
break;
case 8:
$temp = saa($q[3],array($q[0][2],$q[0][5],$q[0][8]));
break;
}
if ( $temp == -1 ) { $ind=0; } else { $q[3][$ind] = $temp; $ind++; }
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function q4($q) {
$loo = 0; $check = 0; $ind = 0;
while ( $ind<9 ) {
if ($loo>999) {return false;}
switch ($ind) {
case 0:
$temp = saa($q[4],array($q[1][0],$q[1][3],$q[1][6],$q[3][0],$q[3][1],$q[3][2]));
break;
case 1:
$temp = saa($q[4],array($q[1][1],$q[1][4],$q[1][7],$q[3][0],$q[3][1],$q[3][2]));
break;
case 2:
$temp = saa($q[4],array($q[1][2],$q[1][5],$q[1][8],$q[3][0],$q[3][1],$q[3][2]));
break;
case 3:
$temp = saa($q[4],array($q[1][0],$q[1][3],$q[1][6],$q[3][3],$q[3][4],$q[3][5]));
break;
case 4:
$temp = saa($q[4],array($q[1][1],$q[1][4],$q[1][7],$q[3][3],$q[3][4],$q[3][5]));
break;
case 5:
$temp = saa($q[4],array($q[1][2],$q[1][5],$q[1][8],$q[3][3],$q[3][4],$q[3][5]));
break;
case 6:
for ($i=0; $i<6; $i++) { 
if ( $q[3][6]==$q[4][$i] || $q[3][7]==$q[4][$i] || $q[3][8]==$q[4][$i] ) {$check++; if ($check==3) {break;} } }
if ($check<3) {$temp = -1;} else {$temp = saa($q[4],array($q[1][0],$q[1][3],$q[1][6],$q[3][6],$q[3][7],$q[3][8]));}
break;
case 7:
$temp = saa($q[4],array($q[1][1],$q[1][4],$q[1][7],$q[3][6],$q[3][7],$q[3][8]));
break;
case 8:
$temp = saa($q[4],array($q[1][2],$q[1][5],$q[1][8],$q[3][6],$q[3][7],$q[3][8]));
break;
}
if ($temp == -1 || $temp == '') {$ind=0;} else {$q[4][$ind] = $temp; $ind++;}
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function q5($q) {
$loo = 0; $ind = 0; $temp;
# $tarr = list of cumpulsory numbers
# $texc = list of excluded numbers
while ( $ind<9 ) {
if ($loo>999) {return false;}
switch ($ind) {
case 0:
$texc = array($q[3][0],$q[3][1],$q[3][2],$q[4][0],$q[4][1],$q[4][2],$q[2][0],$q[2][3],$q[2][6]);
$tarr = array($q[3][6],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8]);
$temp = saa($q[5],$texc,$tarr);
break;
case 1:
$texc = array($q[3][0],$q[3][1],$q[3][2],$q[4][0],$q[4][1],$q[4][2],$q[2][1],$q[2][4],$q[2][7]);
$tarr = array($q[3][6],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8]);
$temp = saa($q[5],$texc,$tarr);
break;
case 2:
$texc = array($q[3][0],$q[3][1],$q[3][2],$q[4][0],$q[4][1],$q[4][2],$q[2][2],$q[2][5],$q[2][8]);
$tarr = array($q[3][6],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8]);
$temp = saa($q[5],$texc,$tarr);
break;
case 3:
$texc = array($q[3][3],$q[3][4],$q[3][5],$q[4][3],$q[4][4],$q[4][5],$q[2][0],$q[2][3],$q[2][6]);
$tarr = array($q[3][6],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8]);
$temp = saa($q[5],$texc,$tarr);
break;
case 4:
$texc = array($q[3][3],$q[3][4],$q[3][5],$q[4][3],$q[4][4],$q[4][5],$q[2][1],$q[2][4],$q[2][7]);
$tarr = array($q[3][6],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8]);
$temp = saa($q[5],$texc,$tarr);
break;
case 5:
$texc = array($q[3][3],$q[3][4],$q[3][5],$q[4][3],$q[4][4],$q[4][5],$q[2][2],$q[2][5],$q[2][8]);
$tarr = array($q[3][6],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8]);
$temp = saa($q[5],$texc,$tarr);
break;
case 6:
$texc = array($q[3][8],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8],$q[2][0],$q[2][3],$q[2][6]);
$temp = saa($q[5],$texc);
break;
case 7:
$texc = array($q[3][8],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8],$q[2][1],$q[2][4],$q[2][7]);
$temp = saa($q[5],$texc);
break;
case 8:
$texc = array($q[3][8],$q[3][7],$q[3][8],$q[4][6],$q[4][7],$q[4][8],$q[2][2],$q[2][5],$q[2][8]);
$temp = saa($q[5],$texc);
break;
}
if ($temp == -1 || $temp == '') {$ind=0;} else {$q[5][$ind] = $temp;$ind++;}
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function q6($q) {
$loo = 0; $temp; $ind = 0;
# $tarr = list of cumpulsory numbers
# $texc = list of excluded numbers
while ($ind<9) {
if ($loo>999) {return false;}
switch ($ind) {
case 0:
$texc = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc);
break;
case 1:
$texc = array($q[0][1],$q[0][4],$q[0][7],$q[3][1],$q[3][4],$q[3][7]);
$tarr = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc,$tarr);
break;
case 2:
$texc = array($q[0][2],$q[0][5],$q[0][8],$q[3][2],$q[3][5],$q[3][8]);
$tarr = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc,$tarr);
break;
case 3:
$texc = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc);
break;
case 4:
$texc = array($q[0][1],$q[0][4],$q[0][7],$q[3][1],$q[3][4],$q[3][7]);
$tarr = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc,$tarr);
break;
case 5:
$texc = array($q[0][2],$q[0][5],$q[0][8],$q[3][2],$q[3][5],$q[3][8]);
$tarr = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc,$tarr);
break;
case 6:
$texc = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc);
break;
case 7:
$texc = array($q[0][1],$q[0][4],$q[0][7],$q[3][1],$q[3][4],$q[3][7]);
$tarr = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc,$tarr);
break;
case 8:
$texc = array($q[0][2],$q[0][5],$q[0][8],$q[3][2],$q[3][5],$q[3][8]);
$tarr = array($q[0][0],$q[0][3],$q[0][6],$q[3][0],$q[3][3],$q[3][6]);
$temp = saa($q[6],$texc,$tarr);
break;
}
if ($temp == -1 || $temp == '') {$ind=0;} else {$q[6][$ind] = $temp;$ind++;}
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function q7($q) {
$loo = 0; $temp; $ind = 0;
# $tarr = list of cumpulsory numbers
# $texc = list of excluded numbers
while ($ind<9) {
if ($loo>999) {return false;}
switch ($ind) {
case 0:
$texc = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6],$q[6][0],$q[6][1],$q[6][2]);
$temp = saa($q[7],$texc);
break;
case 1:
$texc = array($q[1][1],$q[1][4],$q[1][7],$q[4][1],$q[4][4],$q[4][7],$q[6][0],$q[6][1],$q[6][2]);
$tarr = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6]);
$temp = saa($q[7],$texc,$tarr);
break;
case 2:
$texc = array($q[1][2],$q[1][5],$q[1][8],$q[4][2],$q[4][5],$q[4][8],$q[6][0],$q[6][1],$q[6][2]);
$tarr = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6]);
$temp = saa($q[7],$texc,$tarr);
break;
case 3:
$texc = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6],$q[6][3],$q[6][4],$q[6][5]);
$temp = saa($q[7],$texc);
break;
case 4:
$texc = array($q[1][1],$q[1][4],$q[1][7],$q[4][1],$q[4][4],$q[4][7],$q[6][3],$q[6][4],$q[6][5]);
$tarr = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6]);
$temp = saa($q[7],$texc,$tarr);
break;
case 5:
$texc = array($q[1][2],$q[1][5],$q[1][8],$q[4][2],$q[4][5],$q[4][8],$q[6][3],$q[6][4],$q[6][5]);
$tarr = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6]);
$temp = saa($q[7],$texc,$tarr);
break;
case 6:
$texc = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6],$q[6][6],$q[6][7],$q[6][8]);
$temp = saa($q[7],$texc);
break;
case 7:
$texc = array($q[1][1],$q[1][4],$q[1][7],$q[4][1],$q[4][4],$q[4][7],$q[6][6],$q[6][7],$q[6][8]);
$tarr = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6]);
$temp = saa($q[7],$texc,$tarr);
break;
case 8:
$texc = array($q[1][2],$q[1][5],$q[1][8],$q[4][2],$q[4][5],$q[4][8],$q[6][6],$q[6][7],$q[6][8]);
$tarr = array($q[1][0],$q[1][3],$q[1][6],$q[4][0],$q[4][3],$q[4][6]);
$temp = saa($q[7],$texc,$tarr);
break;
}
if ($temp == -1 || $temp == '') {$ind=0;} else {$q[7][$ind] = $temp;$ind++;}
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function q8($q) {
$loo = 0; $temp; $ind = 0;
$tarr = array(); # list of cumpulsory numbers
# $texc = list of excluded numbers
while ($ind<9) {
if ($loo>999) {return false;}
switch ($ind) {
case 0:
$texc = array($q[6][0],$q[6][1],$q[6][2],$q[7][0],$q[7][1],$q[7][2],$q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$tarr = array($q[6][6],$q[6][7],$q[6][8],$q[7][6],$q[7][7],$q[7][8]);
$temp = saa($q[8],$texc,$tarr);
break;
case 1:
$texc = array($q[6][0],$q[6][1],$q[6][2],$q[7][0],$q[7][1],$q[7][2],$q[2][1],$q[2][4],$q[2][7],$q[5][1],$q[5][4],$q[5][7]);
$tarr = array($q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$temp = saa($q[8],$texc,$tarr);
break;
case 2:
$texc = array($q[6][0],$q[6][1],$q[6][2],$q[7][0],$q[7][1],$q[7][2],$q[2][2],$q[2][5],$q[2][8],$q[5][2],$q[5][5],$q[5][8]);
$tarr = array($q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$temp = saa($q[8],$texc,$tarr);
break;
case 3:
$texc = array($q[6][3],$q[6][4],$q[6][5],$q[7][3],$q[7][4],$q[7][5],$q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$tarr = array($q[6][6],$q[6][7],$q[6][8],$q[7][6],$q[7][7],$q[7][8]);
$temp = saa($q[8],$texc,$tarr);
break;
case 4:
$texc = array($q[6][3],$q[6][4],$q[6][5],$q[7][3],$q[7][4],$q[7][5],$q[2][1],$q[2][4],$q[2][7],$q[5][1],$q[5][4],$q[5][7]);
$tarr = array($q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$temp = saa($q[8],$texc,$tarr);
break;
case 5:
$texc = array($q[6][3],$q[6][4],$q[6][5],$q[7][3],$q[7][4],$q[7][5],$q[2][2],$q[2][5],$q[2][8],$q[5][2],$q[5][5],$q[5][8]);
$tarr = array($q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$temp = saa($q[8],$texc,$tarr);
break;
case 6:
$texc = array($q[6][6],$q[6][7],$q[6][8],$q[7][6],$q[7][7],$q[7][8],$q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$temp = saa($q[8],$texc);
break;
case 7:
$texc = array($q[6][6],$q[6][7],$q[6][8],$q[7][6],$q[7][7],$q[7][8],$q[2][1],$q[2][4],$q[2][7],$q[5][1],$q[5][4],$q[5][7]);
$tarr = array($q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$temp = saa($q[8],$texc,$tarr);
break;
case 8:
$texc = array($q[6][6],$q[6][7],$q[6][8],$q[7][6],$q[7][7],$q[7][8],$q[2][2],$q[2][5],$q[2][8],$q[5][2],$q[5][5],$q[5][8]);
$tarr = array($q[2][0],$q[2][3],$q[2][6],$q[5][0],$q[5][3],$q[5][6]);
$temp = saa($q[8],$texc,$tarr);
break;
}
if ($temp == -1 || $temp == '') {$ind=0;} else {$q[8][$ind] = $temp;$ind++;}
$loo++;
}
return true;
}
#-------------------------------------------------------------------------------------------------------------
function saa($n,$a,$b = array(1,2,3,4,5,6,7,8,9)) {
$merged = array_merge($a,$n);
$reduced = array_unique($merged);
$a_result = array();
for ($i = 0; $i < count($b); $i++) {
if ( in_array($b[$i],$reduced) ) {  } else { $a_result[] = $b[$i]; };
}
if (count($a_result)<1){$ret = false;};
if (count($a_result)==1){$ret = $a_result[0];};
if (count($a_result)>1){$ret = $a_result[array_rand($a_result,1)];
};
return $ret;
}

?>