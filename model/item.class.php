<?php
/**
 * 基础数据item类
 */
class item {
	protected $m_key;
    protected $m_value;//属性名
    protected $m_bCanModify;//是否可被更改
    protected $m_dataType;//数据类型

    /**
     * @return mixed
     */
    public function getMKey()
    {
        return $this->m_key;
    }

    /**
     * @param mixed $m_key
     */
    public function setMKey($m_key)
    {
        $this->m_key = $m_key;
    }

    /**
     * @return mixed
     */
    public function getMValue()
    {
        return $this->m_value;
    }

    /**
     * @param mixed $m_value
     */
    public function setMValue($m_value)
    {
        $this->m_value = $m_value;
    }

    /**
     * @return mixed
     */
    public function getMBCanModify()
    {
        return $this->m_bCanModify;
    }

    /**
     * @param mixed $m_bCanModify
     */
    public function setMBCanModify($m_bCanModify)
    {
        $this->m_bCanModify = $m_bCanModify;
    }

    /**
     * @return mixed
     */
    public function getMDataType()
    {
        return $this->m_dataType;
    }

    /**
     * @param mixed $m_dataType
     */
    public function setMDataType($m_dataType)
    {
        $this->m_dataType = $m_dataType;
    } //属性名


	public function __construct(){

	}

}
