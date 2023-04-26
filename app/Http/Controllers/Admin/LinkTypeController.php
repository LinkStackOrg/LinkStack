<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LinkType;
use Illuminate\Http\Request;
use \App\Http\Requests\LinkTypeRequest;

class LinkTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the sharks
        $LinkTypes = LinkType::all();

        // load the view and pass the link types
        return View('panel.linktype.index')
            ->with('linktype', $LinkTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('panel.linktype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkTypeRequest $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation

        $validated = $request->validated();

        // store
        $LinkType = new LinkType;
        $LinkType->typename       = $request->typename;
        $LinkType->title      = $request->title;
        $LinkType->description = $request->description;
        $LinkType->icon            = $request->icon;
        $LinkType->params = $request->params;
        $LinkType->save();

        // redirect
        return Redirect('admin/linktype')
            ->with('success', 'New link type has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LinkType  $linkType
     * @return \Illuminate\Http\Response
     */
    public function show(LinkType $linkType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LinkType  $linkType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lt = LinkType::find($id);
        // show the edit form and pass the shark
        return View('panel.linktype.edit', ['linktype' => $lt]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LinkType  $linkType
     * @return \Illuminate\Http\Response
     */
    public function update(LinkTypeRequest $request, $id)
    {
        $linktype = LinkType::find($id);

        $validated = $request->validated();


        // store
        $linktype->title      = $request->title;
        $linktype->description = $request->description;
        $linktype->icon            = $request->icon;
        $linktype->params = $request->params;
        $linktype->save();

        // redirect
        return Redirect('admin/linktype')
            ->with('success', 'Link type updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LinkType  $linkType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $linktype = LinkType::find($id);
        $linktype->delete();

        // redirect
        return Redirect('admin/linktype')
            ->with('success', 'Link type deleted');
    }
}
