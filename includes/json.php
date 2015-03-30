<?php
  // type : 'function' or 'var' or 'raw'
  class json {
    private $type;
    private $callback;
    private $contents = array();

    public function __construct($type='raw', $callback='none'){
      if(!($type == 'callback' OR $type == 'var' OR $type == 'raw')) $type = 'raw';
      $this->type = $type;
      $this->callback = $callback;
    }

    public function addContent($content){
      if(get_parent_class($content) == 'content') array_push($this->contents, $content);
    }

    public function json_make(){
      $jsonText = "";
      // Callback case
      if($this->type == 'var'){
        $jsonText .= "var {$this->callback} = ";
      }
      elseif ($this->type == 'callback'){
        $jsonText .="{$this->callback}(";
      }

      // Begin of Encapsulate JSON
      $jsonText .= '{';
      // Data
      if(is_array($this->contents)){
        foreach($this->contents as $content){
          $jsonText .= $content->getJSON();
        }
      }
      // Remove the last comma
      $jsonText = trim($jsonText, ', ');

      $jsonText .= '}';
      // End of encapsulate JSON
      if ($this->type == 'var'){
        $jsonText .= ';';
      } elseif ($this->type == 'callback'){
        $jsonText .= ');';
      }
      return $jsonText;
    }
  }

  abstract class content {
    public $json;
    public function getJSON(){
      return $this->json;
    }
  }
  class objectJson extends content {
    public function __construct($name, $object){
      $stringifiedObject = json_encode($object);
      $this->json = "\"{$name}\": {$stringifiedObject},";
    }
  }
  
  class arrayJson extends content {
    public function __construct($name, $array){
      $stringifiedArray = json_encode($array);
      $this->json = "\"{$name}\": {$stringifiedArray},";
    }
  }
  
  class propertyJson extends content {
    public function __construct($name, $value){
      $value = addslashes($value);
      $this->json = "\"{$name}\": \"{$value}\",";
    }
  }

  class jsonJson extends content {
    public function __construct($name, $value){
      //$value = addslashes($value);
      $this->json = "\"{$name}\": {$value},";
    }
  }
  
  class textJson extends content {
    public function __construct($value){
      $this->json = "\"Text\": \"{$value}\",";
    }
  }
  
  function json_send($json){
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');//*/
    echo $json->json_make();
  }
?>
