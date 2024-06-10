<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

use App\Article;

class ArticleController extends AdminController
{
    protected $uploadPath;

    public function __construct()
    {
        parent::__construct();
        $this->uploadPath = public_path('storage/images/articles');
    }

    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('panel.articles.index', compact('articles'));
    }

    public function create(Article $article)
    {
        return view('panel.articles.create', compact('article'));
    }

    public function store(Request $request)
    {
        $data = $this->handleRequest($request);
        Article::create($data);
        return redirect('/panel/articles')->with('success', 'با موفقیت افزوده شد!');
    }

    private function handleRequest($request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = $image->getClientOriginalName();
            $destination = $this->uploadPath;
            $image->move($destination, $fileName);
            $data['image'] = $fileName;
        }
        // $message = $request->input('content');
        // $dom = new \DomDocument();
		// $dom->loadHtml(mb_convert_encoding($message, 'HTML-ENTITIES', "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
		// $images = $dom->getElementsByTagName('img');
		// foreach($images as $img){
		// 	$src = $img->getAttribute('src');
		// 	if(preg_match('/data:image/', $src)){
		// 		preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
		// 		$mimetype = $groups['mime'];
		// 		$filename = uniqid();
		// 		$filepath = "/storage/images/$filename.$mimetype";
		// 		$image = Image::make($src)
		// 		  ->encode($mimetype, 100)
		// 		  ->save(public_path($filepath));
				
		// 		$new_src = asset($filepath);
		// 		$img->removeAttribute('src');
		// 		$img->setAttribute('src', $new_src);
		// 	}
        // }
        // $data['content'] = $dom->saveHTML();
        return $data;
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('panel.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $this->handleRequest($request);
        $article->update($data);
        return redirect('/panel/articles')->with('success', 'با موفقیت بروزرسانی شد!');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('/panel/articles')->with('success', 'با موفقیت حذف شد!');
    }
}
