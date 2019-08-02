<?php


namespace Netzexpert\CustomPdf\Model\Order\Pdf;

class CommonPdf
{
    /**
     * @param \Zend_Pdf_Page $page
     * @param \Zend_Pdf_Font $font
     */
    public function insertFooter (&$page)
    {
        $page->setFillColor(new \Zend_Pdf_Color_GrayScale(0.55));
        $page->setLineColor(new \Zend_Pdf_Color_GrayScale(0.55));
        $page->drawLine(25,60,570,60);
        $page->setFont(new \Zend_Pdf_Resource_Font_Simple_Standard_Helvetica(), 8);

        $page->drawText('Oberkersch GmbH', 25, 45, 'UTF-8');
        $page->drawText('Zeißstraße 2', 25, 35, 'UTF-8');
        $page->drawText('37327 Leinefelde-Worbis', 25, 25, 'UTF-8');

        $page->drawText('Telefon:', 145, 45, 'UTF-8');
        $page->drawText('Fax:', 145, 35, 'UTF-8');
        $page->drawText('Mail:', 145, 25, 'UTF-8');
        $page->drawText('Web:', 145, 15, 'UTF-8');

        $page->drawText('+4936055474874', 185, 45, 'UTF-8');
        $page->drawText('+4936055474875', 185, 35, 'UTF-8');
        $page->drawText('info@oberkersch.com', 185, 25, 'UTF-8');
        $page->drawText('https://troas.de', 185, 15, 'UTF-8');

        $page->drawText('StNr.:', 295, 45, 'UTF-8');
        $page->drawText('UStNr.:', 295, 35, 'UTF-8');
        $page->drawText('Reg.Nr.:', 295, 25, 'UTF-8');

        $page->drawText('157/254/05690', 335, 45, 'UTF-8');
        $page->drawText('DE 212694423', 335, 35, 'UTF-8');
        $page->drawText('HRB 508696', 335, 25, 'UTF-8');
        $page->drawText('Amtsgericht Jena', 335, 15, 'UTF-8');

        $page->drawText('Commerzbank', 420, 45, 'UTF-8');
        $page->drawText('IBAN DE52 8204 0000 0488 8038 00', 420, 35, 'UTF-8');
        $page->drawText('BIC COBADEFFXXX', 420, 25, 'UTF-8');

    }
}