<?php

namespace App\Http\Controllers\Api;

use App\Models\BaseModel;
use App\Traits\HasCrudAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\RouteDiscovery\Attributes\DoNotDiscover;
use Spatie\RouteDiscovery\Attributes\Route;

#[DoNotDiscover]
class BaseCrudController extends BaseController
{
    protected BaseModel $model;

    #[DoNotDiscover]
    public function __construct()
    {
        $this->model = new $this->class;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);

        $query = $this->model->query();
        $query = $this->applyFilterable($query, $request);

        $data = $query->orderByDesc('updated_at')->paginate(10, ['*'], 'page', $page);


        return $this->sendResponse($data, 'Data return successfully.');
    }

    #[Route(method: 'POST')]
    public function create(Request $request)
    {
        $rules = $this->validateRequest($request);

        if ($rules) {
            return $rules;
        }

        $model = $this->saveAction($this->model, $request);

        return $this->sendResponse($model, 'Data created successfully.', 201);

    }

    #[Route(uri: '{id}', method: ['PUT', 'POST'])]
    public function update($id, Request $request)
    {
        $model = $this->model->find($id);

        if (!$model) {
            return $this->sendError('Data not found', [], 404);
        }

        $model = $this->saveAction($model, $request);

        return $this->sendResponse($model, 'Data updated successfully.');
    }

    #[Route(uri: '{id}', method: 'DELETE')]
    public function delete($id)
    {
        $model = $this->model->find($id);

        if (!$model) {
            return $this->sendError('Data not found', [], 404);
        }

        $model->delete();

        return $this->sendResponse($model, 'Data deleted successfully.');
    }

    protected function saveAction($model, Request $request)
    {
        $isValidate = $this->validateRequest($request);

        if ($isValidate) {
            return $isValidate;
        }

        $payload = $this->transformRequestData($request);
        $model->fill($payload);
        $model->save();
        return $model;
    }

    #[Route(uri: '{id}')]
    public function detail($id)
    {
        $data = $this->model->find($id);

        if (!$data) {
            return $this->sendError('Data not found', [], 404);
        }

        return $this->sendResponse($data, 'Data return successfully.');
    }

    protected function transformRequestData(Request $request)
    {
        return Arr::only($request->all(), $this->model->getFillable());
    }

    protected function applyFilterable($query, $request)
    {
        $filterable = $this->model->getFilterable();

        foreach ($filterable as $value) {
            if ($request->has($value)) {
                $query->whereRaw("$value::text ilike ?", ["%{$request->get($value)}%"]);
            }
        }

        return $query;
    }
}