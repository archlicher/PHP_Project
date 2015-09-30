<?php

namespace Framework;

class Validation {

	private $rules = array();
	private $errors = array();

	public function setRule($rule, $value, $params = null, $name = null) {
		$this->rules[] = array('val' => $value, 'rule' => $rule, 'par' => $params, $name =>$name);
		return $this;
	}

	public function validate() {
		$this->errors = array();
		if (count($this->rules)>0) {
			foreach ($this->rules as $value) {
				if (!$this->$v['rule']($v['val'], $v['par'])) {
					if ($v['name']) {
						$this->errors[] = $v['name'];
					} else {
						$this->errors[] = $v['rule'];
					}
				}
			}
		}
		return (bool) !count($this->errors);
	}

	public function __call($a, $b) {
		throw new \Exception("Invalid method", 500);
	}

	public function getErrors() {
		return $this->errors;
	}

	public static function matches($val1, $val2) {
		return $val1 == $val2;
	}

	public static function matchesStrict($val1, $val2) {
		return $val1 === $val2;
	}

	public static function different($val1, $val2) {
		return $val1 != $val2;
	}

	public static function differentStrict($val1, $val2) {
		return $val1 !== $val2;
	}

	public static function minlength($val1, $val2) {
		return (mb_strlen($val1) >= $val2);
	}

	public static function maxlength($val1, $val2) {
		return (mb_strlen($val1) <= $val2);
	}

	public static function exactlength($val1, $val2) {
		return (mb_strlen($val1) == $val2);
	}

	public static function gt($val1, $val2) {
		return ($val1 > $val2);
	}

	public static function lt($val1, $val2) {
		return ($val1 < $val2);
	}

	public static function alpha($val) {
		return (bool) preg_match('/^([a-z])+$/i', $val);
	}

	public static function alphaNum($val) {
		return (bool) preg_match('/^([a-z0-9])+$/i', $val);
	}

	public static function numeric($val) {
		return is_numeric($val);
	}

	public static function email($val) {
		return filter_var($val, FILTER_VALIDATE_EMAIL) !== false;
	}

	public static function emails($val) {
		if (is_array($val)) {
			foreach ($val as $value) {
				if (!self::email($value)) {
					return false;
				}
			}
		} else {
			return false;
		}
		return true;
	}

	public static function url($val) {
		return filter_var($val, FILTER_VALIDATE_URL) !== false;
	}

	public static function ip($val) {
		return filter_var($val, FILTER_VALIDATE_IP) !== false;
	}

	public static function regexp($val1, $val2) {
		return (bool) preg_match($val1, $val2);
	}

	public static function custom($val1, $val2) {
		if ($val2 instanceof \Closure) {
			return (boolean) call_user_func($val2, $val1);			
		}
		throw new \Exception;
	}
}