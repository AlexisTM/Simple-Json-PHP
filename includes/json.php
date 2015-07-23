<?php namespace Simple;
/**
 *
 * Copyright (C) 2015  PAQUES ALEXIS
 *
 *This program is free software; you can redistribute it and/or
 *modify it under the terms of the GNU General Public License
 *as published by the Free Software Foundation; either version 2
 *of the License, or (at your option) any later version.
 *
 *This program is distributed in the hope that it will be useful,
 *but WITHOUT ANY WARRANTY; without even the implied warranty of
 *MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *GNU General Public License for more details.
 *
 *You should have received a copy of the GNU General Public License
 *along with this program; if not, write to the Free Software
 *Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *  @author    Paques Alexis
 *  @copyright 2014-2015
 *  @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

  /*
   * Class content
   */
  class content {
    private $json;
    private $name;
    public function __construct($name, $content, $enc = true){
      if($enc) $content = json_encode($content);
      $error = json_last_error();
      if($error  != JSON_ERROR_NONE){
        switch (json_last_error()) {
          case JSON_ERROR_DEPTH:
            $errorMessage = '"Maximum stack depth exceeded"';
          break;
          case JSON_ERROR_STATE_MISMATCH:
            $errorMessage = '"Underflow or the modes mismatch"';
          break;
          case JSON_ERROR_CTRL_CHAR:
            $errorMessage = '"Unexpected control character found"';
          break;
          case JSON_ERROR_SYNTAX:
            $errorMessage = '"Syntax error, malformed JSON"';
          break;
          case JSON_ERROR_UTF8:
            $errorMessage = '"Malformed UTF-8 characters, possibly incorrectly encoded"';
          break;
          default:
            $errorMessage = '"Unknown error"';
          break;
        }
        $this->json = $errorMessage;
        $this->name = $name;
      }
      else {
        $this->json = $content;
        $this->name = $name;
      }
    }

    /**
     * @return string
     */
    public function get(){
      return "\"{$this->name}\": {$this->json},";

    }

    /**
    * @return string
    */
    public function get_array(){
      return "{$this->json},";
    }
  }

  /**
   * Class json
   */
  class json {
    private $type;
    private $callback;
    private $contents = array();

    public function __construct($type='raw', $callback='none'){
      if(!($type == 'callback' OR $type == 'var')) $type = 'raw';
      $this->type = $type;
      $this->callback = $callback;
    }

    /**
     * @param name string
     * @param content object|String|null|array|bool
     * @param enc bool
     */
    public function add($name='message', $content = true, $enc = true){
      $dum = new content($name, $content, $enc);
      array_push($this->contents, $dum);
      return true;
    }

    /**
     * @return string
     */
    public function make($array = false){
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

    /**
     * @return string
     */
    public function make_array(){
      $jsonText = "";

      if($this->type == 'var')
        $jsonText .= "var {$this->callback} = ";
      elseif ($this->type == 'callback')
        $jsonText .="{$this->callback}(";
      $jsonText .= '[';
      if(is_array($this->contents)){
        foreach($this->contents as $content){
          $jsonText .= $content->get_array();
        }
      }

      $jsonText = trim($jsonText, ', ');

      $jsonText .= ']';
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

    public function send_array(){
      header('Cache-Control: no-cache, must-revalidate');
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
      header('Content-type: application/json');
      print $this->make_array();
    }
  }
  
?>
