<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ProductRequest;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
  private $productRepository;

  public function __construct(ProductRepositoryInterface $productRepository) {
    $this->productRepository = $productRepository;
  }

  public function index() {
    return $this->productRepository->all();
  }

  public function create(ProductRequest $request) {
    $user = Auth::user();

    if ($this->productRepository->insert(
        $request->name, $request->category, $request->price, $user->id)
    ) {
      return response()->json(['result' => "success", "msg" => "Data is saved"], 200);
    }

    return response()->json(['result' => "fail", "msg" => "Product not saved"], 400);
  }

  public function update(ProductRequest $request) {
    if ($this->productRepository->update($request->id, $request->name,$request->category,$request->price)) {
      return response()->json(['result' => "success", "msg" => "Data is updated"]);
    } else {
      return response()->json(['result' => "fail", "msg" => "something gets wrong"]);
    }
  }

  public function destroy($id) {
    if ($this->productRepository->delete($id)) {
      return response()->json(['result' => "success", "msg" => "Data is deleted"]);
    } else {
      return response()->json(['result' => "success", "msg" => "Something gets wrong"]);
    }
  }
}
