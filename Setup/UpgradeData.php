<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
 
namespace User\Contact\Setup;
 
use User\Contact\Model\Department;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
 
    protected $_department;
    protected $_job;
 
    public function __construct(Department $department){
        $this->_department = $department;
     }
 
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
 
        // Action to do if module version is less than 1.0.0.1
        if (version_compare($context->getVersion(), '1.0.5') < 0) {
            $departments = [
                [
                    'name' => 'Girish Darbar',
                    'email'=> 'girishdarbar7119@gmail.com',
                    'contact'=> '9989989898',
                    'description' => 'This is the nice'
                ],
                [
                    'name' => 'Jignesh Darbar',
                    'email'=> 'jr7119@gmail.com',
                    'contact'=> '9989989898',
                    'description' => 'This is the nice'
                ],
                [
                    'name' => 'Maynk Darbar',
                    'email'=> 'md7119@gmail.com',
                    'contact'=> '9989989898',
                    'description' => 'This is the nice'
                ],
                [
                    'name' => 'Rashmi Darbar',
                    'email'=> 'rb7119@gmail.com',
                    'contact'=> '9989989898',
                    'description' => 'This is the nice'
                ]
            ];
 
            /**
             * Insert departments
             */
            $departmentsIds = array();
            foreach ($departments as $data) {
                $department = $this->_department->setData($data)->save();
                $departmentsIds[] = $department->getId();
            }
 
 

        }
 
        $installer->endSetup();
    }
}