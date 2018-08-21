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
        $orderShippingAddresse = $order->order_shipping_address;

        $reader = new PHPExcel_Reader_Excel2007();
        try {
            // デフォルトは納品
            $layout = '納品書レイアウト_幕王.xlsx';
            $date = !empty($order->shipping_at)?$order->shipping_at->format('Y年m月d日'):'';

            if ($type === '請求書'){
                $layout = '請求書レイアウト_幕王.xlsx';
                $date = !empty($order->ordered_at)?$order->ordered_at->format('Y年m月d日'):'';

            }else if ($type === '見積書'){
                $layout = '見積書レイアウト_幕王.xlsx';
                $date = !empty($order->ordered_at)?$order->ordered_at->format('Y年m月d日'):'';
            }
            $book = $reader->load(resource_path('/assets/'.$layout));
            $sheet = $book->getActiveSheet();

            //宛先
            $sheet->setCellValue('A3', $orderShippingAddresse->name);

            //納品No
            $sheet->setCellValue('N3', $order->id);

            //納品日

            $sheet->setCellValue('N4', $date);

            //件名
            $sheet->setCellValue('C6', !empty($orderDetails[0])?$orderDetails[0]->design_name:'');
            $sheet->getStyle('D15')
                ->getNumberFormat()
                ->setFormatCode('\¥#,##0');

            //納期
            if (!empty($orderDetails[0])) {
                $nouki_id = $orderDetails[0]->nouki_id;
                $nouki = '';
                if ($nouki_id == '1') {
                    $nouki = '通常発送';
                } elseif ($nouki_id == '2') {
                    $nouki = '特急発送';
                }
                $sheet->setCellValue('C10', $nouki);
            }


            $cnt = $re * 12;
            $subTotal = 0;
            $row = 18;
//            while ($cnt < count($orderDetails)) {
//
//                //1ページ埋まったら新しく用紙を作成する
//                if ($cnt === ($re + 1) * 12) {
//                    $this->printReceipt($file, $order, $tax, $re + 1);
//                    break;
//                }
//
//                //No.
//                $sheet->setCellValue('A' . $row, $cnt + 1);
//
//                //品名
//                // $sheet->setCellValue('B' . $row, $orderDetails[$cnt]->product->title);
//                $sheet->setCellValue('B' . $row, $orderDetails[$cnt]->design_name);
//
//                //個数
//                $sheet->setCellValue('J' . $row, $orderDetails[$cnt]->quantity);
//                $sheet->setCellValue('K' . $row, '個');
//
//                //単価
//                $price = $orderDetails[$cnt]->price;
//                // 特急の場合は20%増し
//                if ($nouki_id == '2') {
//                    $price *= 1.2;
//                }
//                $price += $orderDetails[$cnt]->option_price;
//                $sheet->setCellValue('L' . $row, $price);
//                $sheet->getStyle('L' . $row)
//                    ->getNumberFormat()
//                    ->setFormatCode('#,##0');
//
//                //商品の金額
//                $sheet->setCellValue('O' . $row,
//                    $orderDetails[$cnt]->quantity * $price);
//                $sheet->getStyle('O' . $row)
//                    ->getNumberFormat()
//                    ->setFormatCode('#,##0');
//
//                $subTotal += $orderDetails[$cnt]->quantity * $orderDetails[$cnt]->price;
//
//                $row++;
//                $cnt++;
//            }

            if (!empty($orderDetails[0])) {

                //No.
                $sheet->setCellValue('A' . $row, 1);

                //品名
                $sheet->setCellValue('B' . $row, $orderDetails[0]->design_name);

                //個数
                $sheet->setCellValue('J' . $row, $orderDetails[0]->quantity);
                $sheet->setCellValue('K' . $row, '個');

                //単価
                $price = $orderDetails[0]->price;

                $price += $orderDetails[0]->option_price;
                $sheet->setCellValue('L' . $row, $price);
                $sheet->getStyle('L' . $row)
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                //商品の金額
                $sheet->setCellValue('O' . $row,
                    $orderDetails[0]->quantity * $price);
                $sheet->getStyle('O' . $row)
                    ->getNumberFormat()
                    ->setFormatCode('#,##0');

                $subTotal += $orderDetails[0]->quantity * $price;
            }

            //小計
            //$sheet->setCellValue('L30', $subTotal);
            $sheet->setCellValue('L30', $subTotal);
            $sheet->getStyle('L30')
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            //消費税額
            $taxPrice = round($subTotal * $tax);
            $sheet->setCellValue('L31', $taxPrice);


            //送料
            $sheet->setCellValue('L32', $order->shipping_cost);


            $sheet->setCellValue('L33', $subTotal + $taxPrice + (int)config('const.shipping_cost'));
            $sheet->getStyle('L33')
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            //備考
            $sheet->setCellValue('C35', $order->note);

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