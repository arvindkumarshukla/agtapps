<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\Image;
class ImageUploadController extends Controller
{
    public function imageUpload()
    {
        return view('imageUpload');
    }
    
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg',
        ]);
    
        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images'), $imageName);
  
        /* Store $imageName name in DATABASE from HERE */
        $image = new Image;
        $image->name = $imageName;
        $image->save();
    
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName); 
    }
}