<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Mail about new product
 */
class NewProductMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function build()
    {
        return $this->view('mail', [
            'product' => $this->product,
        ]);
    }
}
