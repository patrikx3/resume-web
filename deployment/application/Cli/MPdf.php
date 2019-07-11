<?php

namespace Cli;

use P3x\Debug;
use P3x\Str;

/**
 * Class MPdf
 * @package Cli
 */
class MPdf
{
    /**
     *
     */
    public function run()
    {
        $this->install();
    }

    /**
     *
     */
    public function install()
    {
        $this->installMPdfGenerateFonts();
        $this->installMPdfCopyFonts();
    }

    /**
     * @return bool
     */
    public function installMPdfGenerateFonts()
    {
        return $this->loadFontInclude();
    }

    /**
     * @return bool
     */
    public function loadFontInclude()
    {
        /*
        debug::send('MPDF fonts were generated now.');
        $original_config_font = ROOT_VENDOR_MPDF . 'config_fonts.php';
        include_once ROOT_VENDOR_MPDF . 'config_fonts.php';
        $data = get_object_vars($this);
        $data['fontdata']['resume-font'] = [
            'R' =>  'TitilliumWeb-Regular.ttf',
            'B' =>  'TitilliumWeb-Bold.ttf',
            'I' =>  'TitilliumWeb-Italic.ttf',
            'BI' => 'TitilliumWeb-BoldItalic.ttf',
        ];
        $data['fontdata']['fontawesome'] = [
            'R' =>  'fontawesome-webfont.ttf',
        ];
        $output = '';
        $output .= '<?php' . PHP_EOL;
        foreach($data as $data_key => $data_value) {
            $export = var_export($data[$data_key], true);
            $output .= PHP_EOL;
            $output .= '$this->' . $data_key . ' = ' . $export . ';' . PHP_EOL;
        }
        file_put_contents($original_config_font, $output);
        */
        return true;
    }

    /**
     *
     */
    public function installMPdfCopyFonts()
    {
        $fonts = scandir(ROOT_ARTIFACTS_RESUME_PDF_FONTS);
        foreach ($fonts as $file) {
            if (Str::EnsWithInsensitive($file, 'ttf')) {
                $source = ROOT_ARTIFACTS_RESUME_PDF_FONTS . $file;
                $dest = ROOT_VENDOR_MPDF . 'ttfonts/' . $file;
                Helper::Copy($source, $dest);
            }
        }
    }
}
