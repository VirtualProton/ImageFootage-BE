<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PromoCode;
use Exception;

/**
 * 
 * PromoCodeController
 */
class PromoCodeController extends Controller
{
    /**
     * Validate Promo Code
     * 
     * @param Request $request
     */
    public function validatePromoCode(Request $request)
    {
        try {
            $this->validate($request, [
                'promoCode' => 'required|string',
                'price'     => 'required|numeric|gt:0',
                'assetType' => 'required|string'
            ]);

            $promoCode = $request->input('promoCode');
            $price = $request->input('price');
            $assetType = $request->input('assetType');
            $existsPromoCode = PromoCode::where('name', $promoCode)->where('asset_type', $assetType)->where('status', '1')->whereIn('will_apply_by', ['1', '3'])->first();
            $today = date('Y-m-d');
            
            if (!$existsPromoCode) {
                return response()->json([
                    'status' => false, 
                    'message' => "Invalid PromoCode."
                ], 400);
            }
            
            if ($existsPromoCode->valid_till_date < $today) {
                return response()->json([
                    'status' => false, 
                    'message' => "Promo code has been expired."
                ], 400);
            }

            if ($existsPromoCode->valid_upto_type == 'range' && $existsPromoCode->valid_start_date > $today) {
                return response()->json([
                    'status' => false, 
                    'message' => "Promo code is not active yet.",
                ], 400);
            }
            
            $usedCode = $existsPromoCode->total_applied_code ?? 0;
            $usedCode = $usedCode + 1;
            
            if ($usedCode > $existsPromoCode->max_usage) { 
                return response()->json([
                    'status' => false, 
                    'message' => "Promo code has reached max usage."
                ], 400);
            }

            if ($existsPromoCode->type === 'flat') {//
                $discountValue = $existsPromoCode->discount ?? 0;
                $calculatedPrice = $price - $discountValue;
            } elseif ($existsPromoCode->type === 'percentage') {
                $discountValue = ($request->input('price') * $existsPromoCode->discount) / 100;
                $calculatedPrice = $price - $discountValue;
            } else {
                return response()->json([
                    'status' => false, 
                    'message' => "Invalid PromoCode type."
                ], 400);
            }

            return response()->json([
                'status' => 0, 
                'message' => "Promo code has been applied successfully.",
                'promoCode' => $existsPromoCode->name,
                'discountValue' => $discountValue,
                'discountType' => $existsPromoCode->type,
                'totalAmount' => max($calculatedPrice, 0)
            ], 200);

        } catch (Exception $e) {
            // var_dump($e->getMessage()); exit;
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while validating promo code.'
            ], 500);
        }
    }
}