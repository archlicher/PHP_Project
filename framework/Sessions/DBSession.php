<?php

namespace Framework\Session;

class DBSession extends \Framework\DB\SimpleDB implements \Framework\Session\ISession {

	private $sessionName;
	private $tableName;
	private $lifetime;
	private $path;
	private $domain;
	private $secure;
	private $sessionId = null;
	private $sessionData = array();

	public function __construct($dbConnection, $name, $tableName = 'session', $lifetime = 3600, $path = null, $domain = null, $secure = false) {
		parent::__construct($dbConnection);
		$this->sessionName = $name;
		$this->tableName = $tableName;
		$this->lifetime = $lifetime;
		$this->path = $path;
		$this->domain = $domain;
		$this->secure = $secure;
		$this->sessionId = $_COOKIE[$name];

		if (rand(0,50)==1) {
			$this->garbageCollector();
		}

		if (strlen($this->sessionId)<32){
			$this->startNewSession();
		} else if (!$this->validateSession()) {
			$this->startNewSession();
		}
	}

	private function garbageCollector() {
		$this->prepare('DELETE FROM '.$this->tableName.' WHERE valid_until<?', array(time()))->execute();
	}

	private function startNewSession() {
		$this->sessionId = md5(uniqid('ar', TRUE));
		$this->prepare('INSERT INTO '. $this->tableName. ' (sessid, valid_until) VALUES (?,?)', array($this->sessionId, (time()+$this->lifetime)))->execute();
		setcookie($this->sessionName, $this->sessionId, (time()+$this->lifetime), $this->path, $this->domain, $this->secure, true);
	}

	public function getSessionId() {
		return $this->sessionId;
	}

	public function saveSession() {
		if ($this->sessionId) {
			$this->prepare('UPDATE '. $thid->tableName . ' SET sess_data=?, valid_until=? WHERE sessid=?',
					array(serialize($this->sessionData), (time()+$this->lifetime), $this->sessionId))->execute();
		}
		setcookie($this->sessionName, $this->sessionId, (time()+$this->lifetime), $this->path, $this->domain, $this->secure, true);
	}

	public function destroySession() {
		if ($this->sessionId) {
			$this->prepare('DELETE FROM ' . $this->tableName . ' WHERE sessid=?', array($this->sessionId))->execute();
		}
	}

	private function validateSession() {
		if ($this->sessionId) {
			$d = $this->prepare('SELECT * FROM '. $this->tableName . ' WHERE sessid=? AND valid_until=?',
					array($this->sessionId, (time()+$this->lifetime)))->execute()->fetchAllAssoc();
			if (is_array($d) && count($d) == 1 && $d[0]) {
				$this->sessionData = unserialize($d[0]['sess_data']);
				return true;
			}
		}
		return false;
	}

	public function __get($name) {
		return $this->sessionData[$name];
	}

	public function __set($name, $value) {
		$this->sessionData[$name] = $value;
	}
}