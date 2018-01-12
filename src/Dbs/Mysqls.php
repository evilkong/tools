<?php
/*!
**
 * make sql
 */

namespace U0mo5\Tools\Dbs;

/**
 * Class Mysqls
 * @package U0mo5\Tools\Dbs
 *
 *
 *     "db" => array(
"host" => "127.0.0.1", // 地址
"port" => 3306,        // 端口
"user" => "root",      // 用户名
"pass" => "",          // 密码
"name" => "bookmark" // 数据库名称
),
 *
 * mysqls::add_db(config::get("db"));
 */


// mysql数据库操作类
class Mysqls {
    // 数据库连接配置
    protected static $_config = array();
    // 数据库连接资源
    protected static $_instance = array();
    // 查询错误信息
    protected static $_error = "";
    // 查询语句
    protected static $_sql = "";
    // 查询开始时间
    protected static $_start_time = "0 0";
    // 查询结束时间
    protected static $_finish_time = "0 0";
    // 查询日志回掉函数
    public static $log_callback = "";
    // 添加数据库
    public static function add_db($config) {
        if(!is_array($config) || empty($config)) {
            return false;
        }
        $first = reset($config);
        if(!is_array($first)) {
            $config = array($config);
        }
        foreach($config as $v) {
            $db_id = isset($v["id"]) ? $v["id"] : 0;
            $data["host"] = isset($v["host"]) ? $v["host"] : "127.0.0.1";
            $data["port"] = isset($v["port"]) ? $v["port"] : "3306";
            $data["user"] = isset($v["user"]) ? $v["user"] : "root";
            $data["pass"] = isset($v["pass"]) ? $v["pass"] : "";
            $data["name"] = isset($v["name"]) ? $v["name"] : "";
            $data["charset"] = isset($v["charset"]) ? $v["charset"] : "utf8";
            self::remove_db($db_id);
            self::$_config[$db_id] = $data;
        }
        return true;
    }
    // 删除数据库
    public static function remove_db($db_id) {
        if(isset(self::$_config[$db_id])) unset(self::$_config[$db_id]);
        if(isset(self::$_instance[$db_id])) unset(self::$_instance[$db_id]);
    }
    // sql语句查询
    public static function query($sql, $db_id = 0) {
        self::$_sql = $sql;
        if(!self::_init_db($db_id)) {
            return false;
        }
        $handle = self::$_instance[$db_id];
        self::$_start_time = microtime();
        $result = mysql_query($sql, $handle);
        self::$_finish_time = microtime();
        if(!$result) {
            self::$_error = mysql_error($handle);
            return false;
        }
        // 记录日志
        if(is_callable(self::$log_callback)) {
            call_user_func(self::$log_callback, self::get_query_info());
        }
        // 如果想自行处理结果集,可以在sql语句前添加空格(" ")
        if(preg_match('/^insert/is', $sql)) {
            $ret = (int)mysql_insert_id($handle);
            if(!$ret) $ret = (int)mysql_affected_rows($handle);
            return $ret;
        }
        if(preg_match('/^(update|delete)/is', $sql)) {
            return (int)mysql_affected_rows($handle);
        }
        if(preg_match('/^(select|show)/is', $sql)) {
            $ret = array();
            while($row = mysql_fetch_assoc($result)) $ret[] = $row;
            return $ret;
        }
        return $result;
    }
    // 初始化数据库
    protected static function _init_db($db_id) {
        if(!isset(self::$_config[$db_id])) {
            self::$_error = "无此数据库配置信息";
            return false;
        }
        if(isset(self::$_instance[$db_id])) return true;
        $p = self::$_config[$db_id];
        $handle = mysql_connect($p["host"].":".$p["port"], $p["user"], $p["pass"], true);
        if(!$handle) {
            self::$_error = "连接数据库失败";
            return false;
        }
        if(!mysql_select_db($p["name"], $handle)) {
            self::$_error = mysql_error($handle);
            return false;
        }
        mysql_query("set names ".$p["charset"]);
        self::$_instance[$db_id] = $handle;
        return true;
    }
    // 获取查询信息
    public static function get_query_info() {
        $data["sql"] = self::$_sql;
        $data["error"] = self::$_error;
        $st = explode(" ", self::$_start_time);
        $ft = explode(" ", self::$_finish_time);
        $data["query_time"] = $ft[0] + $ft[1] - $st[0] - $st[1];
        $data["query_time"] = number_format($data["query_time"], 4, ".", "");
        return $data;
    }
}