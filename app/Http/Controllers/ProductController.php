<?php

namespace App\Http\Controllers;

use App\Enums\Currency;
use App\Enums\HttpStatus;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\BaseController;
use App\Mail\NewProductMail;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Services\Interfaces\MailServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProductController extends BaseController
{
    protected MailServiceInterface $mail_service;

    public function __construct(ProductRepositoryInterface $interface, MailServiceInterface $mail_service)
    {
        parent::__construct($interface);
        $this->mail_service = $mail_service;
    }

    public function store()
    {
        $post = request()->only([
            'name',
            'description',
            'price',
            'currency',
        ]);

        $validation = $this->validate($post, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'price' => 'required|numeric|min:0',
            'currency' => 'required|string|in:' . implode(',', Currency::currencies()),
        ]);

        if ($validation) {
            return $validation;
        }

        DB::beginTransaction();
        try {
            $item = $this->repository->create($post);

            $mail = new NewProductMail($item);
            $this->mail_service->send('fake@example.com', $mail);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->response(null, HttpStatus::INTERNAL_SERVER_ERROR);
        }

        return $this->response(null, HttpStatus::CREATED);
    }

    public function update(int $id)
    {
        $post = request()->only([
            'name',
            'description',
            'price',
            'currency',
        ]);

        $validation = $this->validate($post, [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string|min:10',
            'price' => 'required|numeric|min:0',
            'currency' => 'nullable|string|in:' . implode(',', Currency::currencies()),
        ]);

        if ($validation) {
            return $validation;
        }

        try {
            $this->repository->update($id, $post);
        } catch (NotFoundException $exception) {
            return $this->response(null, HttpStatus::NOT_FOUND);
        } catch (\Exception $exception) {
            return $this->response(null, HttpStatus::INTERNAL_SERVER_ERROR);
        }

        return $this->response(null, HttpStatus::OK);
    }
}
