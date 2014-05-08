<?php namespace Brewski\Repositories;

use Brewski\BrewskiValidator;
use Page;
use DB;
use Input;
use Auth;
use Str;

class PageEloquent implements PageInterface {

    protected $errors;

    public function __construct(BrewskiValidator $validator)
    {
        $this->validator = $validator;
    }

    public function find($id)
    {
        return Page::find($id);
    }

    public function findBySlug($slug)
    {
        return Page::whereSlug($slug)->first();
    }

    public function paginate($num, $column = 'created_at', $order = 'DESC')
    {
        return Page::orderBy($column, $order)->paginate($num);
    }

    public function lists($column, $key = null)
    {

        return Page::lists($column, $key);
    }

    public function create()
    {
        $this->validator->validate(Input::all(), Page::$rules, Page::$messages);
        $this->errors = $this->validator->getErrors();

        if (!$this->getErrors())
        {
            DB::transaction(function ()
            {
                $page             = new Page;
                $page->title      = Input::get('title');
                $page->content    = Input::get('content');
                $page->creator_id = Auth::user()->id;
                if (Input::get('status') == 'published')
                {
                    $page->status = 'published';
                } else
                {
                    $page->status = 'draft';
                }

                $page->save();
                $page->slug = $this->setSlug($page);
                $page->save();
            });
        }

    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function setSlug($page)
    {
        $current_slugs = Page::whereSlug(Str::slug($page->title))->get();
        if ($current_slugs->count())
        {
            return Str::slug($page->title . '-' . $page->id);
        }

        return Str::slug($page->title);
    }

    public function update($id)
    {
        //dd(Input::all());
        $this->validator->validate(Input::all(), Page::$rules, Page::$messages);
        $this->errors = $this->validator->getErrors();

        if (!$this->getErrors())
        {
            DB::transaction(function () use ($id)
            {
                $page          = Page::find($id);
                $page->title   = Input::get('title');
                $page->content = Input::get('content');
                if (Input::get('status') == 'published')
                {
                    $page->status = 'published';
                } else
                {
                    $page->status = 'draft';
                }
                $page->save();
                $page->slug = $this->setSlug($page);
            });
        }
    }

    public function destroy($id)
    {
        $page = Page::destroy($id);

        return $page;
    }
}
