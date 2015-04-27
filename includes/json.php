<?php

  class content {
    private $json;
    public function __construct($name, $content, $enc = true){
      if($enc) $content = json_encode($content);
      $this->json = "\"{$name}\": {$content},";
    }
    public function get(){
      return $this->json;
    }
  }

  class json {
    private $type;
    private $callback;
    private $contents = array();

    public function __construct($type='raw', $callback='none'){
      if(!($type == 'callback' OR $type == 'var')) $type = 'raw';
      $this->type = $type;
      $this->callback = $callback;
    }

    public function add($name='message', $content = true, $enc = true){
      $dum = new content($name, $content, $enc);
      array_push($this->contents, $dum);
      return true;

      $error = json_last_error();
      if($error  != JSON_ERROR_NONE){
        switch (json_last_error()) {
          case JSON_ERROR_DEPTH:
            $text = "Maximum stack depth exceeded";
          break;
          case JSON_ERROR_STATE_MISMATCH:
            $text = "Underflow or the modes mismatch";
          break;
          case JSON_ERROR_CTRL_CHAR:
            $text = "Unexpected control character found";
          break;
          case JSON_ERROR_SYNTAX:
            $text = "Syntax error, malformed JSON";
          break;
          case JSON_ERROR_UTF8:
            $text = "Malformed UTF-8 characters, possibly incorrectly encoded";
          break;
          default:
            $text = "Unknown error";
          break;
          $dum = new dummy("error", $text);
        }
        array_push($this->contents, $content);
      }
      return false;
    }

    public function make(){
      $jsonText = "";

      if($this->type == 'var')
        $jsonText .= "var {$this->callback} = ";
      elseif ($this->type == 'callback')
        $jsonText .="{$this->callback}(";
      $jsonText .= '{';
      if(is_array($this->contents)){
        foreach($this->contents as $content){
          $jsonText .= $content->get();
        }
      }

      $jsonText = trim($jsonText, ', ');

      $jsonText .= '}';
      // End of encapsulate JSON
      if ($this->type == 'var')
        $jsonText .= ';';
      elseif ($this->type == 'callback')
        $jsonText .= ');';
      
      return $jsonText;
    }

    public function send(){
      header('Cache-Control: no-cache, must-revalidate');
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
      header('Content-type: application/json');
      print $this->make();
    }
  }
  
?>
