<?php
namespace U0mo5\Tools\Validates;
/**
 * Validator 数据验证类
 * @package library
 * @category library
 * @author  Steven
 * @version 1.0
 */

/**
 * Validator 数据验证类
 * @package library
 * @category library
 * @author  Steven
 * @version 1.0
 */
class Validator {

	/**
	 * 待校验数据
	 * @var array
	 */
	private $_data;

	/**
	 * 校验规则
	 * @var array
	 */
	private $_ruleList = null;

	/**
	 * 校验结果
	 * @var bool
	 */
	private $_result = null;

	/**
	 * 校验数据信息
	 * @var array
	 */
	private $_resultInfo = array();

	/**
	 * 构造函数
	 * @param array $data 待校验数据
	 */
	public function __construct($data = null)
	{
		if ($data) {
			$this->_data = $data;
		}
	}

	/**
	 * 设置校验规则
	 * @param string $var  带校验项key
	 * @param mixed  $rule 校验规则
	 * @return void
	 */
	public function setRule($var, $rule)
	{
		$this->_ruleList[$var] = $rule;
	}

	/**
	 * 检验数据
	 * @param  array $data 
	 * <code>
	 * 	$data = array('nickname' => 'heno' , 'realname' => 'steven', 'age' => 25);
	 * 	$validator = new Validator($data);
	 * 	$validator->setRule('nickname', 'required');
	 * 	$validator->setRule('realname', array('lenght' => array(1,4), 'required'));
	 * 	$validator->setRule('age', array('required', 'digit'));
	 * 	$result = $validator->validate();
	 * 	var_dump($validator->getResultInfo());
	 * </code>
	 * @return bool
	 */
	public function validate($data = null)
	{
		$result = true;

		/* 如果没有设置校验规则直接返回 true */
		if ($this->_ruleList === null || !count($this->_ruleList)) {
			return $result;
		}

		/* 已经设置规则，则对规则逐条进行校验 */
		foreach ($this->_ruleList as $ruleKey => $ruleItem) {

			/* 如果检验规则为单条规则 */
			if (!is_array($ruleItem)) {
				$ruleItem = trim($ruleItem);
				if (method_exists($this, $ruleItem)) {

					/* 校验数据，保存校验结果 */
					$tmpResult = $this->$ruleItem($ruleKey);
					if (!$tmpResult) {
						$this->_resultInfo[$ruleKey][$ruleItem] = $tmpResult;
						$result = false;
					}
				}
				continue;
			}

			/* 校验规则为多条 */
			foreach ($ruleItem  as $ruleItemKey => $rule) {

				if (!is_array($rule)) {
					$rule = trim($rule);
					if (method_exists($this, $rule)) {

						/* 校验数据，设置结果集 */
						$tmpResult = $this->$rule($ruleKey);
						if (!$tmpResult) {
							$this->_resultInfo[$ruleKey][$rule] = $tmpResult;
							$result = false;
						}
					}
				} else {
					if (method_exists($this, $ruleItemKey)) {
						
						/* 校验数据，设置结果集 */
						$tmpResult = $this->$ruleItemKey($ruleKey, $rule);
						if (!$tmpResult) {
							$this->_resultInfo[$ruleKey][$ruleItemKey] = $tmpResult;
							$result = false;
						}
					}
				}
			}
		}

		return $result;
	}

	/**
	 * 获取校验结果数据
	 * @return [type] [description]
	 */
	public function getResultInfo()
	{
		return $this->_resultInfo;
	}

	/**
	 * 校验必填参数
	 * @param  string $varName 校验项
	 * @return bool
	 */
	public function required($varName) 
	{
		$result = false;
		if (is_array($this->_data) && isset($this->_data[$varName])) {
			$result = true;
		}
		return $result;
	}


	/**
	 * 校验参数长度
	 * 
	 * @param  string $varName 校验项
	 * @param  array $lengthData  array($minLen, $maxLen)
	 * @return bool
	 */
	public function length($varName, $lengthData)
	{
		$result = true;

		/* 如果该项没有设置，默认为校验通过 */
		if ($this->required($varName)) {
			$varLen = mb_strlen($this->_data[$varName]);
			$minLen = $lengthData[0];
			$maxLen = $lengthData[1];
			if ($varLen < $minLen || $varLen > $maxLen) {
				$result = true;
			}
		}
		return $result;
	}


	/**
	 * 校验邮件
	 * @param  string $varName 校验项
	 * @return bool
	 */
	public function email($varName)
	{
		$result = true;

		/* 如果该项没有设置，默认为校验通过 */
		if ($this->required($varName)) {
			$email = trim($this->_data[$varName]);
			if (preg_match('/^[-\w]+?@[-\w.]+?$/', $email)) {
				$result = false;
			}
		}
		return $result;
	}

	/**
	 * 校验手机
	 * @param  string $varName 校验项
	 * @return bool
	 */
	public function mobile($varName)
	{
		$result = true;

		/* 如果该项没有设置，默认为校验通过 */
		if ($this->required($varName)) {
			$mobile = trim($this->_data[$varName]);
			if (!preg_match('/^1[3458]\d{10}$/', $mobile)) {
				$result = false;
			}
		}

		return $result;
	}

	/**
	 * 校验参数为数字
	 * @param  string $varName 校验项
	 * @return bool
	 */
	public function digit($varName)
	{
		$result = false;
		if ($this->required($varName) && is_numeric($this->_data[$varName])) {
			$result = true;
		}
		return $result;
	}


	/**
	 * 校验参数为身份证
	 * @param  string $varName 校验项
	 * @return bool
	 */
	public function ID($ID)
	{

	}


	/**
	 * 校验参数为URL
	 * @param  string $varName 校验项
	 * @return bool
	 */
	public function url($url)
	{
		$result = true;

		/* 如果该项没有设置，默认为校验通过 */
		if ($this->required($varName)) {
			$url = trim($this->_data[$varName]);
			if(!preg_match('/^(http[s]?::)?\w+?(\.\w+?)$/', $url)) {
				$result = false;
			}
		}
		return $result;
	}


// 验证是否为空
    public function nullstr($str){
        if(trim($str) != "") return true;
        return false;
    }

// 验证邮件格式
    public function match_email($str){
        if(preg_match("/^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/", $str)) return true;
        else return false;
    }

    public function is_email($email)
    {
        $check = 0;
        if(filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $check = 1;
        }
        return $check;
    }


// 验证身份证
    public function idcode($str){
        if(preg_match("/^\d{14}(\d{1}|\d{4}|(\d{3}[xX]))$/", $str)) return true;
        else return false;
    }

// 验证http地址
    public function http($str){
        if(preg_match("/[a-zA-Z]+:\/\/[^\s]*/", $str)) return true;
        else return false;
    }

//匹配QQ号(QQ号从10000开始)
    public function qq($str){
        if(preg_match("/^[1-9][0-9]{4,}$/", $str)) return true;
        else return false;
    }

//匹配中国邮政编码
    public function postcode($str){
        if(preg_match("/^[1-9]\d{5}$/", $str)) return true;
        else return false;
    }

//匹配ip地址
    public function ip($str){
        if(preg_match("/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/", $str)) return true;
        else return false;
    }

// 匹配电话格式
    public function telephone($str){
        if(preg_match("/^\d{3}-\d{8}$|^\d{4}-\d{7}$/", $str)) return true;
        else return false;
    }

// 匹配手机格式
    public function is_mobile($str){
        if(preg_match("/^(13[0-9]|15[0-9]|18[0-9])\d{8}$/", $str)) return true;
        else return false;
    }

// 匹配26个英文字母
    public function en_word($str){
        if(preg_match("/^[A-Za-z]+$/", $str)) return true;
        else return false;
    }

// 匹配只有中文
    public function cn_word($str){
        if(preg_match("/^[\x80-\xff]+$/", $str)) return true;
        else return false;
    }

// 验证账户(字母开头，由字母数字下划线组成，4-20字节)
    public function user_account($str){
        if(preg_match("/^[a-zA-Z][a-zA-Z0-9_]{3,19}$/", $str)) return true;
        else return false;
    }

// 验证数字
    public function number($str){
        if(preg_match("/^[0-9]+$/", $str)) return true;
        else return false;
    }



}
?>
