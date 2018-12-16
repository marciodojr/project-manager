<?php

namespace App\Http\Controllers\Gitlab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Push;

class Pushes extends Controller
{
    private $push;

    public function __construct(Push $push)
    {
        $this->push = $push;
    }

    /**
     * Load the last $pageSize push entries from database.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageSize = 20;
        $pushes = $this->push->orderBy('id', 'desc')->limit($pageSize)->get();
        return response($pushes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'project.name' => 'required|max:255',
            'user_username' => 'required|max:255',
            'total_commits_count' => 'required|integer|between:1,1000'
        ]);

        $push = $this->push->create([
            'repository_name' => $validatedData['project']['name'],
            'pusher' =>  $validatedData['user_username'],
            'pushed_at' => date('Y-m-d H:i:s'),
            'number_of_commits' => $validatedData['total_commits_count']
        ]);

        return response($push, 201);
    }
}
