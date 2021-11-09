<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PagarMe\Client;

class Teste extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $pagarme = new Client('ak_test_nE14ZiG433nQG0D3aR0XhpzCj4iPkR');

        $transaction = $pagarme->transactions()->create([
            'amount' => '2000',
            'card_hash' => '4658941_v0FrQgy3FFy+7a0zYl6ltVMR8PzInnHTaKg/My4wJX1ruPrBTx3gh7+WrHHeAppewmeMdfRdQfierEzkmW7phRv6NT/KQHjEcwBm8pU+OVP+WgWDsVBhzRm7CL6pDIuxS4xaM+bTPomhOcQOQb98YPseJak1iSu2x0/cy1v4a1PItptGbovMOzIUu++1ax284/JKXYuthN1NZqdEcSu6GlPxKv55gmApSCtq5RNJEjs8VRfcq/oGCFAWn6TV8DvJGIXKj58RJxrAqom2AlL3xZdIYwPZCvb/qHaXw5/iHaj+R7tUq1eBzgTbCnE3nvCJvMtqwouoC9V+P6jjBI6hJQ==',
            'async' => false
        ]);

        dd($transaction);
    }
}
