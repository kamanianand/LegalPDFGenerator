<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpWord\IOFactory;

class PdfGeneratorController extends Controller
{
    public function index()
    {
        $startTime = microtime(true);
        
        $emailThread = $this->simulateEmailThread();
        
        $pdf = Pdf::loadView('pdf.email_thread', ['emails' => $emailThread]);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isPhpEnabled', true);
        $pdf->setOption('isRemoteEnabled', true);
        
        $pdfPath = storage_path('app/generated_email_thread.pdf');
        $pdf->save($pdfPath);
        
        $fileSize = round(filesize($pdfPath) / (1024 * 1024), 2); // MB
        $executionTime = round(microtime(true) - $startTime, 2); // seconds
        
        return response()->json([
            'message' => 'PDF generated successfully!',
            'path' => $pdfPath,
            'file_size_mb' => $fileSize,
            'execution_time_seconds' => $executionTime,
            'memory_usage_mb' => round(memory_get_peak_usage(true) / (1024 * 1024), 2)
        ]);
    }
    
    private function simulateEmailThread()
    {
        $docxPath = storage_path('app/sample.docx');
        $content = $this->extractTextFromDocx($docxPath);
        
        $emails = [];
        $sender1 = 'user1@gmail.com';
        $sender2 = 'user2@gmail.com';
        
        for ($i = 0; $i < 25; $i++) {
            $emails[] = [
                'from' => $i % 2 === 0 ? $sender1 : $sender2,
                'to' => $i % 2 === 0 ? $sender2 : $sender1,
                'subject' => 'Re: Legal Document Discussion ' . ($i + 1),
                'date' => now()->subDays(25 - $i)->format('Y-m-d H:i:s'),
                'body' => $content . "\n\n[This is message " . ($i + 1) . " in the thread]"
            ];
        }
        
        return $emails;
    }
    
    private function extractTextFromDocx($filePath)
    {
        $phpWord = IOFactory::load($filePath);
        $content = '';
        
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getElements')) {
                    foreach ($element->getElements() as $childElement) {
                        if (method_exists($childElement, 'getText')) {
                            $content .= $childElement->getText() . "\n";
                        }
                    }
                } elseif (method_exists($element, 'getText')) {
                    $content .= $element->getText() . "\n";
                }
            }
        }
        
        return $content;
    }
}
