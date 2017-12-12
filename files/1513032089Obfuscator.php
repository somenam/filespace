<?php

/**
 * Description of Obfuscator
 *
 * @author Andrey
 */
class Obfuscator {

    private function intelectic_string($min, $max, $ints_use = false) {
        $length = rand($min, $max);
        $vowels = 'aeiouy';
        $unspoken = 'bcdfghjklmnpqrstvwxz';
        $digits = '01234567890';
        // set lengths
        $vowels_length = strlen($vowels) - 1;
        $unspoken_length = strlen($unspoken) - 1;
        $digits_length = strlen($digits) - 1;
        $string = '';
        // set status variable
        $use = rand(1, 2);
        for ($i = 0; $i < $length; $i++) {
            switch ($use) {
                case 1:
                    // vowels section
                    $string .= $vowels[rand(0, $vowels_length)];
                    //set new use
                    $use = 2;
                    break;
                case 2:
                    // unspoken section, set use one or two unspoken
                    $unspoken_random = rand(1, 2);
                    if ($unspoken_random == 1) {
                        $string .= $unspoken[rand(0, $unspoken_length)];
                    } else {
                        $string .= $unspoken[rand(0, $unspoken_length)] . $unspoken[rand(0, $unspoken_length)];
                    }
                    // set new use
                    $use = 1;
                    break;
            }
        }
        if ($ints_use) {
            $string .= $digits[rand(0, $digits_length)];
        }
        return $string;
    }
    
    private function strings_encrypt ($code) {
        // step1: encrypt string.
        // step2: move string.
        preg_match_all('/\"([0-9a-zA-Z\>\-\=\~\?\/\s\.\:\_\@\(\)\<\>\&\!\;\'\$\+\,\}\{\\\\]+)\"/', $code, $result);
        // doc: [0] - "string", [1] - string
        $code_stack = array();
        $top_stack = array();
        $indexer = 0;
        $used = array();
        foreach($result[1] as $one) {
            $full_string = $result[0][$indexer];
            if(in_array($full_string, $used)) {
                $indexer++;
                continue;
            }
            $split_string = str_split($one, 3);
            $result_string = array();
            foreach($split_string as $one_splitted) {
                $one_splitted = str_replace("\\", '\\\\', $one_splitted);
                $method = 2;
                switch($method) {
                    case 3:
                        $result_string[] = '"'.$one_splitted.'"';
                        break;
                    case 1:
                        $var_name = $this->intelectic_string(4, 5);
                        $one_array = $this->create_micro_array('"'.$one_splitted.'"', array('min'=> 8, 'max'=> 10));
                       // $code_stack[] = 'var '.$var_name.' = '.$one_array['code'].'; ';
                        $array = $this->create_micro_array($one_array['callback']);
                        $code_stack[] = 'var '.$var_name.' = '.$array['code'].'; ';
                        $top_var = $this->intelectic_string(4, 6);
                        $top_stack[] = 'var '.$top_var.' = '.$one_array['code'].';';
                        $result_string[] = $top_var.'['.$var_name.'['.$array['callback'].']]';
                        break;
                    case 0:
                        $var_name = $this->intelectic_string(4, 6);
                        $fcode = 'var '.$var_name.' = function () {
                        return "'.$one_splitted.'"'.';
                        }';
                        $code_stack[] = $fcode;
                        $result_string[] = $var_name;
                        break;

                    case 0:
                        $array = $this->create_micro_array('"'.$one_splitted.'"');
                        $var_name = $this->intelectic_string(4, 6);
                        $code_stack[] = 'var '.$var_name." = ".$array['code'].';';
                        $result_string[] = $var_name.'['.$array['callback'].']';
                        break;
                    case 3:
                        $var_name = $this->intelectic_string(4, 6);
                        $code_stack[] = 'var '.$var_name.' = "'.$one_splitted.'";';
                        $result_string[] = $var_name;
                        break;
                    case 2:
                        $function_name = $this->intelectic_string(4, 6);
                        $var_name = $this->intelectic_string(4, 6);
                        $callback_var_name = $this->intelectic_string(4, 6);

                        $tvar = $this->intelectic_string(4, 6);
                        $fcode = $function_name.' = function  ('.$callback_var_name.') {
                        '.$this->intelectic_string(4, 6).' = Math.PI;
                        '.$tvar.' = "'.$one_splitted.'";
                        '.$var_name.' = ['.$tvar.'];
                        return '.$var_name.'[0];
                        }';
                        $code_stack[] = $fcode;
                        $result_string[] = $function_name.'(NaN)';
                        break;
                }
            }

            $result_string = implode(' + ', $result_string);
            $code = str_replace($full_string, $result_string, $code);
            $used[] = $full_string;
            $indexer++;
        }
        shuffle($code_stack);
        shuffle($top_stack);
        $result = array(
            'code' => $code,
            'stack' => $code_stack,
            'top_stack' => $top_stack
        );
        return $result;
    }
    
    private function rename_variables ($code) {
        preg_match_all('/var[\s]([a-zA-Z\?_]+)/', $code, $result);
        foreach($result[1] as $one) {
            $new_name = $this->intelectic_string(4,8, rand(0,1));
            $code = str_replace($one, $new_name, $code);
        }
        return $code;
    }
    
    private function create_micro_array ($content, $count = false) {
        $last = substr($content, -1);
        $first = substr($content, 0, 1);
        $mini = substr($content, 1, -1);
        $content = str_replace("\\", '\\\\', $content);
        $array = '[';
        if($count) {
            $counter = rand($count['min'], $count['max']);
        }else{
            $counter = rand(5, 7);
        }
        $pos = rand(0, $counter-1);
        $lenghter = 0;
        $pos_name = '';
        $used = array();
        while(1) {
            if($lenghter == $counter) break;
            if(($lenghter+1) == $counter) {
                $com = '';
            }else{
                $com = ', ';
            }
            if($pos == $lenghter) {
                $array .= $content.''.$com;
                $pos_name = $lenghter;
            }else{
                $string = 'String';
                $array .= $string.$com;
            }
            $lenghter++;
        }
        $array .= "]";
        $result = array();
        $result['code'] = $array;
        $result['callback'] = $pos_name;
        return $result;
    }
    private function this_smooth_rechange ($code) {
        preg_match_all('/([a-z0-9]{3,16}\[([a-zA-Z0-9"]{1,8})\](?:\[[a-zA-Z"]+\]|))[\s]{0,10}\=/', $code, $result);
        // doc: [0] - match = , [1] - match only, [2] - match only "var"
        $indexer = 0;
        $used = array();
        foreach($result[1] as $one) {
            $method = 1;
            $var = str_replace('"', '', $result[2][$indexer]);
            switch($method) {
                case 1:
                    // change to variable
                    if(in_array($one, $used)) continue;
                    $var_name = $this->intelectic_string(5, 8, rand(1,2));
                    $code = str_replace($one, $var_name, $code);
                    $code = str_replace($var, $var_name, $code);
                    $used[] = $one;
                    break;
            }
            $indexer++;
        }
        return $code;
    }
    
    private function randomize_emulation_function ($code) {
        preg_match_all('/(new[\s]+Function(?:.*)\(\))/', $code, $result);
//        echo '<pre>';
//        var_dump($result); 
//        echo '</pre>';exit;
        foreach($result[0] as $function) {
            $array = $this->create_micro_array($function);
            $new_string = $array['code'].'['.$array['callback'].']';
            //$trash = $this->add_random_trash();
            $code = str_replace($function, $new_string, $code);
        }
        return $code;
    }

    public function cript($js) {
        $this->temp_stack = array();
        $this_top_stack = array();
        
        
        $js = $this->rename_variables($js);
        $js = $this->this_smooth_rechange($js);
        $code = $this->strings_encrypt($js);
        
        $strings_stack = $code['stack'];
        $strings_top_stack = $code['top_stack'];
        $code = $code['code'];
        $global_stack = array_merge($this->temp_stack, $strings_stack);
        $top_stack = array_merge($strings_top_stack, $this_top_stack);
        
        shuffle($global_stack);
        shuffle($top_stack);
        $global_stack = implode("\n", $global_stack);
        $top_stack = implode("\n", $top_stack);
        $result_code = $global_stack.$top_stack.";".$code;
        
        
        $result_code = $this->randomize_emulation_function($result_code);
        //$result_code = '<script language="JScript">' . $result_code . '</script>';
        return $result_code;
    }

}
