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

  public function index() {
    dump($this->userRepository->all());
    return view("home");

  }

  public function create() {
    //
  }

  public function store(Request $request) {
    //
  }

  public function show($id) {
    dump($this->userRepository->getById($id));
    return view("home");
  }


  public function profile() {
    $data["user"] = Auth::user();
    $data["companies"] = $this->companyRepository->all();
    $data["positions"] = $this->positionRepository->all();

    return view("profile", compact("data"));
  }

  public function profileMedia() {
    $data["user"] = Auth::user();
    $data["companies"] = $this->companyRepository->all();
    $data["positions"] = $this->positionRepository->all();

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

  public function update(UserRequest $request) {
    $user = Auth::user();
    $input = $request->all();

    $this->userRepository->update($user->id, $input["name"], $input["company_id"], $input["position_id"]);

    return redirect()->back();
  }

  public function destroy(User $user) {
    //
  }
}
