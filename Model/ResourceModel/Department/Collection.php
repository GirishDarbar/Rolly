<?php
namespace User\Contact\Model\ResourceModel\Department;
 
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
 
    protected $_idFieldName = \User\Contact\Model\Department::DEPARTMENT_ID;
     
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('User\Contact\Model\Department', 'User\Contact\Model\ResourceModel\Department');
    }
 
}