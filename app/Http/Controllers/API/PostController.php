<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepositoryEloquent as PostRepo;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Validator;

class PostController extends Controller
{
    protected $postRepo;

    public function __construct(PostRepo $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    // get list posts
    public function getAll()
    {
        try {
            $posts = $this->postRepo->all();
            return $this->success($posts);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    //    create
    public function create(PostRequest $request)
    {
        try {
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $post = $this->postRepo->create($data);
            return $this->success($post);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    /**
     * update abc
     */
    public function update(PostRequest $request)
    {
        try {
            $data = $request->all();
            $id = $request['id'];
            $rules = array_merge($request->rules(), ['id' => 'required']);
            $validator = Validator::make($data, $rules);
            if ($validator->fails()) {
                return $this->error($validator->errors(), 422);
            } else {
                $post = $this->postRepo->update($data, $id);
                return $this->success($post);
            }
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    // delete
    public function delete($id)
    {
        try {
            $this->postRepo->delete($id);
            return $this->success("Delete success");
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    // get post by id
    public function getById($id)
    {
        try {
            $post = $this->postRepo->find($id);
            return $this->success($post);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }
}
