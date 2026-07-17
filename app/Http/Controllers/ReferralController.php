<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Referral;

class ReferralController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $referrals = Referral::with([

            'visit.patient',

            'visit.consultations',

            'referrer'

        ])

        ->latest()

        ->get();

        return view(

            'referrals.dashboard',

            compact('referrals')

        );
    }

    /*
    |--------------------------------------------------------------------------
    | View Referral
    |--------------------------------------------------------------------------
    */

    public function show(Referral $referral)
    {
        $referral->load([

            'visit.patient',

            'visit.consultations',

            'referrer'

        ]);

        return view(

            'referrals.show',

            compact('referral')

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Printable Letter
    |--------------------------------------------------------------------------
    */

    public function letter(Referral $referral)
    {
        $referral->load([

            'visit.patient',

            'visit.consultations',

            'referrer'

        ]);

        return view(

            'referrals.letter',

            compact('referral')

        );
    }

    /*
    |--------------------------------------------------------------------------
    | Mark Reviewed
    |--------------------------------------------------------------------------
    */

    public function markReviewed(Referral $referral)
    {
        $referral->update([

            'status'=>'REVIEWED'

        ]);

        return back()

            ->with(

                'success',

                'Referral marked as reviewed.'

            );
    }

    /*
    |--------------------------------------------------------------------------
    | Complete Referral
    |--------------------------------------------------------------------------
    */

    public function complete(Referral $referral)
    {
        $referral->update([

            'status'=>'COMPLETED'

        ]);

        return back()

            ->with(

                'success',

                'Referral completed.'

            );
    }
}