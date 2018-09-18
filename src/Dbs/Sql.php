<?php
/*!
**
 * make sql
 */

namespace U0mo5\Tools\Dbs;

class Sql
{

    /*
*make sql
*/


    /**
     * 创建像这样的查询: "IN('a','b')";
     *
     * @access   public
     * @param    mix      $item_list      列表数组或字符串
     * @param    string   $field_name     字段名称
     *
     * @return   void
     */
    public static  function db_create_in($item_list, $field_name = '')
    {
        if (empty($item_list)) {
            return $field_name . " IN ('') ";
        } else {
            if (!is_array($item_list)) {
                $item_list = explode(',', $item_list);
            }
            $item_list = array_unique($item_list);
            $item_list_tmp = '';
            foreach ($item_list as $item) {
                if ($item !== '') {
                    $item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'";
                }
            }
            if (empty($item_list_tmp)) {
                return $field_name . " IN ('') ";
            } else {
                return $field_name . ' IN (' . $item_list_tmp . ') ';
            }
        }
    }
 
 
    /**
     *
     *阻止 SQL 注入 SQL 注入 或者 SQLi 常见的攻击网站的手段，使用下面的代码可以帮助你防止这些工具。
     *
     * @param $input
     * @return string
     * //$text = "<script>alert(1)</script>";
     * //$text = clean($text);
     *  //echo $text;
     */
 
    public static  function cleanSQL($input)
    {
        if (is_array($input)) {
            foreach ($input as $key => $val) {
                $output[$key] = cleanSQL($val);
                // $output[$key] = $this->clean($val);
            }
        } else {
            $output = (string) $input;
            // if magic quotes is on then use strip slashes
            if (get_magic_quotes_gpc()) {
                $output = stripslashes($output);
            }
            // $output = strip_tags($output);
            $output = htmlentities($output, ENT_QUOTES, 'UTF-8');
        }
        // return the clean text
        return $output;
    }
 
    /**
     * 单条row数组转化成sql
     * @param $array
     * @param string $type
     * @param array $exclude
     * @param string $table
     * @param string $ext
     * @return string
     */
    public static  function array_to_sql($array, $type='insert', $exclude = array(), $table="", $ext="")
    {
        $sql = '';
        if (count($array) > 0) {
            foreach ($exclude as $exkey) {
                unset($array[$exkey]);//剔除不要的key
            }
 
            if ('insert' == $type) {
                $keys = array_keys($array);
                $values = array_values($array);
                $col = implode("`, `", $keys);
                $val = implode("', '", $values);
                $sql= "(`$col`) values('$val')";
            } elseif ('update' == $type) {
                $tempsql = '';
                $temparr = array();
                foreach ($array as $key => $value) {
                    $tempsql = "'$key' = '$value'";
                    $temparr[] = $tempsql;
                }
 
                $sql = implode(",", $temparr);
            } elseif ('insert_update' == $type) {
                $keys = array_keys($array);
                $values = array_values($array);
                $col = implode("`, `", $keys);
                $val = implode("', '", $values);
                $tempsql = '';
                $temparr = array();
                foreach ($array as $key => $value) {
                    $tempsql = "$key = VALUES($key)";
                    $temparr[] = $tempsql;
                }
                $ups = implode(",", $temparr);
                $sql= "insert into  $table  (`$col`) values('$val') "." ON DUPLICATE KEY  UPDATE $ext   $ups ;";
            }
        }
        return $sql;
    }
 
    /**
     * todo  toTest
     * @param $arrays
     * @param array $exclude
     * @param string $table
     * @param string $ext
     * @return string
     */
    public static  function batch_insert_sql($arrays, $exclude = array(), $table="table", $ext="")
    {
        $sql = '';
        if (count($arrays) > 0) {
            foreach ($exclude as $exkey) {
                unset($arrays[$exkey]);//剔除不要的key
            }
            $keys = array_keys($arrays[0]);
            $col = implode("`, `", $keys);
            $sql .="insert into {$table} (`$col`) values ";
            foreach ($arrays as $array) {
                $values = array_values($array);
                $val = implode("', '", $values);
                $sql.= " ('$val'), ";
            }
        }
        return $sql;
    }
}
