<?php
/*
 *
 * 
 */

namespace U0mo5\Tools\Debugs;

class Debug
{
    public static  function debug()
    {
        // register_shutdown_function(function(){ var_dump(error_get_last()); });
        register_shutdown_function(
            function () {
                //  print_r(error_get_last());
                $json=json_encode(error_get_last());
                echo "<pre>" . $json . "</pre>";
            }
        );
    }

    public static  function my_debug($arg, $label="", $line="")
    {
        $status="Off";
        if ($status!="On") {
            return;
        }

        if (is_array($arg)) {
            echo   "<pre><code>";
            echo $label."(行数：".$line.")"."<br>";
            echo json_encode($arg)."<br>";
            echo   "</code></pre>";
        } else {
            echo   "<pre><code>";
            echo $label."(行数：".$line.")"."<br>";
            echo $arg."<br>";
            echo   "</code></pre>";
        }
    }


    /**
     * 写日志，方便测试
     * log_out($var,"获取消息id",__LINE__,__CLASS__);
     */
    public static  function log_out($var='', $title="", $line="", $file="api")
    {
//        $this->status="Off";
        if (!$GLOBALS['DEBUG_STATUS']) {
            return;
        }
        if (is_array($var)) {
            $var=json_encode($var, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        } elseif (is_object($var)) {
            $var=json_encode($var, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        } elseif (is_resource($var)) {
            $var=(string)$var;
        } else {
            $var=json_encode($var, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        }

        $fp = fopen("{$file}_debug.html", "a");
        flock($fp, LOCK_EX) ;
        fwrite($fp, " "."\n"."<pre><font color='red'>执行日期：".strftime("%Y%m%d%H%M%S", time())."</font>\n"."<font color='blue'>".$title."（行号： ".$line."）"."</font>\n"." <code>".$var."\n"."</code></pre>"."\n");
        flock($fp, LOCK_UN);
        fclose($fp);
    }


    //console.log
//
    //echo ($data);
    public static  function console_log($data)
    {
        if (is_array($data) || is_object($data)) {
            echo("<script>console.log('".json_encode($data)."');</script>");
        } else {
            echo("<script>console.log('".$data."');</script>");
        }
    }

    /**
     * 输出到页面控制台
     *  *bug:发现会影响页面样式
     * @param $data
     */
    public static  function console_debug($val)
    {
        $debug = debug_backtrace();
        unset($debug[0]['args']);
        echo '<div  style="display:none;"><script> try{',
        'console.debug('. json_encode(str_repeat("~~~", 40)). ');',
        'console.debug('. json_encode($debug[0]). ');',
        'console.debug('. json_encode($val). ');',
        'console.debug('. json_encode(str_repeat("~~~", 40)). ');',
    '}catch(e){}</script></div>';
    }

    /**
     * 调试输出变量，对象的值。
     * 参数任意个(任意类型的变量)
     * @return echo
     */
    public static  function debug_out()
    {
        $avg_num = func_num_args();
        $avg_list = func_get_args();
        ob_start();
        for ($i = 0; $i < $avg_num; $i++) {
            pr($avg_list[$i]);
        }
        $out = ob_get_clean();
        echo $out;
        return;
    }


    // -----------------变量调试-------------------
    /**
     * 格式化输出变量，或者对象
     *
     * @param mixed $var
     * @param boolean $exit
     */
    public static  function pr($var, $exit = false)
    {
        ob_start();
        $style = '<style>
	pre#debug{margin:10px;font-size:14px;color:#222;font-family:Consolas ;line-height:1.2em;background:#f6f6f6;border-left:5px solid #444;padding:5px;width:95%;word-break:break-all;}
	pre#debug b{font-weight:400;}
	#debug #debug_str{color:#E75B22;}
	#debug #debug_keywords{font-weight:800;color:00f;}
	#debug #debug_tag1{color:#22f;}
	#debug #debug_tag2{color:#f33;font-weight:800;}
	#debug #debug_var{color:#33f;}
	#debug #debug_var_str{color:#f00;}
	#debug #debug_set{color:#0C9CAE;}</style>';
        if (is_array($var)) {
            print_r($var);
        } elseif (is_object($var)) {
            echo get_class($var) . " Object";
        } elseif (is_resource($var)) {
            echo (string)$var;
        } else {
            echo var_dump($var);
        }
        $out = ob_get_clean(); //缓冲输出给$out 变量
    $out = preg_replace('/"(.*)"/', '<b id="debug_var_str">"' . '\\1' . '"</b>', $out); //高亮字符串变量
    $out = preg_replace('/=\>(.*)/', '=>' . '<b id="debug_str">' . '\\1' . '</b>', $out); //高亮=>后面的值
    $out = preg_replace('/\[(.*)\]/', '<b id="debug_tag1">[</b><b id="debug_var">' . '\\1' . '</b><b id="debug_tag1">]</b>', $out); //高亮变量
    $from = array('    ', '(', ')', '=>');
        $to = array('  ', '<b id="debug_tag2">(</i>', '<b id="debug_tag2">)</b>', '<b id="debug_set">=></b>');
        $out = str_replace($from, $to, $out);

        $keywords = array('Array', 'int', 'string', 'class', 'object', 'null'); //关键字高亮
        $keywords_to = $keywords;
        foreach ($keywords as $key => $val) {
            $keywords_to[$key] = '<b id="debug_keywords">' . $val . '</b>';
        }
        $out = str_replace($keywords, $keywords_to, $out);
        $out = str_replace("\n\n", "\n", $out);
        echo $style . '<pre id="debug"><b id="debug_keywords">' . get_var_name($var) . '</b> = ' . $out . '</pre>';
        if ($exit) {
            exit;
        } //为真则退出
    }

    /**
     * 获取变量的名字
     * eg hello="123" 获取ss字符串
     */
    public static  function get_var_name(&$aVar)
    {
        foreach ($GLOBALS as $key => $var) {
            if ($aVar == $GLOBALS[$key] && $key != "argc") {
                return $key;
            }
        }
    }
}