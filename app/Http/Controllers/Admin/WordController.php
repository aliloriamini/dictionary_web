<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\word;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SoapClient;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = User::find(Auth::user()->id)->words()->paginate(20);
        return view('admin/words/all' , compact('words'));
    }

    public function search(Request $request){
        $request_type =  (string) '%'.$request->search.'%';
//        $words = DB::select('SELECT * FROM words WHERE (words LIKE ? || meaning LIKE ?) && user_id = ?', [$request_type,$request_type,Auth::user()->id]);
        $words = word::search($request_type);
        return view('admin/words/all' , compact('words'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/words/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = new SoapClient("http://localhost/web-service/webservice-server.php?wsdl");
        $params = $request->words;
        $response = $client->__soapCall("upperCase_word", array($params));
        $response = str_replace_first("\"",'',$response);
        $response = str_replace_last("\"",'',$response);
        word::create([
            'user_id' => Auth::user()->id,
            'words' => $response,
            'meaning' => request('meaning')
        ]);
        return redirect(route('word.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\word  $word
     * @return \Illuminate\Http\Response
     */
    public function show(word $word)
    {
        return view('admin/words/show' , compact('word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(word $word)
    {
        return view('admin/words/edit' , compact('word'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\word  $word
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, word $word)
    {
        $client = new SoapClient("http://localhost/web-service/webservice-server.php?wsdl");
        $params = $request->words;
        $response = $client->__soapCall("upperCase_word", array($params));
        $response = str_replace_first("\"",'',$response);
        $response = str_replace_last("\"",'',$response);
        $word->update([
            'user_id' => Auth::user()->id,
            'words' => $response,
            'meaning' => request('meaning')
        ]);
        return redirect(route('word.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(word $word)
    {
        $word->delete();
        return redirect(route('word.index'));
    }
}
