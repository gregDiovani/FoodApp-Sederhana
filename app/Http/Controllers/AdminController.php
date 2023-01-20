<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Media;
use App\Models\Category;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use App\Http\Requests\FoodRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user_id = Auth::user()->id;

        $foods = DB::table("food")
            ->join("categories", "categories.id", "=", "food.category_id")
            ->where("food.user_id", $user_id)
            ->select(
                "food.id",
                "food.name as namaMakanan",
                "categories.name as kategori",
                "food.description",
                "image"
            )
            ->get();

        return view("admin", compact("foods"));
    }

    public function create()
    {
        $category = Category::all();

        return view("createFood", compact("category"));
    }

    public function store(FoodRequest $request)
    {
        $image = $request->file("image");

        ////Setting File

        $user_id = Auth::user()->id;

        $name = time() . "." . $image->getClientOriginalExtension();
        $destinationPath = public_path("/images");
        $image->move($destinationPath, $name);

        $food = new Food();
        $food->user_id = $user_id;
        $food->name = $request->name;
        $food->description = $request->description;
        $food->image = $name;
        $food->price = $request->price;
        $food->category_id = $request->category;
        $food->save();

        $media = new Media();
        $media->user_id = $user_id;
        $media->name = $name;
        $media->path = $destinationPath;
        $media->save();

        return redirect()
            ->route("food.index")
            ->with("success", "Food Created");
    }

    public function edit($id)
    {
        $food = Food::find($id)
            ->where("id", "=", $id)
            ->get();

        return view("updateFood", compact("food"));
    }

    public function show($id)
    {
        $food = Food::find($id)
            ->where("id", "=", $id)
            ->get();

        return view("detail", compact("food"));
    }

    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        $old_image = $food->image;

        ///dapatkan user login
        $user_id = Auth::user()->id;


        /// Jika ada request file
        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $image_path = public_path("images/$old_image");

            if (file_exists($image_path)) {
                unlink($image_path);
            }

            $name = time() . "." . $image->getClientOriginalExtension();
            $destinationPath = public_path("/images");
            $image->move($destinationPath, $name);

            
            $food->image = $name;
            $food->save();

            $media = Media::where("user_id", $user_id)->update([
                "name" => $name,
                "path" => $destinationPath,
                "updated_at" => now(),
            ]);
        }

        $food->user_id = $user_id;
        $food->name = $request->name;
        $food->description = $request->description;
        $food->price = $request->price;
        $food->category_id = $request->category;
        $food->save();

        return redirect()
            ->route("food.index")
            ->with("success", "Sukses mengupdate Data");
    }

    public function destroy($id)
    {
        $food = Food::find($id);
        $image_path = public_path("images/$food->image");

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $food->delete();

        return redirect()
            ->route("food.index")
            ->with("success", "Sukses Menghapus Data");
    }
}
