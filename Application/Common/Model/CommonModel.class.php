<?php
namespace Common\Model;
use Think\Model;
class CommonModel extends Model {

	// 获取当前用户的ID
    public function getMemberId() {
        return isset($_SESSION[C('USER_AUTH_KEY')])?$_SESSION[C('USER_AUTH_KEY')]:0;
    }

   /**
     +----------------------------------------------------------
     * 根据条件禁用表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function forbid($options,$field='status'){

        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

	 /**
     +----------------------------------------------------------
     * 根据条件批准表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */

    public function checkPass($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }


    /**
     +----------------------------------------------------------
     * 根据条件恢复表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function resume($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    /**
     +----------------------------------------------------------
     * 根据条件恢复表数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $options 条件
     +----------------------------------------------------------
     * @return boolen
     +----------------------------------------------------------
     */
    public function recycle($options,$field='status'){
        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    public function recommend($options,$field='is_recommend'){
        if(FALSE === $this->where($options)->setField($field,1)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }

    public function unrecommend($options,$field='is_recommend'){
        if(FALSE === $this->where($options)->setField($field,0)){
            $this->error =  L('_OPERATION_WRONG_');
            return false;
        }else {
            return True;
        }
    }
    

	
	
	
	
	
	
	//===============================自定义的==========================================================//
	/**
	 * 通过uid得到一条记录
	 * @param unknown_type $uid
	 */
	public function getOneByUid($uid){
		$r = $this->getList(array("uid"=>$uid));
		$this->standardizeData($r);
		//dump($r);
		return $r;
	}
	
	/**
	 * 标准化数据
	 * @param unknown_type $r
	 */
	protected function standardizeData(&$r){
			
		/*$r['pubtime'] = date('Y-m-d',$r['pubtime']);
		$r['ctime'] = date('Y-m-d',$r['ctime']);*/
	}
	
	
	public function getList($condition = array(),$num = 1){
		//得到1条,得到n条,得到有分页的列表
		if($num === 1){
			//
			$r =  $this->where($condition)->order('id desc')->find();
		}else{
			$r = $this->where($condition)->order('id desc')->limit($num)->select();
		}
		$this->standardizeData($r);
		return $r;
	}
	
	/**
	 * 得到信息的所有者
	 * @param $id 主键
	 */
	public function getOwner($id,$field="uid"){
		return  $this->where($this->getPk()."= $id")->getField($field);
		//return $this->field($field)->find($id); 
	}
	
	/**
	 * 得到拥有的信息
	 * @param $parentID
	 * @param $field
	 */
	public function getOwnInfo($parentID,$field="uid"){
		return $this->getList($field=$parentID)->select();
	}
	
	public function link($option){
		extract($option);
		
		if($table){
			preg_match("/[\w\d._]+\s*[as]*\s*(\w)/",$table,$arr);
			$tableAlias = $arr[1];
		}else{
			$tableAlias = $table = $this->getTableName();
		}
		//echo "$table -- $tableAlias <br />";
		$option['join'] = "";
		$field || $field = "*";
		$order || $order="$tableAlias.ctime";
		$sort || $sort = "desc";
		$num || $num = 5;
		
		
		$r = $this->table($table)->field($field)->join($join)->where($map)->order( $order .' '. $sort)->limit($num)->select();
		//职位sql:SELECT *, j.title as jtitle,c.title as ctitle FROM n_job j LEFT JOIN u_unit as c on c.uid=j.uid ORDER BY j.ctime desc LIMIT 10 
		//exit;
		//dump($r);
		return $r;
	}
	
}
?>