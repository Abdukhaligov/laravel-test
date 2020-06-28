<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Repositories\Interfaces\MediaRepositoryInterface;
use App\Repositories\Interfaces\PositionRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
  private $userRepository;
  private $companyRepository;
  private $positionRepository;
  private $mediaRepository;

  public function __construct(UserRepositoryInterface $userRepository,
                              CompanyRepositoryInterface $companyRepository,
                              PositionRepositoryInterface $positionRepository,
                              MediaRepositoryInterface $mediaRepository) {
    $this->userRepository = $userRepository;
    $this->companyRepository = $companyRepository;
    $this->positionRepository = $positionRepository;
    $this->mediaRepository = $mediaRepository;
  }


  public function profileMedia() {
    $model = get_class(new User());
    $user = Auth::user();

    $data["user"] = $user;
    $data["companies"] = $this->companyRepository->all();
    $data["positions"] = $this->positionRepository->all();
    $data["media"] = $this->mediaRepository->getMedia($model, $user->id, "user_media");

    foreach ($data["media"] as $media){
      $media->path = Storage::disk('media')->url($media->id."/".$media->path);
    }

    return view("profile-media", compact("data"));
  }

  public function profileMediaUpload(Request $request) {
    $model = get_class(new User());
    $userId = Auth::user()->id;
    $orderIndex = $this->mediaRepository->lastMediaOrder($model, $userId);

    foreach ($request->allFiles()["uploads"] as $file) {
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

    return redirect()->back();
  }

}
