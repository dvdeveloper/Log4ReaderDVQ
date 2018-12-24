<?php
class CreateLog {

	var $id = 1;
	var $parent = 0;
	var $date;
	var $action = "";
	var $title = "Unknown";
	var $type = "Info";
	var $message = "";
	var $parameters = "";
	var $users = "";
	var $IP = "";
	var $origen = "";

   	function save($path = "public/logs",$format = "d-m-Y",$prefix = "")
   	{

   		$this->date = date("d-m-Y H:i:s");

   		if($this->type == "" || $this->type == null){
   			$this->type = "info";
   		}

   		if($this->title == "" || $this->title == null){
   			$this->title = "Unknown";
   		}

   		if($prefix != "" || $prefix != null){
   			$prefix = $prefix."_";
   		}

   		if($format == null){
   			$this->date = date("d-m-Y H:i:s");
   		}

   		if($path == "" || $path == null){
   			$path = "public/logs";
   		}


   		$xml = new DOMDocument();
		$root = $xml->createElement("root");
		$logs = $xml->createElement("logs");

		$id = $xml->createElement("id",$this->id);
		$parent = $xml->createElement("parent",$this->parent);
		$datetime = $xml->createElement("datetime",$this->date);
		$action = $xml->createElement("action",$this->action);
		$title = $xml->createElement("title",$this->title);
		$type = $xml->createElement("type",$this->type);
		$message = $xml->createElement("message",$this->message);
		$parameters = $xml->createElement("parameters",$this->parameters);
		$users = $xml->createElement("users",$this->users);
		$ip = $xml->createElement("ip",$this->IP);
		$origen = $xml->createElement("origen",$this->origen);

		$logs->appendChild($id);
		$logs->appendChild($parent);
		$logs->appendChild($datetime);
		$logs->appendChild($action);
		$logs->appendChild($title);
		$logs->appendChild($type);
		$logs->appendChild($message);
		$logs->appendChild($parameters);
		$logs->appendChild($users);
		$logs->appendChild($ip);
		$logs->appendChild($origen);

		$root->appendChild($logs);
		$xml->appendChild($root);
		$xml->formatOutput = true;

		$name = $prefix."".date($format).".dvq";
		$filename = $path.'/'.$name;
		
		if(!file_exists($filename)){
			$xml->save($filename);

		}else{
			$xml = simplexml_load_file($filename);
			$this->id = count($xml->logs)+1;

			$logs = $xml->addChild('logs');
			$logs->addChild('id', $this->id);
			$logs->addChild('parent', $this->parent);
			$logs->addChild('datetime', $this->date);
			$logs->addChild('action', $this->action);
			$logs->addChild('title', $this->title);
			$logs->addChild('type', $this->type);
			$logs->addChild('message', $this->message);
			$logs->addChild('parameters', $this->parameters);
			$logs->addChild('users', $this->users);
			$logs->addChild('ip', $this->IP);
			$logs->addChild('origen', $this->origen);

			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($xml->asXML());
			$dom->save($filename);
		}
   		return $this->id;
   	}
} 