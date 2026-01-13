<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService,
        protected UserRepository $userRepository,
    ) {}

    public function index(Request $request)
    {
        $users = $this->userRepository->getAll($request->all());

        return view('pages.users.index', compact('users'));
    }
}
