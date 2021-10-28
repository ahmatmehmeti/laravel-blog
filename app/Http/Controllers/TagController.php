<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Repositories\TagRepository;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
       $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = $this->tagRepository->getTags();
        return view('tags.index', compact('tags'));
    }

    public function store(StoreTagRequest $request)
    {
        $this->tagRepository->createTag($request->validated());
        return redirect()->route('tags.index');
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->findTag($id);
        return view('tags/edit',compact('tag'));
    }

    public function update(StoreTagRequest $request,$id)
    {
        $tag = $this->tagRepository->updateTag($id,$request->validated());
        return redirect()->route('tags.index',compact('tag'));
    }

    public function destroy($id)
    {
        $this->tagRepository->deleteTag($id);
        return redirect()->route('tags.index');
    }
}
