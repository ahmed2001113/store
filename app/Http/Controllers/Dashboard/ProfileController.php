<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user(); // هنجيب بيانات اليوزر الي عامل تسجيل دخول ونبعتها
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),// كود كل الدول بمكتبه سيمفوني
            // للغات و ممكن تكتب فيهم اختصار للغه الي انت عايز البيانات بيها ar مثلا 
            'locales' => Languages::getNames(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'gender' => ['in:male,female'],
            'country' => ['required', 'string', 'size:2'],
        ]);
        // هنجيب بيانات اليوزر الي عامل تسجيل دخول ونبعتها بس من الريكويست
        $user = $request->user();


        $user->profile->fill( $request->all() )->save();

        return redirect()->route('dashboard.profile.edit')
            ->with('success', 'Profile updated!');

// الكود ده علشان نعمل فاليديشن لو الريكويست ده موجود اعمله ابديت لو مش موجود اعمله
//  والي فوق اختصار ليه
        // $profile = $user->profile;
        // if ($profile->first_name) {
        //     $profile->update($request->all());
        // } else {
            // ميرج يعني اعمل يوزر ايدي جديد
        //     // $request->merge([
        //     //     'user_id' => $user->id,
        //     // ]);
        //     // Profile::create($request->all());
// السطر ده بدل الميرج ومعناه كريت بروفايل جديد و هات اليوزر اي دي من جدول اليوزر و ضيفه بس لازم تكون عامل بين الجدولين علاقع 1الي1
        //     $user->profile()->create($request->all());
        // }

        
    }
}
