<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Repositories\Interfaces\MediaRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
  private $userRepository;
  private $mediaRepository;
  private $roleRepository;

  public function __construct(UserRepositoryInterface $userRepository,
                              MediaRepositoryInterface $mediaRepository,
                              RoleRepositoryInterface $roleRepository) {
    $this->userRepository = $userRepository;
    $this->mediaRepository = $mediaRepository;
    $this->roleRepository = $roleRepository;
  }

  public function login() {
    if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
      $user = Auth::user();
      $token = $user->createToken('MyApp')->accessToken;
      return response()->json(['status' => 'success', 'token' => $token], 200);
    } else {
      return response()->json(['status' => 'error', 'message' => 'Credential error']);
    }
  }

  public function register(UserRequest $request) {
    $request["password"] = bcrypt($request["password"]); //Hashing A Password
    $input = $request->all();

    $user = $this->userRepository->insert(
        $input["name"],
        $input["email"],
        $input["password"],
        $input["company_id"] ?? null,
        $input["position_id"] ?? null
    );

    $user = User::hydrate((array) $user)->first();
    $token = $user->createToken('MyApp')->accessToken;
    Mail::to($user->email)->send(new WelcomeMail($user)); //Sending Welcome Mail to email address

    return response()->json(['status' => 'success', 'token' => $token], 200);
  }

  public function details() {
    $user = Auth::user();
    if ($user->isAdmin()) $user->isAdmin = true;
    return response()->json($user, 200);
  }

  public function update(UserRequest $request) {
    $user = Auth::user();
    $input = $request->all();

    $this->userRepository
        ->update(
            $user->id,
            $input["name"],
            $input["company_id"],
            $input["position_id"]);

    return response()->json(['status' => 'ok'], 200);
  }

  public function edit(UserRequest $request) {
    if (!Auth::user()->isAdmin()) return response()->json(['status' => 'fail', 'message'=>'you don\'t have permission'], 400);

    $input = $request->all();

    $this->userRepository
        ->update(
            $input["id"],
            $input["name"],
            $input["company_id"],
            $input["position_id"]);

    $this->roleRepository->clearUserRoles($input["id"]);

    foreach ($input["roles_id"] as $role){
      $this->roleRepository->insertUserRole($input["id"], $role);
    }

    return response()->json(['status' => 'ok'], 200);
  }

  public function delete($id) {
    if (!Auth::user()->isAdmin()) return response()->json(['status' => 'fail', 'message'=>'you don\'t have permission'], 400);

    if ($this->userRepository->delete($id)) {
      return response()->json(["status" => "success", "message" => "Data is deleted"]);
    } else {
      return response()->json(["status" => "error", "message" => "Data is not deleted"]);
    }
  }

  public function list(){
    $users = $this->userRepository->all();
    foreach ($users as $user){
      $roles = $this->userRepository->getUserRoles($user->id);
      $roles_id = [];
      $roles_name = [];
      foreach ($roles as $role){
        $roles_id [] = $role->id;
        $roles_name [] = $role->name;
      }
      $user->roles_id = $roles_id;
      $user->roles_name = $roles_name;
    }
    return response()->json($users,200);
  }

  public function profileMedia(){
    $model = get_class(new User());
    $user = Auth::user();

    $media = $this->mediaRepository->getMedia($model, $user->id, "user_media");

    if (!$media){
      return response()->json(["status" => "empty", "message" => "You have no media here :("],200);
    }

    foreach ($media as $file){
      $file->path = Storage::disk('media')->url($file->id."/".$file->path);
    }

    return response()->json(["status" => "success", "files" => $media],200);
  }

  public function profileMediaUpload(Request $request) {
    $model = get_class(new User());
    $userId = Auth::user()->id;
    $orderIndex = $this->mediaRepository->lastMediaOrder($model, $userId);

    foreach ($request->allFiles()["files"] as $file) {
      $fileNameOriginal = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
      $fileName = str_replace(' ', '-', $file->getClientOriginalName());
      $fileSize = $file->getSize();
      $fileMimeType = $file->getMimeType();

      $directoryId = $this->mediaRepository
          ->insertMedia(
              $model,
              $userId,
              "user_media",
              $fileNameOriginal,
              $fileName,
              $fileMimeType,
              "media",
              $fileSize,
              ++$orderIndex);

      $file->storeAs("public/media/" . $directoryId, $fileName);
    }

    return $this->profileMedia();
  }
}
