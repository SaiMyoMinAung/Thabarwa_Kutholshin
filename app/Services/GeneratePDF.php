<?php

namespace App\Services;

use Mpdf\Mpdf;
use Mpdf\MpdfException;
use Illuminate\Support\Facades\Log;

class GeneratePDF
{
    public static function createPdf($content, $filename)
    {
        $configs = [
            'shrink_tables_to_fit' => 0,
            'tempDir' => storage_path() . '/mpdf/temp/dir/path',
            'mode' => 'utf-8',
            'default_font_size' => 9,
            'autoLangToFont' => false,
            'format' => 'A4',
            'margin_left' => 2,
            'margin_right' => 2,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 2,
            'margin_footer' => 5,
            'fontDir' => [
                public_path() . '/fonts',
            ],
            'fontdata' => [
                'pyidaungsu' => [
                    'R' => 'pds.ttf',
                    'I' => 'pds.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
            ],
        ];
        $mpdf = new Mpdf($configs);
        $mpdf->setAutoTopMargin = 'stretch';
        $mpdf->setAutoBottomMargin = 'stretch';
        // $mpdf->shrink_tables_to_fit = 0;

        try {

            // if (isset($data['sayan'])) {
            //     $mpdf->AddPage();
            //     $mpdf->WriteHTML($data['sayan']);
            // }
            $mpdf->WriteHTML($content);


            // $mpdf->SetWatermarkImage('images/watermark/watermark.png');
            // $mpdf->showWatermarkImage = true;
            // $mpdf->watermarkImageAlpha = 0.1;


            // $mpdf->Output($savedToLocalPath, 'F');
            $mpdf->Output($filename, 'D');
        } catch (MpdfException $e) {
            Log::info($e);
        }
    }
}
