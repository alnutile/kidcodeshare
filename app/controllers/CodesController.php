<?php

class CodesController extends \BaseController {

    /**
     * @var \CodeShare\CodeService
     */
    private $codeService;

    public function __construct(\CodeShare\CodeService $codeService)
    {

        $this->codeService = $codeService;
    }


    /**
     * @Get(/mine/{user_id})
     */
    public function mine($user_id)
    {
        $code = Code::where('user_id', $user_id)->get();
        $account = getenv('git_user');
        return View::make('codes.index', compact('code', 'account'));
    }


	/**
	 * Show the form for creating a new resource.
	 * GET /codes/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('codes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /codes
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), Code::$rules);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to('codes/create')->withErrors($validator)->withInput();
        }

        try
        {
            $results = $this->codeService->post(Input::all());
            $here = link_to('codes/' . $results->id, 'here', $attributes = array(), $secure = null);
            Session::flash('notice', "New Code Submitted visit it $here");
            return Redirect::to('codes');
        }
        catch(\Execption $e)
        {
            return Redirect::to('codes/create')->withMessage($e->getMessage());
        }
	}

	/**
	 * Display the specified resource.
	 * GET /codes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $code = Code::find($id);
        $account = getenv('git_user');
        return View::make('codes.show', compact('code', 'account'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /codes/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$code = Code::findOrFail($id);
        $gist = $this->codeService->getGist($code->gist_id);
        return View::make('codes.edit', compact('code', 'gist'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /codes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Make sure only owner can save this
        $validator = Validator::make(Input::all(), Code::$rules);

        if($validator->fails())
        {
            $messages = $validator->messages();
            return Redirect::to("codes/$id/edit")->withErrors($validator)->withInput();
        }

        try
        {
            $results = $this->codeService->updateGist($id, Input::all());
            $here = link_to('codes/' . $id, 'here', $attributes = array(), $secure = null);
            Session::flash('notice', "Updated Code click $here to visit it.");
            return Redirect::to('/');
        }
        catch(\Execption $e)
        {
            return Redirect::to('/')->withMessage($e->getMessage());
        }

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /codes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}



    /**
     * Display a listing of the resource.
     * GET /codes
     *
     * @return Response
     */
    public function index()
    {
        return Redirect::to('/');
    }

}