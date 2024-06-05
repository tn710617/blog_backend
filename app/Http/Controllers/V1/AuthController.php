<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalletToBeSignedMessage;
use App\Services\Web3Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function isLoggedIn()
    {
        return response()->noContent();
    }

    public function loginWithMetaMask(Request $request, Web3Service $web3Service)
    {
        $input = $request->validate([
            'signature' => ['required', 'string'],
            'address' => ['required']
        ]);

        abort_unless(in_array($input['address'], config('custom.admin_wallet_addresses', [])),
            Response::HTTP_UNAUTHORIZED);

        $toBeSignedMessage = WalletToBeSignedMessage::where('wallet_address',
            $input['address'])->valueOrFail('to_be_signed_message');

        abort_unless(filled($toBeSignedMessage) && $web3Service->verifySignature($toBeSignedMessage,
                $input['signature'],
                $input['address']), Response::HTTP_UNAUTHORIZED);

        $user = User::firstOrCreate([
            'wallet_address' => $input['address'],
            'role' => User::ROLE_ADMIN
        ]);

        Auth::guard('web')->login($user);

        return response()->noContent();
    }

    public function getToBeSignedMessage(Request $request)
    {
        $nonce = Str::random();

        $walletAddress = $request->input('wallet_address');

        $message = __('loginMessage.to_be_signed_message', ['nonce' => $nonce]);

        WalletToBeSignedMessage::updateOrCreate([
            'wallet_address' => $walletAddress
        ], [
            'to_be_signed_message' => $message
        ]);


        return [
            'data' => [
                'to_be_signed_message' => $message
            ]
        ];
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return response()->noContent();
    }

}
