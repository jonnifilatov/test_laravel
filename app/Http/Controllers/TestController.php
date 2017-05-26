<?php namespace App\Http\Controllers;

use App\Composit;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class TestController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('task_list');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
		$descr = $request->input('descr');
		if(isset($descr)){
			$task = Task::create(['name'=>$descr]);
			$id = $task->id;
			$composit = new Composit();
			$composit->task_id = $id;
			$composit->parent_id = null;
			$composit->descr = $descr;
			$composit->save();
		}
		$task_list = Task::all();
		return array('task_list'=>$task_list);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$root = Composit::where('task_id', $id)->whereNull('parent_id')->first();
		return view('composit_show', ['root_name'=>$root->descr, 'root_id'=>$root->id, 'task_id'=>$id]);

	}

	public function element_list(Request $request){
		$task_id = $request->input('task_id');
		$parent_id = $request->input('parent_id');
		$descr = $request->input('descr');
		if(isset($parent_id) && isset($descr)){
			$composit = new Composit();
			$composit->task_id = $task_id;
			$composit->parent_id = $parent_id;
			$composit->descr = $descr;
			$composit->save();
		}
		$element_list = Composit::where('task_id', $task_id)->orderBy('id')->get();
		return array('element_list'=>$element_list);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
