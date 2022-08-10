<?php

/**
 * ��ʼ�� pdo ����ʵ��
 * 
 * @return object->PDO
 */
function pdo($slave = false) {
	global $_W;
	static $db;
	if(empty($db)) {
		$db = new DB($_W['config']['db']);
	}
	return $db;
}

/**
 * ִ��һ���ǲ�ѯ���
 *
 * @param string $sql        	
 * @param
 *        	array or string $params
 * @return mixed �ɹ�������Ӱ�������
 *         ʧ�ܷ���FALSE
 */
function pdo_query($sql, $params = array()) {
	$sql_trace = debug_backtrace();
	if(isset($sql_trace[0])) {
		$sql = '/*'.$sql_trace[0]['file'].'('.$sql_trace[0]['line'].')*/'.$sql;
	}

	return pdo()->query($sql, $params);
}

/**
 * ִ��SQL���ص�һ���ֶ�
 *
 * @param string $sql        	
 * @param array $params        	
 * @param int $column
 *        	���ز�ѯ�����ĳ�У�Ĭ��Ϊ��һ��
 * @return mixed
 */
function pdo_fetchcolumn($sql, $params = array(), $column = 0, $slave = false) {
	$sql_trace = debug_backtrace();
	if(isset($sql_trace[0])) {
		$sql = '/*'.$sql_trace[0]['file'].'('.$sql_trace[0]['line'].')*/'.$sql;
	}

	return pdo($slave)->fetchcolumn($sql, $params, $column);
}

/**
 * ִ��SQL���ص�һ��
 *
 * @param string $sql        	
 * @param array $params        	
 * @return mixed
 */
function pdo_fetch($sql, $params = array(), $slave = false) {
	$sql_trace = debug_backtrace();
	if(isset($sql_trace[0])) {
		$sql = '/*'.$sql_trace[0]['file'].'('.$sql_trace[0]['line'].')*/'.$sql;
	}

	return pdo($slave)->fetch($sql, $params);
}

/**
 * ִ��SQL����ȫ����¼
 *
 * @param string $sql        	
 * @param array $params        	
 * @return mixed
 */
function pdo_fetchall($sql, $params = array(), $keyfield = '', $slave = false) {
	$sql_trace = debug_backtrace();
	if(isset($sql_trace[0])) {
		$sql = '/*'.$sql_trace[0]['file'].'('.$sql_trace[0]['line'].')*/'.$sql;
	}

	return pdo($slave)->fetchall($sql, $params, $keyfield);
}

/**
 * ���¼�¼
 *
 * @param string $table        	
 * @param array $data
 *        	Ҫ���µ���������
 *        	array(
 *        	'�ֶ���' => 'ֵ'
 *        	)
 * @param array $params
 *        	��������
 *        	array(
 *        	'�ֶ���' => 'ֵ'
 *        	)
 * @param string $glue
 *        	����ΪAND OR
 * @return mixed
 */
function pdo_update($table, $data = array(), $params = array(), $glue = 'AND') {
	return pdo()->update($table, $data, $params, $glue);
}

/**
 * ���¼�¼
 *
 * @param string $table        	
 * @param array $data
 *        	Ҫ���µ���������
 *        	array(
 *        	'�ֶ���' => 'ֵ'
 *        	)
 * @param boolean $replace
 *        	�Ƿ�ִ��REPLACE INTO
 *        	Ĭ��ΪFALSE
 * @return mixed
 */
function pdo_insert($table, $data = array(), $replace = FALSE) {
	return pdo()->insert($table, $data, $replace);
}

/**
 * ɾ����¼
 *
 * @param string $table        	
 * @param array $params
 *        	��������
 *        	array(
 *        	'�ֶ���' => 'ֵ'
 *        	)
 * @param string $glue
 *        	����ΪAND OR
 * @return mixed
 */
function pdo_delete($table, $params = array(), $glue = 'AND') {
	return pdo()->delete($table, $params, $glue);
}

/**
 * ����lastInsertId
 */
function pdo_insertid() {
	return pdo()->insertid();
}

function pdo_begin() {
	pdo()->begin();
}

function pdo_commit() {
	pdo()->commit();
}

function pdo_rollback() {
	pdo()->rollBack();
}

/**
 * ��ȡpdo����������Ϣ�б�
 * 
 * @param bool $output
 *        	�Ƿ�Ҫ���ִ�м�¼��ִ�д�����Ϣ
 * @param array $append
 *        	����ִ����Ϣ������˲�����Ϊ���� $output ����Ϊ false
 * @return array
 */
function pdo_debug($output = true, $append = array()) {
	return pdo()->debug($output, $append);
}

/**
 * ִ��SQL�ļ�
 */
function pdo_run($sql) {
	return pdo()->run($sql);
}

function pdo_fieldexists($tablename, $fieldname = '') {
	return pdo()->fieldexists($tablename, $fieldname);
}

function pdo_indexexists($tablename, $indexname = '') {
	return pdo()->indexexists($tablename, $indexname);
}

/**
 * ��ȡ�����ֶ�,���ڹ����ֶ�
 * 
 * @param string $tablename
 *        	ԭʼ����
 * @return array ���б��� array('col1','col2');
 */
function pdo_fetchallfields($tablename) {
	$fields = pdo_fetchall("DESCRIBE {$tablename}", array(), 'Field');
	$fields = array_keys($fields);
	return $fields;
}

//�����ж�commit or rollback
function pdo_getbug() {
	return pdo()->getbug();
}
