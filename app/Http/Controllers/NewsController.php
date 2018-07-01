<?php

namespace App\Http\Controllers;

use App\News;
use App\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_news = News::orderBy('id','desc')->paginate(5);
        return view('news/index',['all_news'=>$all_news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $data = $this->validate(request(),[
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'description' => 'required',
            'photo' =>'required|image',
            'images.*' =>'image'

        ]);


        $data['user_id'] = auth()->user()->id;
            $tempFolder = time();
            $data['photo'] = $request->file('photo')->store('image/'.$tempFolder);
            $news = News::create($data);
           // dd($news->id);

        foreach ($request->file('images') as $image){
            Storage::makeDirectory('image/'.$news->id);
            $uploadedImage = $image->store('image/'.$news->id);
            Images::create([
                'user_id'    => auth()->user()->id,
                'news_id'    => $news->id,
                'path'       => 'image/'.$news->id,
                'image'      => $uploadedImage,
                'size'       => Storage::size($uploadedImage),
                'image_name' => $image->getClientOriginalName(),
            ]);

        }
            $newName = str_replace($tempFolder, $news->id, $news['photo']);
            Storage::rename($news['photo'], $newName);
            News::where('id', $news->id)->update(['photo'=>$newName]);
            Storage::deleteDirectory('image/'.$tempFolder);


        session()->flash('success','News Added Successfully');
        return redirect('news');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('news.edit',['news'=>$news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::find($id)->delete();

        Storage::deleteDirectory('image/'.$id);
        session()->flash('success','News Deleted Successfully');
        return redirect('news');
    }
}
