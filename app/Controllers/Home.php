<?php

namespace App\Controllers;

use App\Models\CouponsModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function generateVoucher()
    {
        $couponCode = $this->request->getPost('coupon_code');
    
        $couponsModel = new CouponsModel();
    
        $params = [
            'harga' => 2000000, 
            'discount' => '',
            'is_used' => false,
            'coupon_code' => $couponCode,
            'coupon_credit' => 0,
            'expired_date' => null, 
        ];
    
        if (!empty($couponCode)) {
            $params = $this->applyCoupon($couponCode, $couponsModel, $params);
        }
       $params['expired_date'] = $couponsModel->getCouponExpiredDate($couponCode);

        return view('CouponsView', $params);
    }
    
    private function applyCoupon($couponCode, $couponsModel, $params)
    {
        if ($couponsModel->isCouponExist($couponCode)) {
            if ($couponsModel->isCouponActive($couponCode)) {
                if (!$couponsModel->isCouponExpired($couponCode)) {
                    if (!$couponsModel->isCouponUsed($couponCode)) {
                        $couponCredit = $couponsModel->getCouponCredit($couponCode);
                        $params['discount'] = $this->getDiscountBadge($couponCredit);
                        $params['coupon_code'] = $this->getCouponCodeBadge($couponCode);
                        
                        $couponsModel->markCouponAsUsed($couponCode);
                        $params['is_used'] = true;
                        $params['coupon_credit'] = $couponCredit;
                    } else {
                        $params = $this->handleInvalidCoupon($couponCode, 'Kupon sudah digunakan', $params);
                    }
                } else {
                    $params = $this->handleInvalidCoupon($couponCode, 'Kupon kadaluarsa', $params);
                }
            } else {
                $params = $this->handleInvalidCoupon($couponCode, 'Kupon sudah tidak aktif', $params);
            }
        } else {
            $params = $this->handleInvalidCoupon($couponCode, 'Kupon tidak terdaftar', $params);
        }
    
        return $params;
    }
    
    private function getDiscountBadge($couponCredit)
    {
        return '<span class="badge badge-success">Rp ' . number_format($couponCredit, 0, ',', '.') . '</span>';
    }
    
    private function getCouponCodeBadge($couponCode)
    {
        return '<span class="badge badge-success">' . $couponCode . '</span>';
    }
    
    private function handleInvalidCoupon($couponCode, $message, $params)
    {
        $params['coupon_code'] = '<span class="badge badge-danger">' . $couponCode . '</span>';
        $params['discount'] = '<span class="badge badge-danger">' . $message . '</span>';
    
        return $params;
    }
    

    public function __construct()
    {
        // Load CouponsModel
        $this->couponsModel = new CouponsModel();
    }
    
    public function add_coupon()
    {
        helper('form');
     
        if ($this->request->getPost()) {
            $code = $this->request->getPost('code');
            $credit = $this->request->getPost('credit');
            $exp = $this->request->getPost('expired_date');
    
            $coupon = [
                'code' => $code,
                'credit' => $credit,
                'expired_date' => date('Y-m-d', strtotime($exp))
            ];
    
            // Call the method using the loaded model
            $this->couponsModel->add_coupon($coupon);
        }
        return view('AddKuponView');
    }
    

}
