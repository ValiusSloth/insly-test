<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserIndexRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * @param UserService $userService The user service instance.
     */
    public function __construct(private UserService $userService) {}

    /**
     * List all users.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(UserIndexRequest $request): JsonResponse
    {
        $perPage = (int) $request->input('per_page', 15);
        return UserResource::collection($this->userService->getAll($perPage))->response();
    }

    /**
     * Store a new user.
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request): JsonResponse
    {
        $user = $this->userService->create($request->validated());
        return (new UserResource($user))->response()->setStatusCode(201);
    }

    /**
     * Show user by id.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $user = $this->userService->getById($id);
        return (new UserResource($user))->response();
    }

    /**
     * Update the specified user.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, int $id): JsonResponse
    {
        $user = $this->userService->update($id, $request->all());
        return (new UserResource($user))->response();
    }

    /**
     * Remove the specified user.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->userService->delete($id);
        return response()->json(null, 204);
    }
}
