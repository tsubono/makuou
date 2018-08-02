<?php
/**
 * Created by PhpStorm.
 * User: arabbit
 * Date: 2018/07/26
 * Time: 23:11
 */

namespace App\Services;


use App\Models\Order;
use PHPExcel_Exception;
use PHPExcel_Reader_Excel2007;
use PHPExcel_Writer_Excel2007;

class PrintReceiptService
{

    public function printReceipt(
        string $file,
        Order $order,
        float $tax,
        string $type = '領収書',
        int $re = 0)
    {
        $orderDetails = $order->order_details;
        $reader = new PHPExcel_Reader_Excel2007();
        try {
            $layout = '納品書レイアウト_幕王.xlsx';
            if ($type === '領収書'){
                $layout = '納品書レイアウト_幕王.xlsx';
            }else if ($type === '請求書'){
                $layout = '請求書レイアウト_幕王.xlsx';
            }else if ($type === '見積書'){
                $layout = '見積書レイアウト_幕王.xlsx';
            }
            $book = $reader->load(resource_path('/assets/'.$layout));
            $sheet = $book->getActiveSheet();

            //宛先
            $sheet->setCellValue('A3', $order->user->name);

            //納品No
            $sheet->setCellValue('N3', $order->id);

            //納品日
            $sheet->setCellValue('N4', '日付のだみーです');

            //件名
            $sheet->setCellValue('C6', '件名のだみーです');
            $sheet->getStyle('D15')
                ->getNumberFormat()
                ->setFormatCode('\¥#,##0');

            $cnt = $re * 12;
            $subTotal = 0;
            $row = 18;
            while ($cnt < count($orderDetails)) {

                //1ページ埋まったら新しく用紙を作成する
                if ($cnt === ($re + 1) * 12) {
                    $this->printReceipt($file, $order, $tax, $re + 1);
                    break;
                }

                //No.
                $sheet->setCellValue('A' . $row, $cnt + 1);

                //品名
                $sheet->setCellValue('B' . $row, $orderDetails[$cnt]->product->title);

                //個数
                $sheet->setCellValue('J' . $row, $orderDetails[$cnt]->quantity);
                $sheet->setCellValue('K' . $row, '個');

                //単価
                $sheet->setCellValue('L' . $row, $orderDetails[$cnt]->price);
                $sheet->getStyle('L' . $row)
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                //商品の金額
                $sheet->setCellValue('O' . $row,
                    $orderDetails[$cnt]->quantity * $orderDetails[$cnt]->price);
                $sheet->getStyle('O' . $row)
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                $subTotal += $orderDetails[$cnt]->quantity * $orderDetails[$cnt]->price;

                $row++;
                $cnt++;
            }

            //ひとまず用紙ごとに小計、合計を算出

            //小計
            $sheet->setCellValue('L30', $subTotal);
            $sheet->getStyle('L30')
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            //消費税額
            $taxPrice = round($subTotal * $tax);
            $sheet->setCellValue('L31', $taxPrice);


            $sheet->setCellValue('L32', $subTotal + $taxPrice);
            $sheet->getStyle('L32')
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            //備考
            $sheet->setCellValue('C34', $order->note);

            $writer = new PHPExcel_Writer_Excel2007($book);

            $path = substr($file, 0, strlen($file) - 5) .
                '_' . $re . substr($file, strlen($file) - 5, strlen($file));

            $writer->save($path);

            return $path;

        } catch (PHPExcel_Exception $e) {
            return false;
        }
    }

}