<?php

namespace App\Classes;

use App\Classes\FPDF_WriteTag;
use Illuminate\Support\Str;
use Milon\Barcode\DNS2D;

class FPDF_AutoWrapTable extends FPDF_WriteTag
{

    // BEGIN : Auto WrapTable
    private $widths;
    private $aligns;
    private $type_fonts;

    public $opd;
    public $isUseSignature = false;
    public $barcodePosition = "right"; // center or right;
    /** @var string|null path ke file PNG QR */
    protected ?string $qrPath = null;

    /** @var float lebar gambar QR dalam mm */
    protected float $qrWidthMm = 22; // atur sesuai selera

    public function __construct($orientation, $unit, $size, $opd = null)
    {
        parent::__construct($orientation, $unit, $size); // Panggil konstruktor class orang tua
        $this->opd = $opd;
    }

    public function SetWidths($w)
    {
        // Set the array of column widths
        $this->widths = $w;
    }

    public function SetAligns($a)
    {
        // Set the array of column alignments
        $this->aligns = $a;
    }

    public function SetFonts($f)
    {
        // Set the array of column fonts
        $this->type_fonts = $f;
    }

    public function Row($data, $head = 5, $checkPageBreak = false)
    {
        // Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = $head * $nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h, $checkPageBreak);
        // Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {

            if (isset($this->type_fonts[$i])) {
                $this->SetFont($this->type_fonts[$i][0], $this->type_fonts[$i][1], $this->type_fonts[$i][2]);
            }

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x, $y, $w, $h);
            // Print the text
            $this->MultiCell($w, $head, $data[$i], 0, $a);
            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    public function RowHead($data, $head = 7, $mid = true)
    {
        // Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++) {
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        }

        $h = $head * $nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {

            if (isset($this->type_fonts[$i])) {
                $this->SetFont($this->type_fonts[$i][0], $this->type_fonts[$i][1], $this->type_fonts[$i][2]);
            }

            // Custom - text to middle vertical
            $nbLines = $this->NbLines($this->widths[$i], $data[$i]);
            $heightColumn = $h / $nbLines;

            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x, $y, $w, $h, 'DF');
            // Print the text
            if ($mid == true) {
                $this->MultiCell($w, $heightColumn, $data[$i], 0, $a);
            } else {
                $this->MultiCell($w, $head, $data[$i], 0, $a);
            }

            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    // function CheckPageBreak($h) {
    public function CheckPageBreak($h, $checkPageBreak = false, $hBreak = 65)
    {
        // If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger) {
            $this->AddPage($this->CurOrientation);
        }

        // Custom Jika Pakai TTD
        // $this->GetY()+$h > $this->PageBreakTrigger // $this->AutoPageBreak
        if ($checkPageBreak and $this->isUseSignature) {
            if ($this->GetY() + $h >= ($this->GetPageHeight() - $hBreak)) {
                $this->AddPage($this->CurOrientation);
            }
        }
    }

    public function NbLines($w, $txt)
    {
        // Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0) {
            $w = $this->w - $this->rMargin - $this->x;
        }

        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n") {
            $nb--;
        }

        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') {
                $sep = $i;
            }

            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) {
                        $i++;
                    }

                } else {
                    $i = $sep + 1;
                }

                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }

        }
        return $nl;
    }
    // END : Auto WrapTable

    // BEGIN : Custom Header & Footer
    public $site_name = null;
    public $short_name = null;
    public $logo_icon = null;
    public $logo_icon_path = null;
    public $address = null;
    public $email = null;
    public $phone_number = null;
    public $facsimile = null;

    public $opd_name = "{ Hubungi Admin Kominfo Untuk Memasukkan Nama OPD }";
    public $opd_address = "{ Silahkan Atur Alamat OPD\nPada Pengaturan }";
    public $opd_postal_code = "{ Silahkan Atur Kode POS OPD Pada Pengaturan }";

    public $header1 = 'PEMERINTAH KOTA PEKANBARU';
    public $header2 = 'Kota Pekanbaru - Riau';

    public function data_core()
    {
        // Default info
        $site_name = config('app.name', 'Laravel');
        $short_name = ucwords(request()->getHttpHost());
        $logo_icon = asset('images/logo-icon.png');
        $logo_icon_path = 'images/logo-icon.png';
        $address = null;
        $email = null;
        $phone_number = null;
        $facsimile = null;

        $this->logo_icon = $logo_icon;
        $this->logo_icon_path = $logo_icon_path;
        $this->site_name = $site_name;
        $this->short_name = $short_name;
        $this->address = $address;
        $this->email = $email;
        $this->phone_number = $phone_number;
        $this->facsimile = $facsimile;
        $this->opd_name = strtoupper('DINAS PEKERJAAN UMUM DAN PENATAAN RUANG');
        $this->opd_address = "Jl. Abdul Rahman Hamid Komplek Perkantoran Tenayan Raya Gedung B-9 Lt.4-5";
        $this->opd_postal_code = "Kec. Tenayan Raya, Kota Pekanbaru";

    }

    public function image_kop()
    {
        $this->Image(public_path('images/logo-icon.png'), 20, 5, 19, 25);
    }
    public function image_kop_ls()
    {
        $this->Image(public_path('images/logo-icon.png'), 15, 10, 18, 24);
    }

    public function title_kop()
    {
        $this->SetFont('Times', 'B', '16');
        // $this->SetFontSpacing(0.5);
        $x = 10;
        $wIcon = 20;
        $wText = 170;
        $this->setX($x);
        $this->Cell($wIcon);
        $this->Cell($wText, 6, $this->header1, 0, 1, 'C');

        $fontSize = 14;
        $lengthOpdName = strlen($this->opd_name);
        if ($lengthOpdName >= 59) {
            $fontSize = 11;
        } elseif ($lengthOpdName >= 54 and $lengthOpdName <= 58) {
            $fontSize = 13;
        } elseif ($lengthOpdName >= 50 and $lengthOpdName <= 53) {
            $fontSize = 14;
        } elseif ($lengthOpdName >= 45 and $lengthOpdName <= 49) {
            $fontSize = 15;
        } elseif ($lengthOpdName >= 40 and $lengthOpdName <= 44) {
            $fontSize = 15.5;
        } else {
            $fontSize = 16;
        }

        $this->SetFont('Times', 'B', $fontSize);
        // $this->SetFontSpacing(0);
        $this->setX($x);
        $this->Cell($wIcon);
        $this->Cell($wText, 6, $this->opd_name, 0, 1, 'C');

        $this->SetFont('Times', '', '11');
        $this->setX($x);
        $this->Cell($wIcon);
        $this->MultiCell($wText, 5, $this->opd_address, 0, 'C'); // . ' ' . $this->header2

        $this->SetFont('Times', 'B', '11');
        $this->setX($x);
        $this->Cell($wIcon);
        $this->Cell($wText, 5, 'P E K A N B A R U - ' . $this->opd_postal_code, 0, 1, 'C');
    }
    public function title_kop_ls()
    {
        $this->SetFont('Times', 'B', '20');
        // $this->SetFontSpacing(0.5);
        $x = 10;
        $wIcon = 30;
        // $wText = 170;
        $this->setX($x);
        $this->Cell($wIcon);
        $this->Cell(0, 5, $this->header1, 0, 1, 'C');
        $this->ln(2);
        // $this->SetFontSpacing(0);
        $this->SetFont('Times', 'B', '18');
        $this->setX($x);
        $this->Cell($wIcon);
        $this->Cell(0, 5, $this->opd_name, 0, 1, 'C');
        $this->ln(1);
        $this->SetFont('Times', '', '12');
        $this->setX($x);
        $this->Cell($wIcon);
        // $this->MultiCell(0, 5, $this->opd_address, 0, 'C'); // . ' ' . $this->header2
        $this->Cell(0, 5, trim(preg_replace('/\s+/', ' ', $this->opd->address)), 0, 1, 'C');
        $this->SetFont('Times', 'B', '12');
        $this->setX($x);
        $this->Cell($wIcon);
        $this->Cell(0, 5, 'P E K A N B A R U - ' . $this->opd_postal_code, 0, 1, 'C');
    }

    public function line_kop()
    {
        $h = $this->getY();
        $y = $h + 4;
        $this->SetLineWidth(0);
        $this->Line(10, $y, $this->GetPageWidth() - 10, $y);
        $this->SetLineWidth(1);
        $this->Line(10, $y + 1, $this->GetPageWidth() - 10, $y + 1);
    }
    public function line_kop_ls()
    {
        $h = $this->getY();
        $y = $h + 2;
        $this->SetLineWidth(0);
        $this->Line(10, $y, $this->GetPageWidth() - 10, $y);
        $this->SetLineWidth(1);
        $this->Line(10, $y + 1, $this->GetPageWidth() - 10, $y + 1);
    }

    public $skipHeader = false;
    public $skipFooter = false;

    public function Header()
    {
        $this->data_core();
        if ($this->DefOrientation == 'P') {
            $this->image_kop();
            $this->title_kop();
            $this->line_kop();
        } else {
            $this->image_kop_ls();
            $this->title_kop_ls();
            $this->line_kop_ls();
        }
        $this->Ln(10);
    }
    /**
     * Set QR once untuk seluruh dokumen (dipanggil sebelum AddPage())
     */
    public function setVerificationQr(string $verificationUrl, int $scale = 6, float $qrWidthMm = 22): void
    {
        $this->qrPath = $this->makeTempQr($verificationUrl, $scale);
        $this->qrWidthMm = $qrWidthMm;
    }
    public static function makeTempQr(string $url, int $scale = 6): string
    {
        $dns = new DNS2D();
        // getBarcodePNG() mengembalikan base64 (tanpa header data URI)
        $base64 = $dns->getBarcodePNG($url, 'QRCODE', $scale, $scale, [0, 0, 0]);
        $png = base64_decode($base64);

        $filename = 'qr_' . Str::uuid() . '.png';
        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename;
        file_put_contents($path, $png);

        return $path;
    }
    public function Footer()
    {
        if (!$this->skipFooter) {

            // ===== 0) Posisi barcode/QR fleksibel (left|center|right) =====
            // - Sumber posisi: $this->barcodeposition atau $barcodeposition (kalau ada), default 'center'
            // - Margin X disamakan dengan footer text kamu: 10 (portrait) / 5 (else)

            // === 1) Gambar QR/barcode di atas footer utama ===
            if (!empty($this->qrPath) && file_exists($this->qrPath) && !empty($this->qrWidthMm)) {
                $marginBottomForFooterText = 2;
                $gapBetweenQrAndFooter     = 6;
                $y = $this->GetPageHeight() - ($marginBottomForFooterText + $gapBetweenQrAndFooter + $this->qrWidthMm);

                $marginX = ($this->DefOrientation == 'P') ? 20 : 5;

                if ($this->barcodePosition === 'left') {
                    $x = $marginX;
                } elseif ($this->barcodePosition === 'right') {
                    $x = $this->GetPageWidth() - $marginX - $this->qrWidthMm;
                } else {
                    $x = ($this->GetPageWidth() - $this->qrWidthMm) / 2;
                }

                $this->Image($this->qrPath, $x, $y, $this->qrWidthMm);
            }

            // ===== 2) Footer teks =====
            if ($this->DefOrientation == 'P') {
                // Baris teks "Scan untuk validasi" di atas footer utama
                $this->SetY(-14); // 4 mm di atas baris footer utama (-10)
                $this->SetX(10);
                $this->SetTextColor(100, 100, 100);
                $this->SetFont('Arial', 'I', 5);

                $widthLR = 2 / 5 * $this->GetPageWidth() - 10;
                $widthC  = 1 / 5 * $this->GetPageWidth();

                // tiga kolom: kosong - tengah (teks) - kosong
                $this->Cell($widthLR, 4, '', 0, 0, 'L');
                $this->Cell($widthC - 3, 24, 'Scan untuk validasi', 0, 0, 'C');
                $this->Cell($widthLR, 4, '', 0, 0, 'R');

                // Footer utama
                $this->SetY(-10);
                $this->SetX(10);
                $this->SetTextColor(0, 0, 0);
                $this->SetFont('Arial', '', 7);

                $this->Cell($widthLR, 10, 'Dokumen diterbitkan melalui ' . ucwords(request()->getHttpHost()), 0, 0, 'L');
                $this->Cell($widthC, 10, 'Hal ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
                $this->Cell($widthLR, 10, 'Pada : ' . date('d-m-Y H:i:s'), 0, 0, 'R');

            } else {
                // Footer untuk orientasi selain 'P'
                $this->SetY(-10);
                $this->SetX(5);
                $this->SetTextColor(0, 0, 0);
                $this->SetFont('Times', '', 8);

                $widthLR = 2 / 5 * $this->GetPageWidth() - 5;
                $widthC  = 1 / 5 * $this->GetPageWidth();

                $this->Cell($widthLR, 10, 'Data di-export melalui ' . ucwords(request()->getHttpHost()), 0, 0, 'L');
                $this->Cell($widthC, 10, 'Hal ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
                $this->Cell($widthLR, 10, 'Pada : ' . date('d-m-Y H:i:s'), 0, 0, 'R');
            }
        }
    }

    // END : Custom Header & Footer

    // BEGIN : Character Spacing
    protected $cs; // character spacing

    // Sets character spacing (0 for normal, 0.5 = 50%, 1 = 100%)
    public function SetFontSpacing($cs = 0)
    {
        $this->cs = $cs;
        $this->_out(sprintf('BT %.3F Tc ET', $cs * $this->k));
    }
    protected $col = 0; // Current column
    protected $y0; // Ordinate of column start

    public function SetCol($col)
    {
        // Set position at a given column
        $this->col = $col;
        $x = 10 + $col * 100; // 65 for 3 column
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

    public function AcceptPageBreak()
    {
        if ($this->col < 1) // 1 for 2 column
        {
            // Go to next column
            $this->SetCol($this->col + 1);
            // Set ordinate to top
            $this->SetY($this->y0);
            // Keep on page
            return false;
        } else {
            // Go back to first column
            $this->SetCol(0);
            // Page break
            return true;
        }
    }

    public function ChapterTitle($num, $label)
    {
        // Title
        $this->SetFont('Arial', '', 12);
        $this->SetFillColor(200, 220, 255);
        $this->Cell(0, 6, "Chapter $num : $label", 0, 1, 'L', true);
        $this->Ln(4);
        // Save ordinate
        $this->y0 = $this->GetY();
    }

    public function ChapterBody($file)
    {
        // Read text file
        $txt = file_get_contents($file);
        // Font
        $this->SetFont('Times', '', 12);
        // Output text in a 6 cm width column
        $this->MultiCell(60, 5, $txt); // 60 for 3 column
        $this->Ln();
        // Mention
        $this->SetFont('', 'I');
        $this->Cell(0, 5, '(end of excerpt)');
        // Go back to first column
        $this->SetCol(0);
    }

    public function PrintChapter($num, $title, $file)
    {
        // Add chapter
        $this->AddPage();
        $this->ChapterTitle($num, $title);
        $this->ChapterBody($file);
    }

    public function PrintText($txt)
    {
        $this->y0 = $this->GetY();
        $this->MultiCell(160 / 2, 5, $txt); // 60 for 3 column
        $this->Ln();
        $this->SetCol(0);
    }

} // end of class
