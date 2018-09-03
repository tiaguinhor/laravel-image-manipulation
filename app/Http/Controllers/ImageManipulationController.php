<?php

namespace App\Http\Controllers;

use App\ImageManipulation;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageManipulationController extends Controller{

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(){
		$data['qty'] = 5;

		for($i = 0; $i < $data['qty']; $i++){
			$path = "/images/photo{$i}.jpg";
			if(file_exists(public_path().$path)){
				$data['photo'.$i] = $path;
			}
		}

		return view('welcome', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(){
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request){
		$id = $request->input("id");

		$data = $request->validate([
			"photo-{$id}" => 'image|required|mimes:jpeg,png,jpg,gif'
		]);

		$img = Image::make($data["photo-{$id}"]);
		$thumbnailPath = public_path().'/thumbnails/';
		$originalPath = public_path().'/images/';

		if($request->has('filter-grey-'.$id) && $request->input('filter-grey-'.$id))
			$img->greyscale();

		if($request->has('filter-blur-'.$id))
			$img->blur($request->input('filter-blur-'.$id));

		if($request->has('filter-contrast-'.$id))
			$img->contrast($request->input('filter-contrast-'.$id));

		if($request->has('filter-pixelate-'.$id))
			$img->pixelate($request->input('filter-pixelate-'.$id));

		//resizing images
		if($request->filled('filter-width-'.$id) && $request->filled('filter-height-'.$id))
			$img->resize($request->input('filter-width-'.$id), $request->input('filter-height-'.$id));
		elseif($request->filled('filter-width-'.$id)){
			$img->resize($request->input('filter-width-'.$id), null, function ($constraint){
				$constraint->aspectRatio();
			});
		}elseif($request->filled('filter-height-'.$id)){
			$img->resize(null, $request->input('filter-height-'.$id), function ($constraint){
				$constraint->aspectRatio();
			});
		}

		//save original
		$img->save($originalPath.'photo'.$id.'.jpg');

		//resize and save thumb
		$img->resize(null, 200, function ($constraint){
			$constraint->aspectRatio();
		});

		$img->save($thumbnailPath.'photo'.$id.'.jpg');

		return redirect('/')->with('success', 'Your images has been successfully Upload');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\ImageManipulation $imageManipulation
	 * @return \Illuminate\Http\Response
	 */
	public function show(ImageManipulation $imageManipulation){
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\ImageManipulation $imageManipulation
	 * @return \Illuminate\Http\Response
	 */
	public function edit(ImageManipulation $imageManipulation){
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\ImageManipulation $imageManipulation
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, ImageManipulation $imageManipulation){
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\ImageManipulation $imageManipulation
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(ImageManipulation $imageManipulation){
		//
	}
}
