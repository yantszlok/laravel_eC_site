<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use DB;

class CategoryController extends Controller
{
    public function Category(){
        
        $category = Category::all();
        return view('admin.category.category',compact('category'));
    }

    public function StoreCategory(Request $request){

        $validateData =$request->validate([

            'category_name' => 'required|unique:categories|max:255,'
        ]);

    $data=array();
    $data['category_name'] = $request->category_name;
    DB::table('categories')->insert($data);

    // $category =new Category();
    // $category->category_name = $request->category_name;
    // $category->save();

    $notification=array(
        'messege'=>'Category Added successfully!',
        'alert-type'=>'success'
         );
       return Redirect()->back()->with($notification);

    }

    public function DeleteCategory($id){
        DB::table('categories')->where('id',$id)->delete();
         $notification=array(
              'messege'=>'Category Deleted Successfully',
              'alert-type'=>'success'
               );
             return Redirect()->back()->with($notification);
    }

    public function EditCategory($id){
        $category = DB::table('categories')->where('id',$id)->first();
        return view('admin.category.edit_category',compact('category'));
       }
      
       public function UpdateCategory(Request $request, $id){
        $validateData = $request->validate([
        'category_name' => 'required|max:255',
         ]);
     
        $data=array();
        $data['category_name']=$request->category_name;
        DB::table('categories')->where('id',$id)->update($data);
        
        return Redirect()->route('categories');
        
        
    }

}

