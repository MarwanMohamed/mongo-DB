<?php

namespace App\Http\Controllers;

use App\Pagination;
use Illuminate\Http\Request;
use App\MongoDb;

class collectionsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    
    public function index()
    {
    	$collections = MongoDb::collections();
    	return view('collections.show', compact('collections'));
    }

    public function create()
    {
        return view('collections.create');
    }

    public function edit($coll, $id)
    {
        $document = MongoDb::getByID($coll, $id);
        $document = json_encode($document);
        $document = str_replace('"_id":{},', '', $document);
        return view('collections.edit', compact('document'));
    }

    public function update(Request $request, $coll, $id)
    {
        $this->validate($request, ['document' => 'required']);
        $document = $request->document;
        $document = json_decode($document, true);
        MongoDb::update($coll, $id, $document);
        return redirect('documentation/'.$coll)->with('success', 'Edit Successfuly');
    }

    public function store(Request $request, $coll)
    {
        $this->validate($request, ['document' => 'required']);
        $document = $request->document;
        $document = json_decode($document, true);        
        MongoDb::insert($coll , $document);
        return redirect('documentation/'.$coll)->with('success', 'Added Successfuly');
    }

    public function documention($name)
    {
        $total = MongoDb::CountTotal($name);
        $currentPage = !empty ($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 50;
        $pagination = new Pagination($perPage, $currentPage, $total);
        $paginate = MongoDb::pagination($name, $perPage, $pagination);
        return view('collections.documention', compact('paginate', 'pagination', 'currentPage', 'name'));
    }

    public function byID($name, $id) {
        $document = MongoDb::getByID($name, $id);
        return view('collections.oneDocument', compact('document'));
    }
    

    public function destroy($coll , $id)
    {
        MongoDb::delete($coll, $id);
        return back();
    }
}
