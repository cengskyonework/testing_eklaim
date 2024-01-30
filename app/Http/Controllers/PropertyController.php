<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\PropertyBenefit;
use App\PropertyGallery;
use Validator;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertys = Property::all()->sortByDesc("id");
        return view('backend.property.list',compact('propertys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
		if( ! $request->ajax()){
		   return view('backend.property.create');
		}else{
           return view('backend.property.modal.create');
		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {	
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191',
			'property_type_id' => 'required',
			'year_built' => 'required|integer',
			'bed' => 'required|max:10',
			'bath' => 'required|max:10',
			'sq_ft' => 'required|max:20',
			'price' => 'required|numeric',
			'price_per_sq_ft' => 'required|numeric',
			'status' => 'required',
			'city_id' => 'required',
			'agent_id' => 'required',
			'offer_type' => 'required',
			'location' => 'required',
			'map_latitude' => 'required',
			'map_longitude' => 'required',
			'is_featured' => 'required',
			'image' => 'required|image'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect('property/create')
							->withErrors($validator)
							->withInput();
			}			
		}
			
	    $image = '';		
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/media/", $image);
		}
		
        $property = new Property();
	    $property->name = $request->input('name');
		$property->property_type_id = $request->input('property_type_id');
		$property->year_built = $request->input('year_built');
		$property->bed = $request->input('bed');
		$property->bath = $request->input('bath');
		$property->sq_ft = $request->input('sq_ft');
		$property->price = $request->input('price');
		$property->price_per_sq_ft = $request->input('price_per_sq_ft');
		$property->description = $request->input('description');
		$property->status = $request->input('status');
		$property->city_id = $request->input('city_id');
		$property->agent_id = $request->input('agent_id');
		$property->offer_type = $request->input('offer_type');
		$property->location = $request->input('location');
		$property->map_latitude = $request->input('map_latitude');
		$property->map_longitude = $request->input('map_longitude');
		$property->image = $image;
		$property->is_featured = $request->input('is_featured');
		
        $property->save();
		
		//Store Benefits
		foreach($request->benefits as $benefit){
			$pb = new PropertyBenefit();
			$pb->property_id = $property->id;
			$pb->benefit_id = $benefit;
			$pb->save();
		}
        
		if(! $request->ajax()){
           return redirect('property/create')->with('success', _lang('Saved Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'store','message'=>_lang('Saved Sucessfully'),'data'=>$property]);
		}
        
   }
	

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $property = Property::find($id);
		if(! $request->ajax()){
		    return view('backend.property.view',compact('property','id'));
		}else{
			return view('backend.property.modal.view',compact('property','id'));
		} 
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $property = Property::find($id);
		if(! $request->ajax()){
		   return view('backend.property.edit',compact('property','id'));
		}else{
           return view('backend.property.modal.edit',compact('property','id'));
		}  
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			'name' => 'required|max:191',
			'property_type_id' => 'required',
			'year_built' => 'required|integer',
			'bed' => 'required|max:10',
			'bath' => 'required|max:10',
			'sq_ft' => 'required|max:20',
			'price' => 'required|numeric',
			'price_per_sq_ft' => 'required|numeric',
			'status' => 'required',
			'city_id' => 'required',
			'agent_id' => 'required',
			'offer_type' => 'required',
			'location' => 'required',
			'map_latitude' => 'required',
			'map_longitude' => 'required',
			'is_featured' => 'required',
			'image' => 'nullable|image'
		]);
		
		if ($validator->fails()) {
			if($request->ajax()){ 
			    return response()->json(['result'=>'error','message'=>$validator->errors()->all()]);
			}else{
				return redirect()->route('property.edit', $id)
							->withErrors($validator)
							->withInput();
			}			
		}
	
	    if($request->hasfile('image'))
		{
			$file = $request->file('image');
			$image = time().$file->getClientOriginalName();
			$file->move(public_path()."/uploads/media/", $image);
		}	
        	
		
        $property = Property::find($id);
		$property->name = $request->input('name');
		$property->property_type_id = $request->input('property_type_id');
		$property->year_built = $request->input('year_built');
		$property->bed = $request->input('bed');
		$property->bath = $request->input('bath');
		$property->sq_ft = $request->input('sq_ft');
		$property->price = $request->input('price');
		$property->price_per_sq_ft = $request->input('price_per_sq_ft');
		$property->description = $request->input('description');
		$property->status = $request->input('status');
		$property->city_id = $request->input('city_id');
		$property->agent_id = $request->input('agent_id');
		$property->offer_type = $request->input('offer_type');
		$property->location = $request->input('location');
		$property->map_latitude = $request->input('map_latitude');
		$property->map_longitude = $request->input('map_longitude');
		if($request->hasfile('image')){
			$property->image = $image;
		}
		$property->is_featured = $request->input('is_featured');
		
        $property->save();
		
		//Update Benefits
		$pb = PropertyBenefit::where('property_id',$property->id);
		$pb->delete();
		
		foreach($request->benefits as $benefit){
			$pb = new PropertyBenefit();
			$pb->property_id = $property->id;
			$pb->benefit_id = $benefit;
			$pb->save();
		}
		
		if(! $request->ajax()){
           return redirect('property')->with('success', _lang('Updated Sucessfully'));
        }else{
		   return response()->json(['result'=>'success','action'=>'update', 'message'=>_lang('Updated Sucessfully'),'data'=>$property]);
		}
	    
    }
	
	public function gallery($id)
    {
        $property = Property::find($id);
		return view('backend.property.gallery',compact('property'));  
    }
	
	public function upload_gallery_images(Request $request){
		$this->validate($request, [
            'property_id' => 'required',
			'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:8192'
        ]);
		
		$property_id = $request->property_id;
		if($request->hasfile('images'))
        {

            foreach($request->file('images') as $image)
            {
                $name = time().$image->getClientOriginalName();
                $image->move(public_path().'/uploads/media/', $name);  
                
				$pg = new PropertyGallery();
				$pg->property_id = $property_id;
				$pg->image = $name;
				$pg->save();
            }
         }
		 
		return back()->with('success',_lang('Images Uploaded Sucessfully')); 
		
	}
	
	public function delete_gallery_image($id){
		$pg = PropertyGallery::find($id);
        $pg->delete();
		
        return back()->with('success',_lang('Deleted Sucessfully'));
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::find($id);
        $property->delete();
        return redirect('property')->with('success',_lang('Deleted Sucessfully'));
    }
}
