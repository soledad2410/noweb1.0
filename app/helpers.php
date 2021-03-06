<?php
/**
 * Created by PhpStorm.
 * User: hung_it
 * Date: 06/12/2014
 * Time: 5:29 CH
 */

/** Get current visit's platform website
 * Return mobile,or desktop
 */
function getCurrentPlatform() {
	$user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$type = 'browser';
	// matches popular bots
	if (preg_match("/googlebot|adsbot|yahooseeker|yahoobot|msnbot|watchmouse|pingdom\.com|feedfetcher-google/", $user_agent)) {
		$type = 'bot';
	}
	// matches popular mobile devices that have small screens and/or touch inputs
	// mobile devices have regional trends; some of these will have varying popularity in Europe, Asia, and America
	// detailed demographics are unknown, and South America, the Pacific Islands, and Africa trends might not be represented, here
	if (preg_match("/phone|iphone|itouch|ipod|symbian|android|htc_|htc-|palmos|blackberry|opera mini|iemobile|windows ce|nokia|fennec|hiptop|kindle|mot |mot-|webos\/|samsung|sonyericsson|^sie-|nintendo/", $user_agent)) {
		// these are the most common
		$type = 'mobile';
	}
	if (preg_match("/mobile|pda;|avantgo|eudoraweb|minimo|netfront|brew|teleca|lg;|lge |wap;| wap /", $user_agent)) {
		// these are less common, and might not be worth checking
		$type = 'mobile';
	}
	return $type;
}

/** Convert utf8 character to ansi character */
function toAnsi($text, $space = false) {
	$text = html_entity_decode($text);
	$text = preg_replace("/(ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
	$text = str_replace("ç", "c", $text);
	$text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);
	$text = preg_replace("/(ì|í|î|ị|ỉ|ĩ)/", 'i', $text);
	$text = preg_replace("/(ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
	$text = preg_replace("/(ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
	$text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
	$text = preg_replace("/(đ)/", 'd', $text);
	/** upper case */
	$text = preg_replace("/(Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $text);
	$text = str_replace("Ç", "C", $text);
	$text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $text);
	$text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $text);
	$text = preg_replace("/(Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $text);
	$text = preg_replace("/(Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $text);
	$text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $text);
	$text = preg_replace("/(Đ)/", 'D', $text);
	$text = preg_replace("/(̀|́|̉|$|>)/", '', $text);
	$text = preg_replace("'<[\/\!]*?[^<>]*?>'si", "", $text);

	$text = strtolower($text);
	$text = preg_replace('/\s\s+/', ' ', $text);
	$text = trim(preg_replace('/[^a-z0-9 ]/', '', $text));
	if (!$space) {
		$text = str_replace(" ", '-', $text);
	}
	$text = str_replace("----", "-", $text);
	$text = str_replace("---", "-", $text);
	$text = str_replace("--", "-", $text);
	return $text;
}

/** extend validator */

\Validator::extend('unique_multiple', function ($attribute, $value, $parameters) {
	$table = array_shift($parameters);
	$query = \DB::table($table);
	foreach ($parameters as $i => $field) {
		$query->where($field, $value[$i]);
	}
	return ($query->count() == 0);
});

/**
 *
 * @param string $str
 * @param string $format
 * @return NULL
 */
function getDatetime($str, $format = 'H:i d-m-Y') {
	$date = DateTime::createFromFormat($format, $str);
	if ($date) {
		return $date->format('Y-m-d H:i');
	}
	return null;
}

/**
 *
 * @param Datetime $datetime
 * @param string $format
 * @return string
 */
function formatDatetimeVi($datetime, $format = 'H:i d-m-Y') {
	return date($format, strtotime($datetime));
}

function dateFormat($datetime, $format = 'd/m/Y') {
	return date_format(date_create($datetime), $format);
}

/**
 * @param $currency
 * @param string $dec_point
 * @param string $thousand_dec
 * @return int
 */
function currency2Number($currency, $dec_point = '.', $thousand_dec = ',') {
	$number = explode($dec_point, $currency);
	$number = $number['0'];
	return intval(str_replace($thousand_dec, '', $number));
}

/**
 *
 * @param string $xmlstr
 */
function xml2array($xmlstr) {
	$doc = new DOMDocument();
	$doc->load($xmlstr);
	return domnode_to_array($doc->documentElement);
}
/**
 *
 * @param xml  $node
 * @return Ambigous <string, multitype:multitype: multitype:string  Ambigous <multitype:, multitype:string > >
 */
function domnode_to_array($node) {
	$output = array();
	switch ($node->nodeType) {
		case XML_CDATA_SECTION_NODE:
		case XML_TEXT_NODE:
			$output = trim($node->textContent);
			break;
		case XML_ELEMENT_NODE:
			for ($i = 0, $m = $node->childNodes->length; $i < $m; $i++) {
				$child = $node->childNodes->item($i);
				$v = domnode_to_array($child);
				if (isset($child->tagName)) {
					$t = $child->tagName;
					if (!isset($output[$t])) {
						$output[$t] = array();
					}
					$output[$t][] = $v;
				} elseif ($v) {
					$output = (string) $v;
				}
			}
			if (is_array($output)) {
				if ($node->attributes->length) {
					$a = array();
					foreach ($node->attributes as $attrName => $attrNode) {
						$a[$attrName] = (string) $attrNode->value;
					}
					$output['@attributes'] = $a;
				}
				foreach ($output as $t => $v) {
					if (is_array($v) && count($v) == 1 && $t != '@attributes') {
						$output[$t] = $v[0];
					}
				}
			}
			break;
	}
	return $output;
}

/**
 *
 * @param string $path
 * @return array
 */
function listDir($path) {
	$results = scandir($path);

	$list = [];
	foreach ($results as $result) {

		if (is_dir($path . '/' . $result) && $result != '.' && $result != '..') {
			$list[] = $result;
		}
	}
	return $list;
}

/**
 *
 * @param string $path
 * @param string $extension
 * @return multitype:unknown
 */
function listFile($path, $extension = null) {
	$results = scandir($path);
	$list = [];
	foreach ($results as $result) {
		if (is_file($path . '/' . $result) && $result != '.' && $result != '..') {
			// if (is_array($extension) && is_extension($extension, $result)) {
			if (is_array($extension)) {
				$list[] = $result;
			}
			if (!$extension) {
				$list[] = $result;
			}

		}
	}
	return $list;
}

/**
 * is_extension()
 *
 * @param array $extensions
 * @param string $file
 * @return boolean
 */
function is_extension($extensions, $file_name) {
	$file_extension = strstr($file_name, ".");
	if (in_array(strtoupper($file_extension), $extensions)) {return true;} else {return false;}
}


function getThemeDir()
{
    return '/public/themes/';
}
