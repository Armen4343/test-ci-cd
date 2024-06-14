<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	private $uploadLocation="uploads/vendor/category/";
    public function index()
    {
		$categories=Category::all();
        return view('super-admin.category.index',compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$validator=Validator::make($request->all(), [
            'title' => 'required|unique:categories,title|max:255',
			'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',        
			'status' => 'required|boolean',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }
       
		
		
		
		$category=new Category();
		
		$originalImage= $request->file('image');
		
		$path = Storage::disk('s3')->put('category', $originalImage, 'public');
			 
			 
	

$imageName = Storage::disk('s3')->url($path);
	

        $category->title=$request->title;
        $category->image=$imageName;
		$category->status=$request->status;		
		$category->description=$request->short_description;
		$category->user_id=Auth::user()->id;
        $category->save();
       
  
        return response()->json(['success' => 'Category created successfully!']);
		/**$validated = $request->validate([
        'title' => 'required|unique:categories,title|max:255',
        'image' => 'required|mimes:jpg,png,jpeg,gif,svg|max:2048',        
		'status' => 'required|boolean',
    ]);
       	$category=new Category();
		
		$file = $request->file('image')->getClientOriginalName();
		$filename = pathinfo($file, PATHINFO_FILENAME);
		$extension = pathinfo($file, PATHINFO_EXTENSION);

        $imageName=$filename."_".hexdec(uniqid()).'.'.$extension;
        $request->image->move($this->uploadLocation,$imageName);
        $category->title=$request->title;
        $category->image=$this->uploadLocation.$imageName;
		$category->status=$request->status;
        $category->save();
        return redirect()->back()->with("success","Category created successfully!");
		**/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		 $data=Category::find($id);
        return view("super-admin.category.edit",compact("data"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		 $data = Category::find($id);
		$validated = $request->validate([
            'title' => 'required|max:255|unique:categories,title,'.$data->id,
			'image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048',        
			'status' => 'required|boolean',
        ]);
       
        if ($request->image) {
            
       $path = Storage::disk('s3')->put('category', $request->image, 'public');
			 
			 
	

$imageName = Storage::disk('s3')->url($path);
			$data->title=$request->title;			
			$data->description=$request->short_description;
			$data->image=$imageName;
			$data->status=$request->status;
        } else {
            $data->title=$request->title;
			$data->status=$request->status;
			$data->description=$request->short_description;
        }
        $data->save();
		return Redirect()->route("categories.index")->with("success","Category updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::find($id);
     	!is_null($data->image) && Storage::disk('s3')->delete($data->image);
        $data->delete();
        return Redirect()->back()->with("success","Category deleted successfully!");
    }
}
