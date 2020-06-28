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



}
