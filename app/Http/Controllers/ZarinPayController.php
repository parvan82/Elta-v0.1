<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zarinpal\Zarinpal; // اگه پکیج نصب کردی

class ZarinPayController extends Controller
{
    public function paymentRequest(Request $request)
    {
        $amount = 1000; // مبلغ تستی به تومان
        $callbackUrl = route('payment.verify'); // آدرس برگشت از زرین‌پال

        $zarinpal = new Zarinpal('YOUR_MERCHANT_ID'); // مرچنت کد زرین‌پال

        $result = $zarinpal->request(
            $callbackUrl,
            $amount,
            'توضیحات تراکنش'
        );

        if (isset($result['Authority']) && $result['Status'] == 100) {
            return response()->json([
                'url' => 'https://www.zarinpal.com/pg/StartPay/'.$result['Authority']
            ]);
        } else {
            return response()->json(['error' => $result], 500);
        }
    }

    public function paymentVerify(Request $request)
    {
        $authority = $request->query('Authority');
        $status    = $request->query('Status');

        // اینجا باید Verify انجام بدی
        return response()->json([
            'authority' => $authority,
            'status' => $status,
        ]);
    }
}
