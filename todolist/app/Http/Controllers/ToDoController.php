<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Item;
use Session;

class ToDoController extends Controller
{
	
    public function index()
    {
    	$items = User::find(Auth::id())->items;
    	return view('todo.index' , array(
    		'items' => $items
    		));
    }

    public function postIndex() {
        $id = Input::get('item_id');
        $item = Item::findOrFail($id);
        $userId = Auth::id();
        if ($item->user_id == $userId) {
            $item->mark();
        }
        return Redirect::route('todo');
    }

    public function getNew() {
        return view('todo.new');
    }

    public function postNew() {
        $rules = array(
            'name' => 'required|min:5|max:255');
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('new-task')->withErrors($rules);
        }
        $item = new Item();
        $item->name = Input::get('name');
        $item->user_id = Auth::id();
        $item->done = false;
        $item->save();
        return redirect()->route('todo');
    }

    public function storeTasks(Request $request) {
        if(Input::get('newTaskName') == null)
        {
            $id = Input::get('item_id');
            $item = Item::findOrFail($id);
            $userId = Auth::id();
            if ($item->user_id == $userId) {
                $item->mark();
            }
            return Redirect::route('todo');
        }
        else {
            $this->validate($request, [
                'newTaskName' => 'required|min:5|max:255',
            ]);
            $item = new Item();
            $item->name = Input::get('newTaskName');
            $item->user_id = Auth::id();
            $item->done = false;
            $item->save();
            Session::flash('success', 'New task was successfully added');
            return redirect()->route('todo');
        }
    }

    public function getDelete(Item $item) {
        if($item->user_id == Auth::id()) {
            $item->delete();
        }
        return redirect()->route('todo');
    }

    public function edit($id) {
        $item = Item::find($id);
        return view('todo.edit')->with('itemUnderEdit', $item);
    }

    public function update(Request $request, $id){
        $item = Item::find($id);
        $item->name = $request->updatedItemName;
        $item->save();
        return redirect()->route('todo');
    }
}
