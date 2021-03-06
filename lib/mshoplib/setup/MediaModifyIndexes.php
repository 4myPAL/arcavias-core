<?php

/**
 * @copyright Copyright (c) Metaways Infosystems GmbH, 2012
 * @license LGPLv3, http://www.arcavias.com/en/license
 */


/**
 * Modifies indexes in the media tables.
 */
class MW_Setup_Task_MediaModifyIndexes extends MW_Setup_Task_Abstract
{
	private $_mysql = array(
		'add' => array(
			'mshop_media_list' => array (
				'fk_msmedli_pid' => 'ALTER TABLE "mshop_media_list" ADD INDEX "fk_msmedli_pid" ("parentid")',
				'unq_msmedli_sid_pid_dm_rid_tid' => 'ALTER TABLE "mshop_media_list" ADD UNIQUE INDEX "unq_msmedli_sid_pid_dm_rid_tid" ("siteid", "parentid", "domain", "refid", "typeid")',
			)
		),
		'delete' => array(
			'mshop_media_list' => array (
				'fk_msmedli_parentid' => 'ALTER TABLE "mshop_media_list" DROP INDEX "fk_msmedli_parentid"',
				'unq_msmedli_pid_sid_tid_rid_dm' => 'ALTER TABLE "mshop_media_list" DROP INDEX "unq_msmedli_pid_sid_tid_rid_dm"',
			)
		)
	);


	/**
	 * Returns the list of task names which this task depends on.
	 *
	 * @return array List of task names
	 */
	public function getPreDependencies()
	{
		return array();
	}


	/**
	 * Returns the list of task names which depends on this task.
	 *
	 * @return array List of task names
	 */
	public function getPostDependencies()
	{
		return array( 'TablesCreateMShop' );
	}


	/**
	 * Executes the task for MySQL databases.
	 */
	protected function _mysql()
	{
		$this->_process( $this->_mysql );
	}



	/**
	 * Adds and modifies indexes in the mshop_media tables.
	 *
	 * @param array $stmts List of SQL statements to execute for adding columns
	 */
	protected function _process( array $stmts )
	{
		$this->_msg( sprintf( 'Modifying indexes in mshop_media tables' ), 0 );
		$this->_status('');

		foreach( $stmts['add'] AS $table => $indexes )
		{
			foreach ( $indexes AS $index => $stmt )
			{
				$this->_msg(sprintf('Checking index "%1$s": ', $index), 1);

				if( $this->_schema->tableExists( $table ) === true
					&& $this->_schema->indexExists( $table, $index ) !== true )
				{
					$this->_execute( $stmt );
					$this->_status( 'added' );
				}
				else
				{
					$this->_status( 'OK' );
				}
			}
		}

		foreach( $stmts['delete'] AS $table => $indexes )
		{
			foreach ( $indexes AS $index => $stmt )
			{
				$this->_msg(sprintf('Checking index "%1$s": ', $index), 1);

				if( $this->_schema->tableExists( $table ) === true
					&& $this->_schema->indexExists( $table, $index ) === true )
				{
					$this->_execute( $stmt );
					$this->_status( 'dropped' );
				}
				else
				{
					$this->_status( 'OK' );
				}
			}
		}
	}


}