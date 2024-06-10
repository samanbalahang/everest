<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Download;
use App\DownloadCat;

use Storage;
use URL;
use File;
use Response;

class DownloadController extends Controller
{
    public function index()
    {
        $downloads = Download::orderBy('created_at', 'desc')->paginate(10);
        $cats = DownloadCat::all();
        $mostDownload = Download::orderBy('downloads', 'desc')->take(15)->get();
        return view('site.downloads.index', compact('downloads', 'cats', 'mostDownload'));
    }

    public function show($id, $title)
    {
        $tit = str_replace("-", " ", $title);
        $download = Download::findOrFail($id);
        if ($download->title == $tit) {
            $views = $download->views++;
            $download->update([
                'views' => $views
            ]);
            $cats = DownloadCat::all();
            $mostDownload = Download::orderBy('downloads', 'desc')->take(15)->get();
            $filePath = "/storage/files/downloads/" . $download->file;
            $fileSize = round(File::size(public_path($filePath)) / 1000) / 1000;
            $fileMime = File::extension($filePath);
            return view('site.downloads.show', compact('download', 'cats', 'mostDownload', 'fileUrl', 'fileSize', 'fileMime'));
        } else {
            return abort(404);
        }
    }

    public function category($slug)
    {
        $downloadCat = DownloadCat::where('slug', $slug)->first();
        if ($downloadCat) {
            $views = $downloadCat->views + 1;
            $downloadCat->update([
                'views' => $views
            ]);
            $downloads = Download::where('download_cat_id', $downloadCat->id)->orderBy('created_at', 'desc')->paginate(10);
            $cats = DownloadCat::all();
            $mostDownload = Download::orderBy('downloads', 'desc')->take(15)->get();
            return view('site.downloads.category', compact('downloadCat', 'downloads', 'cats', 'mostDownload'));
        } else {
            return abort(404);
        }
    }

    public function download(Request $request)
    {
        $file = $request->input('file');
        $id = $request->input('id');
        $dl = Download::findOrFail($id);
        $filePath = public_path("/storage/files/downloads/" . $file);
        $dlNum = $dl->downloads + 1;
        $dl->update([
            'downloads' => $dlNum
        ]);
        return Response::download($filePath); 
    }
}
