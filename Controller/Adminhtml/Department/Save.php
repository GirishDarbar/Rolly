<?php
namespace User\Contact\Controller\Adminhtml\Department;
 
use Magento\Backend\App\Action;
 
class Save extends Action
{
    /**
     * @var \User\Contact\Model\Department
     */
    protected $_model;
 
    /**
     * @param Action\Context $context
     * @param \User\Contact\Model\Department $model
     */
    public function __construct(
        Action\Context $context,
        \User\Contact\Model\Department $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }
 
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('User_Contact::department_save');
    }
 
    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            /** @var \User\Contact\Model\Department $model */

            // print_r($data);
            $model = $this->_model;
 
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
            }
 
            $model->setData($data);
 
            $this->_eventManager->dispatch(
                'contact_department_prepare_save',
                ['deparment' => $model, 'request' => $this->getRequest()]
            );
 
            try {
                $model->save();
                $this->messageManager->addSuccess(__('Contact saved'));
                $this->_getSession()->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the department'));
            }
 
            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['user_id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}