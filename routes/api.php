<?php

// use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix'=> 'auth','namespace' => 'API'], function(){
        Route::post('signup', 'Auth\UserController@UsersStore');
        Route::post('signin', 'Auth\LoginController');
        Route::post('signout', 'Auth\LogoutController');
        Route::post('forgetpassword/', 'Auth\UserController@userForgotpass');
        Route::get('me', 'Auth\MeController');
        // setup sellers account
        Route::post('/sellers/signup', 'Auth\UserController@sellersStore');
});
Route::group(['prefix'=> 'sc_admin','namespace' => 'API'], function(){
        /* products */
        Route::get('list/products', 'BackendApiController@adminProducts');
        Route::get('products/gallery/{id}', 'BackendApiController@EventGallery');
        Route::post('post/product', 'BackendApiController@ProductStore');
        Route::delete('delete/product/{id}', 'BackendApiController@ProductDelete');
        Route::get('single/product/{slug}', 'BackendApiController@singleProduct'); 
        Route::get('single/product/mat/{slug}', 'BackendApiController@singleProductMat');
        Route::get('single/cat/mat/{slug}', 'BackendApiController@singleProductCatMat');
        Route::get('single/product/gallery/{slug}', 'BackendApiController@singleProductGallery');
        Route::post('post/product/gallery', 'BackendApiController@postEventGallery');
        Route::post('post/p/material', 'BackendApiController@postProductMaterial');
        Route::post('post/p/gallery', 'BackendApiController@postProductGallery');


        /* category */
        Route::get('categories', 'BackendApiController@adminCategories');
       

        /* materials */
        Route::get('materials', 'BackendApiController@adminMaterials');
        Route::get('/cat/material/{slug}', 'BackendApiController@adminSingleMaterial');
        Route::get('material/{id}', 'BackendApiController@adminSingleSubCategories');
        Route::get('single/cat/materials/{slug}', 'BackendApiController@singleCatMaterials');
        Route::get('single/material/sub/{slug}', 'BackendApiController@singleMatSubMaterials');
        Route::get('single/material/p/sub/{id}', 'BackendApiController@ProsingleMatSubMaterials');
        Route::post('post/material', 'BackendApiController@materialStore');
        Route::post('post/sub/material', 'BackendApiController@subMaterialStore');
        Route::delete('delete/material/{id}', 'BackendApiController@ProjectDelete');

        /* Testimonial */
        Route::get('testimonials', 'BackendApiController@adminTestimonial');
        Route::get('single/testimonial/{slug}', 'BackendApiController@singleTestimonial');
        Route::post('post/testimonial', 'BackendApiController@TestimonialStore');
        Route::delete('delete/testimonial/{id}', 'BackendApiController@TestimonialDelete');

        /* delivery */
        Route::get('deliveries', 'BackendApiController@adminDeliveries');
        Route::get('single/project/{slug}', 'BackendApiController@singleProject');
        Route::post('post/delivery_type', 'BackendApiController@DeliveryStore');
        Route::delete('delete/project/{id}', 'BackendApiController@ProjectDelete');
        /* meals */
        Route::get('meals', 'BackendApiController@adminMeals');
        Route::get('single/meal/{slug}', 'BackendApiController@singleMeal');
        Route::post('post/meal', 'BackendApiController@MealStore');
        Route::delete('delete/meal/{id}', 'BackendApiController@MealDelete');
        /* donaion */
        Route::post('post/donation', 'BackendApiController@saveDonation');
        Route::get('donations', 'BackendApiController@donations');
        Route::delete('delete/donation/{id}', 'BackendApiController@DonateDelete');
        /* articles */
        Route::get('articles', 'BackendApiController@articles');
        Route::get('single/article/{slug}', 'BackendApiController@singleArticle');
        Route::post('post/article', 'BackendApiController@ArticleStore');
        Route::delete('delete/article/{id}', 'BackendApiController@ArticleDelete');
        /* gallery */
        Route::get('galleries', 'BackendApiController@galleries');
        Route::delete('delete/gallery/{id}', 'BackendApiController@GalleryDelete');
        Route::post('post/gallery', 'BackendApiController@GalleryStore');
       
});
/* 

for front end side

*/
Route::group(['prefix'=> 'sc_front','namespace' => 'API'], function(){
        /* category */
        Route::get('top_cats', 'ApiController@topCategories');

        /* single product  */
        Route::get('single/product/{slug}', 'ApiController@SingleProduct');

        Route::get('categories', 'ApiController@frontCategories');
        Route::get('top_article', 'ApiController@FrontTopArticle');
        Route::get('articles_mini', 'ApiController@FrontArticlesMini');
        Route::get('testimonials', 'ApiController@frontTestimonials');

        /* events */
        Route::get('events', 'ApiController@adminEvents');
        Route::get('single/event/{slug}', 'ApiController@singleEvent');
        Route::get('events/gallery/{slug}', 'ApiController@EventGalleries');

        /* meals */
        Route::get('meals', 'ApiController@frontMeals');
        Route::get('single/meal/{slug}', 'ApiController@frontSingleMeal');
      
        /* articles */
        Route::get('articles', 'ApiController@articles');
        Route::get('single/article/{slug}', 'ApiController@singleArticle');
        Route::post('post/article', 'ApiController@ArticleStore');
        Route::delete('delete/article/{id}', 'ApiController@ArticleDelete');
     
       
});
// Route::apiResources(['user' => 'API\UserController']);
