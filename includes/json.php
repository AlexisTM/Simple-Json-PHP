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

  /**
   * Class json
   * 
   * May not have any public attributes as it encodes as json_encode($this)
   * 
   */
class json {
    public function make(){
        return json_encode($this);
    }
    
    public function headers(){
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // JSONs are by default dynamic data
        header('Content-type: application/json');
    }
    
    public function send($options = null){
        $this->headers();
        echo json_encode($this, $options);
    }
    
    public function send_var($var_name = 'custom', $options = null){
        $this->headers();
        echo "var {$var_name} = ";
        echo json_encode($this, $options);
        echo ';';
    }
    
    public function send_callback($cb_name = 'custom', $options = null){
        $this->headers();
        echo "{$cb_name}(";
        echo json_encode($this, $options);
        echo ');';
    }
}
  
?>
