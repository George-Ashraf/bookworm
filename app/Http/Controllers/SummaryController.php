<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\book;
use App\Models\summary;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    use attachfiletrait;

    public function __construct()
    {
        $this->middleware('auth:admin,web');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $book = book::findOrFail($id);
        return view('summary.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'written_summary' => 'file|max:40000|mimes:pdf|nullable',
            'video_summary' => 'file|max:40000|mimes:mp4|nullable',
            'voice_summary' => 'file|max:40000|mimes:mp3,wav|nullable',
            'novel_film_link' => 'nullable|string',
            'format' => 'required',



        ]);
        $summary = new summary();
        $summary->format = $request->format;
        $summary->book_id = $request->book_id;
        $summary->novel_film_link = $request->novel_film_link;

        $summary->admin_id = auth()->user()->id;





        if ($summary->format == 'written_summary') {
            $request->validate([
                'written_summary' => 'file|max:4096|mimes:pdf|required',


            ]);

            $summary->written_summary =    $request->file('written_summary')->getClientOriginalName();
        } elseif ($summary->format == 'video_summary') {
            $request->validate([
                'video_summary' => 'file|max:40000|mimes:mp4|required',



            ]);
            $summary->video_summary =    $request->file('video_summary')->getClientOriginalName();
        } elseif ($summary->format == 'voice_summary') {
            $request->validate([
                'voice_summary' => 'file|max:40000|mimes:mp3,wav|required',




            ]);
            $summary->voice_summary =    $request->file('voice_summary')->getClientOriginalName();
        } elseif ($summary->format == 'written_summary&video_summary&voice_summary') {
            $request->validate([
                'written_summary' => 'file|max:40000|mimes:pdf|required',
                'video_summary' => 'file|max:40000|mimes:mp4|required',
                'voice_summary' => 'file|max:40000|mimes:mp3,wav|required',




            ]);
            $summary->written_summary =    $request->file('written_summary')->getClientOriginalName();
            $summary->video_summary =    $request->file('video_summary')->getClientOriginalName();
            $summary->voice_summary =    $request->file('voice_summary')->getClientOriginalName();
        } elseif ($summary->format == 'written_summary&video_summary') {
            $request->validate([
                'written_summary' => 'file|max:40000|mimes:pdf|required',
                'video_summary' => 'file|max:40000|mimes:mp4|required',




            ]);
            $summary->written_summary =    $request->file('written_summary')->getClientOriginalName();
            $summary->video_summary =    $request->file('video_summary')->getClientOriginalName();
        } elseif ($summary->format == 'written_summary&voice_summary') {
            $request->validate([
                'written_summary' => 'file|max:40000|mimes:pdf|required',
                'voice_summary' => 'file|max:40000|mimes:mp3,wav|required',




            ]);
            $summary->written_summary =    $request->file('written_summary')->getClientOriginalName();
            $summary->voice_summary =    $request->file('voice_summary')->getClientOriginalName();
        } elseif ($summary->format == 'video_summary&voice_summary') {
            $request->validate([
                'video_summary' => 'file|max:40000|mimes:mp4|required',
                'voice_summary' => 'file|max:40000|mimes:mp3,wav|required',




            ]);
            $summary->video_summary =    $request->file('video_summary')->getClientOriginalName();
            $summary->voice_summary =    $request->file('voice_summary')->getClientOriginalName();
        }






        $summary->save();
        $book = book::findOrFail($request->book_id);
        $book->summary = 'done';
        $book->save();


        if ($summary->format == 'written_summary') {

            $this->uploadFile($request, 'written_summary', 'summary' . $summary->id);
        } elseif ($summary->format == 'video_summary') {

            $this->uploadFile($request, 'video_summary', 'summary' . $summary->id);
        } elseif ($summary->format == 'voice_summary') {

            $this->uploadFile($request, 'voice_summary', 'summary' . $summary->id);
        } elseif ($summary->format == 'written_summary&video_summary&voice_summary') {

            $this->uploadFile($request, 'written_summary', 'summary' . $summary->id);
            $this->uploadFile($request, 'video_summary', 'summary' . $summary->id);
            $this->uploadFile($request, 'voice_summary', 'summary' . $summary->id);
        } elseif ($summary->format == 'written_summary&video_summary') {

            $this->uploadFile($request, 'written_summary', 'summary' . $summary->id);
            $this->uploadFile($request, 'video_summary', 'summary' . $summary->id);
        } elseif ($summary->format == 'written_summary&voice_summary') {

            $this->uploadFile($request, 'written_summary', 'summary' . $summary->id);
            $this->uploadFile($request, 'voice_summary', 'summary' . $summary->id);
        } elseif ($summary->format == 'video_summary&voice_summary') {

            $this->uploadFile($request, 'video_summary', 'summary' . $summary->id);
            $this->uploadFile($request, 'voice_summary', 'summary' . $summary->id);
        }



        return redirect()->route('product.show', $request->book_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function download_audio($filename, $id)
    {
        $summary = summary::findOrFail($id);
        return response()->download(public_path('attachments/' . 'summary' . $summary->id . '/' . $filename));
    }
    public function download_written($filename, $id)
    {
        $summary = summary::findOrFail($id);

        return response()->download(public_path('attachments/' . 'summary' . $summary->id . '/' . $filename));
    }
    public function download_video($filename, $id)
    {
        $summary = summary::findOrFail($id);

        return response()->download(public_path('attachments/' . 'summary' . $summary->id . '/' . $filename));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $summary = summary::findOrFail($id);
        return view('summary.edit', compact('summary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'written_summary' => 'file|max:40000|mimes:pdf|nullable',
            'video_summary' => 'file|max:40000|mimes:mp4|nullable',
            'voice_summary' => 'file|max:40000|mimes:mp3,wav|nullable',
            'novel_film_link' => 'nullable|string',



        ]);
        $summary = summary::findOrFail($id);
        $summary->novel_film_link = $request->novel_film_link;
        $summary->admin_id = auth()->user()->id;

        if ($request->hasfile('written_summary')) {

            $this->deleteFile($summary->written_summary, 'summary' . $summary->id);

            $this->uploadFile($request, 'written_summary', 'summary' . $summary->id);

            $written_summary_new =  $request->file('written_summary')->getClientOriginalName();

            $summary->written_summary = $summary->written_summary !== $written_summary_new ? $written_summary_new : $summary->written_summary;
        }
        if ($request->hasfile('video_summary')) {

            $this->deleteFile($summary->video_summary, 'summary' . $summary->id);

            $this->uploadFile($request, 'video_summary', 'summary' . $summary->id);

            $video_summary_new =  $request->file('video_summary')->getClientOriginalName();

            $summary->video_summary = $summary->video_summary !== $video_summary_new ? $video_summary_new : $summary->video_summary;
        }
        if ($request->hasfile('voice_summary')) {

            $this->deleteFile($summary->voice_summary, 'summary' . $summary->id);

            $this->uploadFile($request, 'voice_summary', 'summary' . $summary->id);

            $voice_summary_new =  $request->file('voice_summary')->getClientOriginalName();

            $summary->voice_summary = $summary->voice_summary !== $voice_summary_new ? $voice_summary_new : $summary->voice_summary;
        }
        $summary->save();
        return redirect()->route('product.show', $summary->book_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\summary  $summary
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $summary = summary::findOrFail($id);
        $summary->delete();
        $book = book::findOrFail($summary->book_id);
        $book->summary = 'none';
        $book->save();
        $this->deleteFile($summary->written_summary, 'summary' . $summary->id);
        $this->deleteFile($summary->video_summary, 'summary' . $summary->id);
        $this->deleteFile($summary->voice_summary, 'summary' . $summary->id);
        return redirect()->route('product.show', $summary->book_id);
    }

}
