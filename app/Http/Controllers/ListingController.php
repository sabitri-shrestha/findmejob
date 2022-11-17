<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listing
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(5)
        ]);
    }

    //show only one listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //store listing
    public function store(Request $request) {
        //validation
        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required', Rule::unique('listings','company')],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required', 'email'],
            'tags'=>'required',
            'description'=>'required',

        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        Listing::create($formFields);
        return redirect('/')->with('message','Listing created successfully!');
    }

    //show edit form

    public function edit(Listing $listing){
        return view('listings.edit',['listing'=>$listing]);
    }

    //update listing
    public function update(Request $request, Listing $listing) {
        //validation
        $formFields = $request->validate([
            'title'=>'required',
            'company'=>['required'],
            'location'=>'required',
            'website'=>'required',
            'email'=>['required', 'email'],
            'tags'=>'required',
            'description'=>'required',

        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }
        $listing->update($formFields);
        return back()->with('message','Listing updated successfully!');
    }

    //show create form

    public function create() {
        return view('listings.create');
    }
}
