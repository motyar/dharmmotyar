<?php
/*
* parseHtml.php
* Author: Carlos Costa Jordao
* Email: carlosjordao@yahoo.com
*
* My notation of variables:
* i_ = integer, ex: i_count
* a_ = array, a_html
* b_ = boolean,
* s_ = string
*
* What it does:
* - parses a html string and get the tags
* - exceptions: html tags like <br> <hr> </a>, etc
* - At the end, the array will look like this:
* ["IMG"][0]["SRC"] = "xxx"
* ["IMG"][1]["SRC"] = "xxx"
* ["IMG"][1]["ALT"] = "xxx"
* ["A"][0]["HREF"] = "xxx"
*
*/
function parseHtml($s_str)
{
$i_indicatorL = 0;
$i_indicatorR = 0;
$s_tagOption = "";
$i_arrayCounter = 0;
$a_html = array();
// Search for a tag in string
while( is_int(($i_indicatorL=strpos($s_str,"<",$i_indicatorR))) ) {
// Get everything into tag...
$i_indicatorL++;
$i_indicatorR = strpos($s_str,">", $i_indicatorL);
$s_temp = substr($s_str, $i_indicatorL, ($i_indicatorR-$i_indicatorL) );
$a_tag = explode( ' ', $s_temp );
// Here we get the tag's name
list( ,$s_tagName,, ) = each($a_tag);
$s_tagName = strtoupper($s_tagName);
// Well, I am not interesting in <br>, </font> or anything else like that...
// So, this is false for tags without options.
$b_boolOptions = is_array(($s_tagOption=each($a_tag))) && $s_tagOption[1];
if( $b_boolOptions ) {
// Without this, we will mess up the array
$i_arrayCounter = (int)count($a_html[$s_tagName]);
// get the tag options, like src="htt://". Here, s_tagTokOption is 'src'and s_tagTokValue is '"http://"'

do {
$s_tagTokOption = strtoupper(strtok($s_tagOption[1], "="));
$s_tagTokValue = trim(strtok("="));
$a_html[$s_tagName][$i_arrayCounter][$s_tagTokOption] =
$s_tagTokValue;
$b_boolOptions = is_array(($s_tagOption=each($a_tag))) &&
$s_tagOption[1];
} while( $b_boolOptions );
}
}
return $a_html;
}

?>


