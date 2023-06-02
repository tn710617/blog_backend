<?php

namespace App\Services;

use Elliptic\EC;
use Illuminate\Support\Str;
use kornrunner\Keccak;

class Web3Service
{
    public function signMessage($message, $privateKey): string
    {
        $ec = new EC('secp256k1');

        $ecPrivateKey = $ec->keyFromPrivate($privateKey, 'hex');

        $message = "\x19Ethereum Signed Message:\n".strlen($message).$message;

        $hash = Keccak::hash($message, 256);

        $signature = $ecPrivateKey->sign($hash, ['canonical' => true]);

        $r = str_pad($signature->r->toString(16), 64, '0', STR_PAD_LEFT);
        $s = str_pad($signature->s->toString(16), 64, '0', STR_PAD_LEFT);
        $v = dechex($signature->recoveryParam + 27);

        return "0x$r$s$v";
    }

    public function verifySignature(string $message, string $signature, string $address): bool
    {
        try {
            $hash = Keccak::hash(sprintf("\x19Ethereum Signed Message:\n%s%s", strlen($message), $message), 256);
            $sign = [
                'r' => substr($signature, 2, 64),
                's' => substr($signature, 66, 64),
            ];
            $recid = ord(hex2bin(substr($signature, 130, 2))) - 27;

            if ($recid != ($recid & 1)) {
                return false;
            }

            $pubkey = (new EC('secp256k1'))->recoverPubKey($hash, $sign, $recid);
            $derived_address = '0x'.substr(Keccak::hash(substr(hex2bin($pubkey->encode('hex')), 1), 256), 24);

            return Str::lower($address) === $derived_address;
        } catch (\Throwable $throwable) {
            report($throwable);

            return false;
        }
    }

}