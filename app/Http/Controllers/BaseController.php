<?php

namespace App\Http\Controllers;

use App\Enums\HttpStatus;
use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

abstract class BaseController extends Controller
{
    /**
     * Repository instance.
     */
    protected BaseRepositoryInterface $repository;

    /**
     * Default pagination limit.
     */
    protected int $limit = 10;

    public function __construct(BaseRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $post = request()->only([
            'limit'
        ]);

        $validation = $this->validate($post, [
            'limit' => 'nullable|integer|min:1|max:100'
        ]);

        if ($validation) {
            return $validation;
        }

        $limit = $post['limit'] ?? $this->limit;
        $items = $this->clearPaginate($this->repository->paginate($limit));
        unset($items['links']);

        return $this->response($items, HttpStatus::OK);
    }

    public function show(int $id)
    {
        try {
            $item = $this->repository->find($id);
        } catch (NotFoundException $exception) {
            return $this->response(null, HttpStatus::NOT_FOUND);
        } catch (\Exception $exception) {
            return $this->response(null, HttpStatus::INTERNAL_SERVER_ERROR);
        }

        return $this->response($item, HttpStatus::OK);
    }

    public function delete(int $id)
    {
        try {
            $this->repository->delete($id);
        } catch (NotFoundException $exception) {
            return $this->response(null, HttpStatus::NOT_FOUND);
        } catch (\Exception $exception) {
            return $this->response(null, HttpStatus::INTERNAL_SERVER_ERROR);
        }

        return $this->response(null, HttpStatus::NO_CONTENT);
    }

    /**
     * Validate, and returns error response if validation fails (and null otherwise)
     */
    protected function validate(array $data, array $rules): ?JsonResponse
    {
        $validation = Validator::make($data, $rules);

        if ($validation->fails()) {
            return $this->response($validation->failed(), HttpStatus::ERROR_VALIDATION);
        }

        return null;
    }

    /**
     * Prepare response
     */
    protected function response($data, HttpStatus $status): JsonResponse
    {
        return response()->json($data, $status->value);
    }

    /**
     * Clear default laravel pagination, to be less memory consuming 
     */
    protected function clearPaginate($pagination): array
    {
        $pagination = $pagination->toArray();
        unset($pagination['links']);
        return $pagination;
    }
}
