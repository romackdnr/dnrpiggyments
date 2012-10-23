<?php



if (!function_exists('sanitize')) {

	function sanitize($http_var, $char_limit = 255, $search = null) {
		global $g_exclude;
			$search = array('/(rm )|(mv )|(;)'.$search.'/si');
		if(is_array($http_var)){
			foreach ($http_var as $key=>$value) {
				if(is_array($value)) {
					$value = sanitize($value);
				}else{
					if(get_magic_quotes_gpc()){
						$value = stripslashes($value);
					}
					$http_var[$key] = $value;
				}
			}

		}else{
			if(is_string($http_var)){
				if(get_magic_quotes_gpc()){
					$http_var = stripslashes($http_var);
				}
				$http_var = substr(htmlspecialchars(preg_replace($search, '', trim($http_var))),0, $char_limit);
			}
		}

		return $http_var;
	}

}
?>
