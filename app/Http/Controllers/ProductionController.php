<?php namespace rbs\Http\Controllers;

use rbs\Models\Production;
use rbs\Models\Theatre;

use Illuminate\Http\Request;
use Input;
use rbs\Http\Requests;


class ProductionController extends Controller {

	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$productions = Production::all();
		return view('production/index')->with('productions', $productions);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $theatres = Theatre::get_all_theatres();
		return view('production/create')->with('theatres', $theatres);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request, [
            'name' => 'required',
            'close_date' => 'required',
            'group_tickets_amount' => 'required',
        ]);

        $input = Input::all();

        $production = Production::updateOrCreate($input );
        return redirect()->route('productions.show', [$production->id])
                         ->with('message', 'Production ' . $input['name'] . ' successfully created.');

    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('production/show')->with('ticket_totals', Production::get_ticket_totals($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $production = Production::find($id);
        $theatres = Theatre::get_all_theatres();
        return view('production/edit')->with('theatres', $theatres)
                                      ->with('production', $production);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $this->validate($request, [
            'name' => 'required',
            'close_date' => 'required',
            'group_tickets_amount' => 'required',
        ]);


        $input = array_except(Input::all(), ['_method', '_token']);

        $production = Production::updateOrCreate($input);
        return redirect()->route('productions.show', [$production->id])
                         ->with('message', 'Production ' . $input['name'] . ' successfully updated.');
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
