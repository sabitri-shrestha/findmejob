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

        $formFields['user_id'] = auth()->id();
        Listing::create($formFields);
        return redirect('/')->with('message','Listing created successfully!');
    }

    //show edit form

    public function edit(Listing $listing){
        return view('listings.edit',['listing'=>$listing]);
    }

    //update listing
    public function update(Request $request, Listing $listing) {
        //make sure to check that the user is the owner
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');

        }
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

    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403,'Unauthorized Action');

        }
        $listing->delete();
        return redirect('/')->with('message','Listing deleted successfully!');

    }

    //manage listing
    public function manage(){
        return view('listings.manage',['listings'=>auth()->user()->listings()->get()]);
    }

    //show create form

    public function create() {
        return view('listings.create');
    }
}
