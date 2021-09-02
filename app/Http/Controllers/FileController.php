<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = DB::table('files')->get();

        return view('file.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('file.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|max:2048',
        ]);

        $fileOriginalName = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $filetype = $request->file('file')->getClientOriginalExtension();

        DB::table('files')->insert([
            'filename' => $filename,
            'filetype' => $filetype
        ]);

        $request->file('file')->storeAs('/files', $fileOriginalName, 'uploads');

        return back()->with('file_uploaded', 'File has been uploaded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //filetypes
        $image = ['jpg', 'jpeg', 'jfif', 'png', 'gif'];
        $document = ['doc', 'docx', 'pdf', 'ppt'];

        //fetching the file to be viewed
        $file = DB::table('files')->where('id', $id)->first();
        $filename = $file->filename;
        $fileOriginalName = $filename . '.' . $file->filetype;

        //if file is not an image
        if(! in_array($file->filetype, $image)){
            $filepath = "../../img/docThumnail.png";
            return view('file.show', compact('file', 'filepath'));
        }

        //images as default file
        $filepath = "uploads/files/" . $fileOriginalName;
        return view('file.show', compact('file', 'filepath'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //filetypes
        $image = ['jpg', 'jpeg', 'jfif', 'png', 'gif'];
        $document = ['doc', 'docx', 'pdf', 'ppt'];

        //fetching the file to be viewed
        $file = DB::table('files')->where('id', $id)->first();
        $filename = $file->filename;
        $fileOriginalName = $filename . '.' . $file->filetype;

        //if file is not an image
        if(! in_array($file->filetype, $image)){
            $filepath = "../../img/docThumnail.png";
            return view('file.edit', compact('file', 'filepath'));
        }

        //images  as default file
        $filepath = "uploads/files/" . $fileOriginalName;
        return view('file.edit', compact('file', 'filepath'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        $validatedData = $request->validate([
            'filename' => 'required'
        ]);

        //rename the file on the directory
        $file = DB::table('files')->where('id', $request->id)->first();
        $old_name = $file->filename . '.' . $file->filetype;
        $new_name = $request->filename. '.' . $file->filetype;

        Storage::disk('uploads')->move('files/' . $old_name, 'files/' . $new_name);

        //rename on database
        DB::table('files')->where('id', $request->id)->update([
            'filename' => $request->filename,
            'updated_at' => Carbon::now()
        ]);
        return back()->with('file_updated', 'File has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        $filename = $file->filename;
        $fileOriginalName = $filename . '.' . $file->filetype;
        Storage::disk('uploads')->delete('files/' . $fileOriginalName);

        DB::table('files')->where('id', $file)->delete();

        $file->delete();

        return back()->with('success', 'File has been deleted!');
    }
}
