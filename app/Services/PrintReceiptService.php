<?php
/**
 * Created by PhpStorm.
 * User: arabbit
 * Date: 2018/07/26
 * Time: 23:11
 */

namespace App\Services;


use PHPExcel_Exception;
use PHPExcel_Reader_Excel2007;
use PHPExcel_Writer_Excel2007;

class PrintReceiptService
{

    /**
     * @param string $file
     * @param string $to 宛名
     * @param string $subject 件名
     * @param string $date 納期
     * @param int $total 合計金額
     * @param int $no No.
     * @param string $overview 概要
     * @param int $amount 数量
     * @param int $unitPrice 単価
     * @param int $price 金額
     * @param int $preTotal 小計
     * @param string $tax 消費税
     * @param string $remarks 備考
     * @return bool
     */
    public function printReceipt(string $file,
                                 string $to,
                                 string $subject,
                                 string $date,
                                 int $total,
                                 int $no,
                                 string $overview,
                                 int $amount,
                                 int $unitPrice,
                                 int $price,
                                 int $preTotal,
                                 string $tax,
                                 string $remarks)
    {
        $reader = new PHPExcel_Reader_Excel2007();
        try {
            $book = $reader->load(resource_path('/assets/納品書レイアウト_幕王.xlsx'));
            $sheet = $book->getActiveSheet();

            $sheet->setCellValue('A3', $to);
            $sheet->setCellValue('N3', $no);
            $sheet->setCellValue('N4', $date);
            $sheet->setCellValue('C6', $subject);
            $sheet->getStyle('D15')
                ->getNumberFormat()
                ->setFormatCode('\¥#,##0');
            $sheet->setCellValue('A18', '1');
            $sheet->setCellValue('B18', $overview);
            $sheet->setCellValue('J18', $amount);
            $sheet->setCellValue('K18', '個');
            $sheet->setCellValue('L18', $unitPrice);
            $sheet->getStyle('L18')
                ->getNumberFormat()
                ->setFormatCode('#,##0');
            $sheet->setCellValue('O18', $price);
            $sheet->getStyle('O18')
                ->getNumberFormat()
                ->setFormatCode('#,##0');
            $sheet->setCellValue('L30', $preTotal);
            $sheet->getStyle('L30')
                ->getNumberFormat()
                ->setFormatCode('#,##0');
            $sheet->setCellValue('L31', $tax);
            $sheet->setCellValue('L32', $total);
            $sheet->getStyle('L32')
                ->getNumberFormat()
                ->setFormatCode('#,##0');
            $sheet->setCellValue('C34', $remarks);

            $writer = new PHPExcel_Writer_Excel2007($book);
            $writer->save($file);

            return true;
        } catch (PHPExcel_Exception $e) {
            return false;
        }
    }

    /**
     * @param $to           宛名
     * @param $subject      件名
     * @param $date         納期
     * @param $total        合計金額
     * @param $no           No.
     * @param $overview     概要
     * @param $amount       数量
     * @param $unitPrice    単価
     * @param $price        金額
     * @param $preTotal     小計
     * @param $tax          消費税
     * @param $remarks      備考
     */
    //TODO printReceiptでOKならばこれは最終的に削除する
    private
    function printReceiptoriginal($to, $subject, $date, $total, $no, $overview, $amount, $unitPrice, $price, $preTotal, $tax, $remarks)
    {
        $book = new PHPExcel();
        $sheet = $book->getActiveSheet();
        try {

            //デフォルト幅
            $sheet->getDefaultColumnDimension()->setWidth(6);
            //デフォルト高さ
//            $sheet->getDefaultRowDimension()->setRowHeight(20);
            //デフォルト文字位置
            $sheet->getParent()->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            //デフォルト文字サイズ
            $sheet->getParent()->getDefaultStyle()->getFont()->setSize(12);
            //デフォルトフォント
            $sheet->getParent()->getDefaultStyle()->getFont()->setName('游ゴシック Regular (本文)');

            $drawing = new PHPExcel_Worksheet_Drawing();
            $drawing->setPath(storage_path('/app/makuou.png'));
            $drawing->setCoordinates('P5');
            $drawing->setHeight(100);
            $drawing->setWorksheet($sheet);

            //ヘッダー(1行目)
            $sheet->getRowDimension('1')->setRowHeight(30);
            $sheet->mergeCells('A1:Q1');
            $sheet->setCellValue('A1', '納品書');
            $sheet->getStyle('A1')->getFont()->setSize(18);
            $sheet->getStyle('A1')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            //2行目
            $sheet->getRowDimension('2')->setRowHeight(10);

            //3行目
            $sheet->getRowDimension('3')->setRowHeight(30);
            $sheet->mergeCells('A3:G3');
            $sheet->setCellValue('A3', $to);
            $sheet->setCellValue('H3', '様');
            $sheet->getStyle('A3:H3')
                ->getFont()->setSize(14);
            $sheet->getStyle('A3:G3')
                ->getBorders()
                ->getBottom()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->mergeCells('L3:M3');
            $sheet->setCellValue('L3', '納品No.');

            $sheet->setCellValue('N3', $no);

            //4行目
            $sheet->getRowDimension('4')->setRowHeight(30);
            $sheet->mergeCells('L4:M4');
            $sheet->setCellValue('L4', '納品日');

            $sheet->setCellValue('N4', $date);

            //5行目
            $sheet->getRowDimension('5')->setRowHeight(10);

            //6行目
            $sheet->getRowDimension('3')->setRowHeight(30);
            $sheet->mergeCells('A6:B6');
            $sheet->setCellValue('A6', '件名:');
            $sheet->setCellValue('C6', $subject);

            $sheet->mergeCells('C6:I6');
            $sheet->setCellValue('C6', $to);

            $sheet->mergeCells('K6:Q6');
            $sheet->setCellValue('K6', '幕王（株式会社大阪美装）');

            $sheet->setCellValue('S6', '個');
            $sheet->setCellValue('T6', $tax
            );
            $sheet->getStyle('T6')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $sheet->getStyle('A6')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $sheet->getStyle('A6')
                ->getFont()->setSize(14);
            $sheet->getStyle('A6')
                ->getFont()->setBold(true);

            $sheet->getStyle('A6:I6')
                ->getBorders()
                ->getBottom()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

            //7行目
            $sheet->mergeCells('B7:J7');
            $sheet->setCellValue('B7', '下記のとおり、納品致します。');

            $sheet->mergeCells('K7:Q7');
            $sheet->setCellValue('K7', '〒566-0035');

            $sheet->setCellValue('S7', '式');

            //8行目
            $sheet->mergeCells('K8:Q8');
            $sheet->setCellValue('K8', '大阪府摂津市鶴野2-3-19');

            $sheet->setCellValue('S8', '時間');

            //9行目
            $sheet->setCellValue('S9', '日');

            //10行目
            $sheet->getRowDimension('14')->setRowHeight(20);
            $sheet->mergeCells('A10:B10');
            $sheet->setCellValue('A10', '納期');
            $sheet->getStyle('A10')
                ->getFont()->setSize(11);
            $sheet->getStyle('A10')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $sheet->mergeCells('C10:I10');
            $sheet->getStyle('C10:I10')
                ->getBorders()
                ->getBottom()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->mergeCells('K10:L10');
            $sheet->setCellValue('K10', 'TEL:');
            $sheet->getStyle('K10')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $sheet->mergeCells('M10:Q10');
            $sheet->setCellValue('M10', '0120-805-266');

            $sheet->setCellValue('S10', 'ヶ月');

            //11行目
            $sheet->mergeCells('C11:I11');
            $sheet->getStyle('C11:I11')
                ->getBorders()
                ->getBottom()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            $sheet->mergeCells('K11:L11');
            $sheet->setCellValue('K11', 'E-Mail:');
            $sheet->getStyle('K11')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

            $sheet->mergeCells('M11:Q11');
            $sheet->setCellValue('M11', 'info@maku-ou.com');

            //14行目
            $sheet->getRowDimension('14')->setRowHeight(10);

            //15行目
            $sheet->mergeCells('A15:C15');
            $sheet->setCellValue('A15', '合計金額');
            $sheet->getStyle('A15')
                ->getFont()->setSize(14);
            $sheet->getStyle('A15')
                ->getFont()->setBold(true);
            $sheet->getStyle('A15')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->mergeCells('D15:G15');
            $sheet->setCellValue('D15', '¥' . $total);
            $sheet->getStyle('D15')
                ->getFont()->setSize(14);
            $sheet->getStyle('D15')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->mergeCells('H15:I15');
            $sheet->setCellValue('H15', '(税込)');

            $sheet->getStyle('A15:I15')
                ->getBorders()
                ->getBottom()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_DOUBLE);

            //16行目
            $sheet->getRowDimension('16')->setRowHeight(10);

            //17行目
            $sheet->getRowDimension('17')->setRowHeight(25);

            $sheet->setCellValue('A17', 'No.');
            $sheet->getStyle('A17')
                ->getFont()->setBold(true);
            $sheet->getStyle('A17')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->mergeCells('B17:I17');
            $sheet->setCellValue('B17', '摘要');
            $sheet->getStyle('B17')
                ->getFont()->setBold(true);
            $sheet->getStyle('B17')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->mergeCells('J17:K17');
            $sheet->setCellValue('J17', '数量');
            $sheet->getStyle('J17')
                ->getFont()->setBold(true);
            $sheet->getStyle('J17')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->mergeCells('L17:N17');
            $sheet->setCellValue('L17', '単価');
            $sheet->getStyle('L17')
                ->getFont()->setBold(true);
            $sheet->getStyle('L17')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->mergeCells('O17:Q17');
            $sheet->setCellValue('O17', '金額');
            $sheet->getStyle('O17')
                ->getFont()->setBold(true);
            $sheet->getStyle('O17')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->getStyle('A17:Q17')
                ->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A17:Q17')
                ->getFill()->setStartColor(new PHPExcel_Style_Color('c0c0c0'));
            $sheet->getStyle('A17:Q17')
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            //18行目~(購入品一覧部分)
            for ($i = 18; $i <= 29; $i++) {
                $sheet->getRowDimension($i)->setRowHeight(20);
                $sheet->mergeCells('B' . $i . ':I' . $i);
                $sheet->mergeCells('J' . $i . ':K' . $i);
                $sheet->mergeCells('L' . $i . ':N' . $i);
                $sheet->mergeCells('O' . $i . ':Q' . $i);
                $sheet->getStyle('A' . $i . ':Q' . $i)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            }
            $sheet->setCellValue('A18', '1');
            $sheet->setCellValue('B18', $overview);
            $sheet->setCellValue('J18', $amount);
            $sheet->setCellValue('L18', $unitPrice);
            $sheet->setCellValue('O18', $price);

            //30行目~
            for ($i = 30; $i <= 32; $i++) {
                $sheet->getRowDimension($i)->setRowHeight(20);
                $sheet->mergeCells('J' . $i . ':K' . $i);
                $sheet->getStyle('J' . $i . ':K' . $i)
                    ->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                $sheet->getStyle('J' . $i . ':K' . $i)
                    ->getFill()->setStartColor(new PHPExcel_Style_Color('c0c0c0'));
                $sheet->getStyle('J' . $i)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('J' . $i . ':K' . $i)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                $sheet->mergeCells('L' . $i . ':Q' . $i);
                $sheet->getStyle('L' . $i . ':Q' . $i)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $sheet->getStyle('L' . $i)
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            }

            //30行目
            $sheet->setCellValue('J30', '小計');
            $sheet->setCellValue('L30', '¥' . $preTotal);
            //31行目
            $sheet->setCellValue('J31', '消費税');
            $sheet->setCellValue('L31', $tax);
            //32行目
            $sheet->setCellValue('J32', '合計');
            $sheet->setCellValue('L32', '¥' . $total);
            $sheet->getStyle('L32')
                ->getFont()->setBold(true);

            //34~37行目(備考欄)
            $sheet->mergeCells('A34:B37');
            $sheet->setCellValue('A34', '備考');
            $sheet->getStyle('A34')
                ->getFont()->setBold(true);
            $sheet->getStyle('A34:B37')
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $sheet->getStyle('A34:B37')
                ->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
            $sheet->getStyle('A34:B37')
                ->getFill()->setStartColor(new PHPExcel_Style_Color('c0c0c0'));
            $sheet->getStyle('A34')
                ->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $sheet->mergeCells('C34:Q37');
            $sheet->setCellValue('C34', $remarks);
            $sheet->getStyle('C34:Q37')
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


            $writer = new PHPExcel_Writer_Excel2007($book);
            $writer->save('./test.xlsx');
        } catch (PHPExcel_Exception $e) {
            info($e);
        }


    }

}