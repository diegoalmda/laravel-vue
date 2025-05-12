<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Redirect;


class PostController extends Controller
{
    public function store(StorePostRequest $request): RedirectResponse
    {
        Gate::authorize('create', Post::class);

        $post = $request->user()->posts()->create($request->validated());

        return Redirect::route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    public function index(Request $request): Response
    {
        $request->validate([
            'user_id' => 'sometimes|integer|exists:users,id'
        ]);

        $posts = Post::query()
            ->when($request->user_id, fn($query, $userId) => $query->where('user_id', $userId))
            ->with('user:id,name')
            ->latest()
            ->get();

            return Inertia::render('Posts/Index', [
                'posts' => $posts,
            ]);
    }

    public function create(Request $request)
    {
        Gate::authorize('create', Post::class);

        return Inertia::render('Posts/Create');
    }
}
