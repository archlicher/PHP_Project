<?php

namespace Framework;

class Common {

	public static function normalize($data, $types) {
		$types = explode('|', $types);
		if (is_array($types)) {
			foreach ($types as $value) {
				if ($value=='int') {
					$data=(int)$data;
				}
				if ($value=='float') {
					$data=(float)$data;
				}
				if ($value=='double') {
					$data=(double)$data;
				}
				if ($value=='bool') {
					$data=(bool)$data;
				}
				if ($value=='string') {
					$data=(string)$data;
				}
				if ($value=='trim') {
					$data=trim($data);
				}
				if ($value=='xss') {
					$data=self::xss_clean($data);
				}
			}
		}
		return $data;
	}

	/**
	*resource: https://gist.github.com/mbijon/1098477
	*@param type $data
	*@return type
	*/

	public static function xss_clean($data)	{
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
	}
	
	public static function headerStatus($code) {
		$codes = array('100' => 'Continue',
						'101' => 'Switching Protocols',
						'200' => 'OK',
						'201' => 'Created',
						'202' => 'Accepted',
						'203' => 'Non-Authoritative Information',
						'204' => 'No Content',
						'205' => 'Reset Content',
						'206' => 'Partial Content',
						'300' => 'Multiple Choices',
						'301' => 'Moved Permanently',
						'302' => 'Moved Temporarily',
						'303' => 'See Other',
						'304' => 'Not Modified',
						'305' => 'Use Proxy',
						'400' => 'Bad Request',
						'401' => 'Unauthorized',
						'402' => 'Payment Required',
						'403' => 'Forbidden',
						'404' => 'Not Found',
						'405' => 'Method Not Allowed',
						'406' => 'Not Acceptable',
						'407' => 'Proxy Authentication Required',
						'408' => 'Request Time-out',
						'409' => 'Conflict',
						'410' => 'Gone',
						'411' => 'Length Required',
						'412' => 'Precondition Failed',
						'413' => 'Request Entity Too Large',
						'414' => 'Request-URI Too Large',
						'415' => 'Unsupported Media Type',
						'500' => 'Internal Server Error',
						'501' => 'Not Implemented',
						'502' => 'Bad Gateway',
						'503' => 'Service Unavailable',
						'504' => 'Gateway Time-out',
						'505' => 'HTTP Version not supported'
		);
		if (!$codes[$code]) {
			$code = 500;
		}
		header($_SERVER['SERVER_PROTOCOL']. ' ' . $statusCode . ' ' . $codes[$code], true, $code);
	}
}