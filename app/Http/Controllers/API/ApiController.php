<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Article;
use App\Category;
use App\Gallery;
use App\Product;
use App\DeliveryType;
use App\Meal;
use App\Chef;

/* breaker */
use Auth;
use DB;
use App\MaterialType;
use App\SubMaterialType;
use App\Shop;
use App\ProductGallery;
use App\ProductSubMaterial;
use App\ProductMaterialType;
use Illuminate\Support\Carbon;


class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topCategories()
    {
        $categories = Category::get()->take(3);

        foreach($categories as $category){
        $cat_products = Product::where('category_id', $category->id)->get();

        $data[] = array(
            'category_name' => $category->category_name,
            'category_slug' => $category->category_slug,
            'products' => $cat_products
        );
       }
     
         return response()->json($data);
    }

    public function SingleProduct($slug)
    {
        $product = Product::where('product_slug', $slug)->first();

        $row['product'] = $product;

        $p_materials = DB::table("product_material_types")
        ->where('product_material_types.product_id',  '=', $product->id)
        ->join('material_types', 'material_types.id', '=', 'product_material_types.material_id')
        ->select('product_material_types.id as p_material_id', 'material_types.id as material_id', 'material_types.material_name')
        ->get();

        foreach($p_materials as $material){

        $p_sub_materials = DB::table("product_sub_materials")
        ->where('product_sub_materials.product_id',  '=', $product->id)
        ->where('product_sub_materials.material_id',  '=', $material->material_id)
        ->join('sub_material_types', 'sub_material_types.id', '=', 'product_sub_materials.sub_material_id')
        ->select('sub_material_types.id as id', 'sub_material_types.item_name')
        ->get();

        $data[] = array(
            'material_id' => $material->material_id,
            'material_name' => $material->material_name,
            'sub_material' => $p_sub_materials
        );
    }
    $row['materials'] = $data;
    
    // gallery
    $galleries = ProductGallery::where('product_id', $product->id)->get();
    $row['gallery'] = $galleries;
    
     
         return response()->json($row);
    }

    public function adminCategories()
    {
        $categories = Category::get();
     
         return response()->json($categories);
    }
    public function adminTestimonial()
    {
        $testimonial = Testimonial::get();
     
         return response()->json($testimonial);
    }
    public function adminEvents()
    {
        $events = Event::get();
     
         return response()->json($events);
    }
    public function EventGallery($id)
    {
        $gallery = EventGallery::where('event_id', '=', $id)->get();
     
         return response()->json($gallery);
    }
    public function EventGalleries($slug)
    {
        $event = Event::where('event_slug', '=', $slug)->first();
        $gallery = EventGallery::where('event_id', '=', $event->id)->get();
     
         return response()->json($gallery);
    }
    public function Gallery()
    {
        $gallery = Gallery::get();
     
         return response()->json($gallery);
    }
    public function Products()
    {
        $product = Shop::get();
     
         return response()->json($product);
    }
    public function adminMeals()
    {
        $meals = Meal::get();
        foreach ($meals as $meal ) {
            $date = Carbon::parse($meal->created_at); // now date is a carbon instance

            $category = Category::where('id', $meal->category_id)->first();
           $all_meals[]= array(
               'id' => $meal->id, 
               'meal_name' => $meal->meal_name, 
               'meal_des' => $meal->meal_des, 
               'meal_img' => $meal->meal_img, 
               'meal_date' => $date->diffForHumans(), 
               'meal_price' => '₦'.$meal->meal_price, 
               'meal_orders' => null, 
               'meal_slug' => $meal->meal_slug, 
               'meal_category' => $category->category_name, 
            );
        }
     
         return response()->json($all_meals);
    }
 
    public function singleMeal($slug)
    {
        $meal = Meal::where('meal_slug', '=', $slug)->first();
        $date = Carbon::parse($meal->created_at); // now date is a carbon instance

        $category = Category::where('id', $meal->category_id)->first();
       $meal_json[]= array(
           'id' => $meal->id, 
           'meal_name' => $meal->meal_name, 
           'meal_des' => $meal->meal_des, 
           'meal_img' => $meal->meal_img, 
           'meal_date' => $date->diffForHumans(), 
           'meal_price' => '₦'.$meal->meal_price, 
           'meal_orders' => null, 
           'meal_slug' => $meal->meal_slug, 
           'meal_category' => $category->category_name, 
        );
        
        return response()->json($meal_json);
    }
    public function singleProject($slug)
    {
        $project = Project::where('project_slug', '=', $slug)->first();
        
        return response()->json($project);
    }
    public function galleries()
    {
        $galleries = Gallery::get();
     
         return response()->json($galleries);
    }
    public function articles()
    {
        $articles = Article::get();
        
        function substrwords($text, $maxchar, $end='...') {
            if (strlen($text) > $maxchar || $text == '') {
                $words = preg_split('/\s/', $text);      
                $output = '';
                $i      = 0;
                while (1) {
                    $length = strlen($output)+strlen($words[$i]);
                    if ($length > $maxchar) {
                        break;
                    } 
                    else {
                        $output .= " " . $words[$i];
                        ++$i;
                    }
                }
                $output .= $end;
            } 
            else {
                $output = $text;
            }
            return $output;
        }
        foreach ($articles as $article) {
            $date = Carbon::parse($article->created_at); // now date is a carbon instance


            $article_body = substrwords($article->article_body,30);
        $art_json[]=array(
            'id' => $article->id,
            'article_title' => $article->article_title,
            'article_body' => $article_body,
            'article_img' => $article->article_img,
            'article_date' => $date->diffForHumans(),
            'article_slug' => $article->slug,
        );
        }


       
         return response()->json($art_json);
    }
    public function donations()
    {
        $donations = Donation::get();
        foreach ($donations as $donate) {
            $date = Carbon::parse($donate->created_at); // now date is a carbon instance

        $donate_json[]=array(
            'id' => $donate->id,
            'donate_name' => $donate->first_name.' '.$donate->last_name,
            'donate_email' => $donate->email,
            'donate_date' => $date->diffForHumans(),
            'donate_number' => $donate->number,
            'donate_message' => $donate->message,
            'donate_amount' => $donate->amount,
        );
        }
       
         return response()->json($donate_json);
    }
    public function singleEvent($slug)
    {
        $event = Event::where('event_slug', '=', $slug)->first();
        
        
        return response()->json($event);
    }
    public function singleArticle($slug)
    {
        $article = Article::where('slug', '=', $slug)->first();
        
        $date = Carbon::parse($article->created_at); // now date is a carbon instance

        $article_single =array(
            'id' => $article->id,
            'article_title' => $article->article_title,
            'article_body' => $article->article_body,
            'article_img' => $article->article_img,
            'article_date' => $date->diffForHumans(),
        );
        return response()->json($article_single);
    }



    /** 
     * 
     *  Front section  
     *
     **/
    
    public function frontMeals()
    {
        $meals = Meal::get();
        foreach ($meals as $meal ) {
            $date = Carbon::parse($meal->created_at); // now date is a carbon instance

            $category = Category::where('id', $meal->category_id)->first();
            $delivery_type = DeliveryType::where('id', $meal->delivery_type)->first();
          
            
           $all_meals[]= array(
               'id' => $meal->id, 
               'meal_name' => $meal->meal_name, 
               'meal_des' => $meal->meal_des, 
               'meal_img' => $meal->meal_img, 
               'meal_date' => $date->diffForHumans(), 
               'meal_price' => '₦'.$meal->meal_price, 
               'meal_orders' => null, 
               'meal_slug' => $meal->meal_slug, 
               'meal_category' => $category->category_name, 
               'meal_category_img' => $category->category_img, 
               'meal_delivery_type' => $delivery_type->delivery_name, 
               'meal_delivery_time' => $delivery_type->package_time, 
            );
        }
     
         return response()->json($all_meals);
    }

    public function frontTestimonials()
    {
        $testimonial = Testimonial::get();
     
         return response()->json($testimonial);
    }
    public function FrontTopArticle()
    {
        $top_article = Article::orderBy('id', 'DESC')->first();;
     
         return response()->json($top_article);
    }
    public function FrontArticlesMini()
    {
        $front_articles = Article::get()->take(4);
     
         return response()->json($front_articles);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEventGallery(Request $request)
    {

        $name = time().'.' . explode('/', explode(':', substr($request->gallery_name, 0, strpos(
            $request->gallery_name, ';'
        )))[1])[1];

            \Image::make($request->gallery_name)->save(public_path('uploads/').$name);
            $gallery = EventGallery::create([
                'event_id' => $request['event_id'],
                'gallery_name' => $name,
            ]);
      
        return response()->json($gallery);
    }
    public function CategoryStore(Request $request)
    {

       
        $this->validate($request,[
            'category_name' => 'required|string',
            'category_description' => 'required|string',
            'category_image' => 'required',
        ]);
        $slug = str_slug($request->category_name, '-');
        $validator = Validator::make(['category_name' => $slug], [
            'slug' => 'required|unique:categories,category_name,slug|max:191'
        ]);


        if($request->category_image){
            $name = time().'.' . explode('/', explode(':', substr($request->category_image, 0, strpos(
                $request->category_image, ';'
            )))[1])[1];

            \Image::make($request->category_image)->save(public_path('uploads/').$name);
            $category = Category::create([
                'category_name' => $request['category_name'],
                'category_des' => $request['category_description'],
                'category_img' => $name,
                'category_slug' => $slug,
            ]);
        }else {
            # code...
            $category = Category::create([
                'category_name' => $request['category_name'],
                'category_des' => $request['category_description'],
                'category_slug' => $slug,

                ]);
            }
        return response()->json($category);
    }
    public function EventStore(Request $request)
    {

       
        $this->validate($request,[
            'event_name' => 'required|string',
            'event_des' => 'required|string',
            
        ]);
        $slug = str_slug($request->event_name, '-');
        $validator = Validator::make(['event_name' => $slug], [
            'event_slug' => 'required|unique:events,event_name,slug|max:191'
        ]);


        if($request->event_img){
            $name = time().'.' . explode('/', explode(':', substr($request->event_img, 0, strpos(
                $request->event_img, ';'
            )))[1])[1];

            \Image::make($request->event_img)->save(public_path('uploads/').$name);
            $event = Event::create([
                'event_name' => $request['event_name'],
                'event_des' => $request['event_des'],
                'event_location' => $request['event_location'],
                'event_date' => $request['event_date'],
                'event_theme' => $request['event_theme'],
                'event_time' => $request['event_time'],
                'event_video_url' => $request['event_video_url'],
                'event_img' => $name,
                'event_slug' => $slug,
            ]);
        }else {
            # code...
            $event = Event::create([
                'event_name' => $request['event_name'],
                'event_des' => $request['event_des'],
                'event_location' => $request['event_location'],
                'event_date' => $request['event_date'],
                'event_theme' => $request['event_theme'],
                'event_time' => $request['event_time'],
                'event_video_url' => $request['event_video_url'],
                'event_slug' => $slug,

                ]);
            }
        return response()->json($event);
    }

    public function TestimonialStore(Request $request)
    {

       
        $this->validate($request,[
            'testimonial_name' => 'required|string',
            'testimonial_review' => 'required|string',
            'testimonial_image' => 'required',
            'testimonial_job' => 'required|string',
        ]);
        $slug = str_slug($request->testimonial_name, '-');
        $validator = Validator::make(['testimonial_name' => $slug], [
            'slug' => 'required|unique:testimonials,testimonial_name,slug|max:191'
        ]);


        if($request->testimonial_image){
            $name = time().'.' . explode('/', explode(':', substr($request->testimonial_image, 0, strpos(
                $request->testimonial_image, ';'
            )))[1])[1];

            \Image::make($request->testimonial_image)->save(public_path('uploads/').$name);
            $testimonial = Testimonial::create([
                'testimonial_name' => $request['testimonial_name'],
                'testimonial_review' => $request['testimonial_review'],
                'testimonial_job' =>  $request['testimonial_review'],
                'testimonial_image' => $name,
            ]);
        }else {
            # code...
            $testimonial = Testimonial::create([
                'testimonial_name' => $request['testimonial_name'],
                'testimonial_review' => $request['testimonial_review'],
                'testimonial_job' =>  $request['testimonial_review']

                ]);
            }
        return response()->json($testimonial);
    }
 
    public function saveDonation(Request $request)
    {
        $project = Project::where('project_slug', '=', $request->project_slug)->first();
        $donation = Donation::create([
            'last_name' => $request['last_name'],
            'first_name' =>$request['first_name'],
            'email' =>$request['email'],
            'number' =>$request['number'],
            'amount' =>$request['amount'],
            'message' =>$request['message'],
            'project_id' =>$project->id,
        ]);
        return response()->json($donation);
    }
    public function GalleryStore(Request $request)
    {

       
        $this->validate($request,[
            'gallery_name' => 'required|string',
            'gallery_img' => 'required',
           

        ]);

        if($request->gallery_img){
            $name = time().'.' . explode('/', explode(':', substr($request->gallery_img, 0, strpos(
                $request->gallery_img, ';'
            )))[1])[1];

            \Image::make($request->gallery_img)->save(public_path('assets/img/gallery/').$name);
        }
        $gallery = Gallery::create([
            'gallery_name' => $request['gallery_name'],
            'gallery_img' => $name,
        ]);
        return response()->json($gallery);
    }
    public function ArticleStore(Request $request)
    {

       
        $this->validate($request,[
            'article_title' => 'required|string',          
            'article_body' => 'required|string',          

        ]);

        $slug = str_slug($request->article_title, '-');
            $validator = Validator::make(['article_title' => $slug], [
                'slug' => 'required|unique:articles,article_title,slug|max:191'
            ]);

        if($request->article_img){
            $name = time().'.' . explode('/', explode(':', substr($request->article_img, 0, strpos(
                $request->article_img, ';'
            )))[1])[1];

            \Image::make($request->article_img)->save(public_path('uploads/').$name);
            
            $article = Article::create([
                'article_title' => $request['article_title'],
                'article_body' => $request['article_body'],
                'article_img' => $name,
                'slug' => $slug,
            ]);
        }else{

            $article = Article::create([
                'article_title' => $request['article_title'],
                'article_body' => $request['article_body'],
                'slug' => $slug,
                ]);
            }
      
        return response()->json($article);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function EventDelete($id)
    {
        $event = Event::find($id)->delete();

        return $id;
    }
    public function ProjectDelete($id)
    {
        $project = Project::find($id)->delete();
        // DB::table('projects')->where('id', '', 100)->delete();

        return $id;
    }
    public function DonateDelete($id)
    {
        $donation = Donation::find($id)->delete();
        // DB::table('projects')->where('id', '', 100)->delete();

        return $id;
    }
    public function GalleryDelete($id)
    {
        $gallery = Gallery::find($id)->delete();
        return $id;
    }
    public function ArticleDelete($id)
    {
        $article = Article::find($id)->delete();
        return $id;
    }
    public function destroy($id)
    {
        //
    }
}
