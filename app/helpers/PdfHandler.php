<?php

namespace helpers;

use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\Options;

class PdfHandler
{

    protected $dompdf;
    protected $options;
    protected $filename;
    protected $html;

    public function __construct()
    {
        $this->options = new Options();
        $this->options->setChroot(URLROOT);
        $this->options->setIsRemoteEnabled(true);
        $this->dompdf = new Dompdf($this->options);
    }

    public function companyRegistrations($allCompanies, $count, $yearLabel, $templatePath, $currentDateTime)
    {
        ob_start();
        require $templatePath;
        $html = ob_get_contents();
        ob_get_clean();

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream('company-registrations.pdf', ['Attachment' => false]);
    }


    public function adsByBatchYear($advertisementList, $count, $yearLabel, $templatePath, $currentDateTime)
    {
        ob_start();
        require $templatePath;
        $html = ob_get_contents();
        ob_get_clean();

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream('advertisementslist.pdf', ['Attachment' => false]);
    }


    public function studentRegistrations($studentList, $count, $templatePath, $currentDateTime, $year)
    {
        ob_start();
        require $templatePath;
        $html = ob_get_contents();
        ob_get_clean();

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream('student-registrations.pdf', ['Attachment' => false]);
    }

    
    public function studentRoundReport($studentList, $studentRequestsCount, $studentRequestsRecruitedCount ,$templatePath, $currentDateTime, $batchYear, $stream, $round)
    {
        ob_start();
        require $templatePath;
        $html = ob_get_contents();
        ob_get_clean();

        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
        $this->dompdf->stream('company-registrations.pdf', ['Attachment' => false]);
    }

}
