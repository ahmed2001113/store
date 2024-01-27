<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokensController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
            'device_name' => 'string|max:255',
            'abilities' => 'nullable|array'
        ]);
// لازم موديل اليوزر يكون عامل امبورت للابي اي اكسس توكين
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // لو بعت اسم الجهاز نكتبه ولو مبعتوش هنجيبه من اليوارال 
            $device_name = $request->post('device_name', $request->userAgent());
            // اسم التوكين و الصلاحيات بتاعت اليوزر ولو شم عاملين صلاحيات مش هكتبها
            $token = $user->createToken($device_name, $request->post('abilities'));

            return Response::json([
                'code' => 1, // ممكن تنشا كود معين بين انت و الي هيستخدم الابي اي
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);

        }

        return Response::json([
            'code' => 0,
            'message' => 'Invalid credentials',
        ], 401);
        
    }

    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();

        //لو عايز احذف كل التوكين الي تخص اليوزر 
        // Revoke all tokens
        // $user->tokens()->delete();

// لو مبعتش توكين هنجيب التوكين الحاليه لليوزر ونحذفها
        if (null === $token) {
            // كارينت اكسس توكين دي فانكشن موجوده تلقائي
            $user->currentAccessToken()->delete();
            return;
        }
// فايند توكين دي فانكشن بتجيب التوكين مشفره من الداتابيز وتفك لتشفير
        $personalAccessToken = PersonalAccessToken::findToken($token);
        // كونديشن علشان نتأكد ان التوكين تخص اليوزر الي عايزين نحذف التوكين بتاعته
        if (
            $user->id == $personalAccessToken->tokenable_id 
            && get_class($user) == $personalAccessToken->tokenable_type
        ) {
            $personalAccessToken->delete();
        }
    }
}
