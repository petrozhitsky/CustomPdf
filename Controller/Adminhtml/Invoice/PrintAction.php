<?php


namespace Netzexpert\CustomPdf\Controller\Adminhtml\Invoice;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Sales\Api\InvoiceRepositoryInterface;
use Magento\Sales\Model\Order\Pdf\Invoice;

class PrintAction extends \Magento\Sales\Controller\Adminhtml\Invoice\AbstractInvoice\PrintAction
{
    /**
     * @var Invoice
     */
    private $pdfInvoice;
    /**
     * @var InvoiceRepositoryInterface
     */
    private $invoiceRepository;
    /**
     * @var DateTime
     */
    private $dateTime;

    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        ForwardFactory $resultForwardFactory,
        InvoiceRepositoryInterface $invoiceRepository,
        Invoice $invoice,
        DateTime $dateTime
    )
    {
        $this->invoiceRepository = $invoiceRepository;
        $this->pdfInvoice        = $invoice;
        $this->dateTime          = $dateTime;

        parent::__construct($context, $fileFactory, $resultForwardFactory);
    }

    /**
     * @return ResponseInterface|void
     * @throws \Exception
     */
    public function execute()
    {
        $invoiceId = $this->getRequest()->getParam('invoice_id');
        if ($invoiceId) {
            $invoice = $this->invoiceRepository->get($invoiceId);
            if ($invoice) {
                $pdf = $this->pdfInvoice->getPdf([$invoice]);
                $date = $this->dateTime->date('Y-m-d_H-i-s');
                $fileContent = ['type' => 'string', 'value' => $pdf->render(), 'rm' => true];

                return $this->_fileFactory->create(
                    'invoice' . $date . '.pdf',
                    $fileContent,
                    DirectoryList::VAR_DIR,
                    'application/pdf'
                );
            }
        } else {
            return $this->resultForwardFactory->create()->forward('noroute');
        }
    }
}