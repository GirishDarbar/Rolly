<?php
namespace User\Contact\Model\ResourceModel;
 
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
/**
 * Department post mysql resource
 */
class Department extends AbstractDb
{
 
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        // Table Name and Primary Key column
        $this->_init('all_contact', 'user_id');
    }
 
}