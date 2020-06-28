<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\MediaRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
  private $userRepository;
  private $mediaRepository;


  public function __construct(UserRepositoryInterface $userRepository,
                              MediaRepositoryInterface $mediaRepository) {
    $this->userRepository = $userRepository;
    $this->mediaRepository = $mediaRepository;
  }

  public function login() {
    if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
      $user = Auth::user();
      $token = $user->createToken('MyApp')->accessToken;
      return response()->json(['status' => 'ok', 'token' => $token], 200);
    } else {
      return response()->json(['status' => 'credential error']);
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

    return response()->json(['status' => 'ok', 'token' => $token], 200);
  }

  public function details() {
    $user = Auth::user();
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

  public function list(){
    return response()->json($this->userRepository->all(),200);
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

    return response()->json(["status" => "ok", "files" => $media],200);
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
