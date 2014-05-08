<?php namespace Brewski\Controllers\Admin;

use Brewski\Repositories\PageInterface;
use View;
use Input;
use Redirect;

class PagesController extends \BaseController {

    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Display a listing of the page.
     *
     * @return Response
     */
    public function index()
    {
        $pages = $this->page->paginate(10);

        return View::make('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new page.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.pages.create');
    }

    /**
     * Store a newly created page in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->page->create(Input::all());

        if ($this->page->getErrors())
        {
            return Redirect::back()->withErrors($this->page->getErrors());
        }

        return Redirect::action('PagesController@index')->withSuccess('Your page has been created!');
    }

    /**
     * Display the specified page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $page = $this->page->find($id);

        return View::make('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $this->page->update($id, Input::all());

        if ($this->page->getErrors())
        {
            return Redirect::back()->withErrors($this->page->getErrors());
        }

        return Redirect::action('PagesController@edit', $id)->withSuccess('The page has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->page->destroy($id);

        return Redirect::action('PagesController@index')->withSuccess('The page has been deleted.');
    }

}
