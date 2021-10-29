<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Repositories\TagRepository;
use Illuminate\Support\Facades\Session;

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
        Session::flash('success', 'Tag created successfully');
        return redirect()->route('tags.index');
    }

    public function edit($id)
    {
        $tag = $this->tagRepository->findTag($id);
        return view('tags/edit',compact('tag'));
    }

    public function update(StoreTagRequest $request,$id)
    {
        $this->tagRepository->updateTag($id,$request->validated());
        Session::flash('success', 'Tag updated successfully');
        return redirect()->route('tags.index');
    }

    public function destroy($id)
    {
        $this->tagRepository->deleteTag($id);
        Session::flash('success', 'Tag deleted successfully');
        return redirect()->route('tags.index');
    }
}
