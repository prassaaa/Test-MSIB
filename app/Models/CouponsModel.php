<?php

namespace App\Models;

use CodeIgniter\Model;

class CouponsModel extends Model
{
    protected $table = 'coupons';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['code', 'is_active', 'expired_date', 'credit', 'is_used', 'created_at', 'updated_at'];

    public function getCouponExpiredDate($code)
    {
        $result = $this->where('code', $code)->get()->getRow();
        return $result->expired_date ?? null;
    }

    public function isCouponExist($code)
    {
        return ($this->where('code', $code)->countAllResults() > 0) ? true : false;
    }

    public function isCouponActive($code)
    {
        $result = $this->where('code', $code)->get()->getRow();
        return ($result && $result->is_active == 1) ? true : false;
    }

    public function isCouponExpired($code)
    {
        $result = $this->where('code', $code)->get()->getRow();
        $expired_at = $result->expired_date;

        return (strtotime($expired_at) > time()) ? false : true;
    }

    public function getCouponCredit($code)
    {
        $result = $this->where('code', $code)->get()->getRow();
        return $result->credit ?? 0;
    }

    public function getCouponId($code)
    {
        $result = $this->where('code', $code)->get()->getRow();
        return $result->id ?? null;
    }

    public function isCouponUsed($code)
    {
        $result = $this->where('code', $code)->get()->getRow();
        return ($result && $result->is_used == 1) ? true : false;
    }

   // In CouponsModel.php
// In CouponsModel.php
public function add_coupon($coupon_data)
{
    $this->insert($coupon_data);
}


    public function markCouponAsUsed($code)
    {
        $couponId = $this->getCouponId($code);

        if ($couponId) {
            $this->set('is_used', 1)
                ->where('id', $couponId)
                ->update();
        }
    }
}
