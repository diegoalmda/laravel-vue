<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function store(StorePostRequest $request): JsonResponse
    {
        Gate::authorize('create', Post::class);

        $post = $request->user()->posts()->create($request->validated());

        return response()->json($post, 201);
    }

    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id'
        ]);

        $posts = Post::query()
            ->when($request->user_id, fn($query, $userId) => $query->where('user_id', $userId))
            ->with('user:id,name')
            ->latest()
            ->get();

        return response()->json($posts);
    }
}
