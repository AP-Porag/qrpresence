<?php

namespace App\Services;

use File;
use Image;
use App\Utils\GlobalConstant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 *
 */
class BaseService
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $limit
     * @param array $with
     * @param bool $own_data
     * @return Builder[]|Collection|void
     * @throws \Exception
     */
    public function getRecent(int $limit = GlobalConstant::DEFAULT_RECENT_LIMIT, array $with = [], bool $own_data = false)
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            return $query->latest()->take($limit)->get();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param int $limit
     * @param array $with
     * @return void
     * @desc Get recent data with limit and relation
     */
    public function getRecentActive(int $limit = GlobalConstant::DEFAULT_RECENT_LIMIT, array $with = [], bool $own_data = false)
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            return $query->active()->latest()->take($limit)->get();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param int $user_id
     * @param array $with
     * @return Builder|Model|object|void|null
     */
    public function getByUserId(int $user_id, array $with = [])
    {
        try {
            return $this->model::with($with)->where('user_id', $user_id)->first();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param string $slug
     * @param bool $own_data
     * @return Builder|Model|object|void|null
     */
    public function getBySlug(string $slug, bool $own_data = false, array $with = [])
    {
        try {
            $query = $this->model::query()->where('slug', $slug)->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            return $query->first();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param $slug
     * @param bool $own_data
     * @return void
     * @throws \Exception
     */
    public function getBySlugActive($slug, bool $own_data = false)
    {
        try {
            $query = $this->model::query()->where('slug', $slug);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', $own_data);
            }
            return $query->active()->first();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param int $limit
     * @param array $with
     * @param bool $own_data
     * @param string|null $sort
     * @param string $sort_by
     * @return void
     * @throws \Exception
     */
    public function getPaginatedActive(int $limit = GlobalConstant::DEFAULT_PER_PAGE, array $with = [], bool $own_data = false, string $sort = null, string $sort_by = 'DESC')
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            // Sort data
            if ($sort) {
                $query->orderBy($sort, $sort_by);
            }
            return $query->active()->paginate($limit);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param int $limit
     * @param array $with
     * @param bool $own_data
     * @param string|null $sort
     * @param string $sort_by
     * @return LengthAwarePaginator|void
     */
    public function getPaginated(int $limit = GlobalConstant::DEFAULT_PER_PAGE, array $with = [], bool $own_data = false, string $sort = null, string $sort_by = 'DESC')
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            // Sort data
            if ($sort) {
                $query->orderBy($sort, $sort_by);
            }
            return $query->paginate($limit);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param null $id
     * @param array $with
     * @param bool $own_data
     * @return Builder|Builder[]|Collection|Model|void|null
     */
    public function get($id = null, array $with = [], bool $own_data = false)
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            // If contain id return single data or return collection
            if ($id) {
                return $query->findOrFail($id);
            } else {
                return $query->get();
            }
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param $id
     * @param array $with
     * @param bool $own_data
     * @return void
     */
    public function getActiveData($id = null, array $with = [], bool $own_data = false)
    {
        try {
            $query = $this->model::query()->with($with);
            // Check data belongs to provided user
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            // If contain id return single data or return collection
            if ($id) {
                return $query->active()->findOrFail($id);
            } else {
                return $query->active()->get();
            }
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param array $data
     * @param null $id
     * @return void
     */
    public function storeOrUpdate(array $data, $id = null)
    {
        try {
            // If contain id update data or create new data
            if ($id) {
                return $this->model::findOrFail($id)->update($data);
            } else {
                return $this->model::create($data);
            }
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param $id
     * @param bool $own_data
     * @return mixed|void
     */
    public function delete($id, bool $own_data = false)
    {
        try {
            $query = $this->model::query();
            $query->where('id', $id);
            // If contain id update data or create new data
            if ($own_data) {
                $query->where('user_id', Auth::id());
            }
            return $query->first()->delete();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param $id
     * @param bool $own_data
     * @param bool $contain_thumb
     * @return bool|mixed|void|null
     * @throws \Exception
     */
    public function deleteWithFile($id, bool $own_data = true, bool $contain_thumb = false)
    {
        try {
            $item = $this->get($id, [], $own_data);
            // Unlink
            try {
                // Remove file
                $image_path = storage_path('app/public/' . $this->model::FILE_STORE_PATH . '/' . $item->image);
                if (file_exists($image_path))
                    unlink($image_path);

                // Remove thumb file
                if ($contain_thumb) {
                    $thumb_path = storage_path('app/public/' . $this->model::FILE_STORE_THUMB_PATH . '/' . $item->image);
                    if (file_exists($thumb_path))
                        unlink($thumb_path);
                }
            } catch (\Exception $e) {
                log_error($e);
            }
            return $item->delete();
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }


    /**
     * @param $image
     * @param string $image_name
     * @return mixed|void
     * @throws \Exception
     */
    public function uploadImageAndThumb($image, string $image_name)
    {
        try {
            $src_path = $image->storeAs($this->model::FILE_STORE_PATH, $image_name);
            // Create thumb directory
            $image->storeAs($this->model::FILE_STORE_THUMB_PATH, $image_name);

            return $src_path;
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }

    /**
     * @param $src_path
     * @param $image_name
     * @return void
     */
    public function generateThumb($src_path, $image_name)
    {
        try {
            // Create thumb
            $full_path = storage_path('app/public/' . $src_path);
            $thumb_path = storage_path('app/public/' . $this->model::FILE_STORE_THUMB_PATH . '/' . $image_name);
            // Set thumb height & width
            $height = $this->model::THUMB_HEIGHT ?? GlobalConstant::DEFAULT_THUMB_HEIGHT;
            $width = $this->model::THUMB_WIDTH ?? GlobalConstant::DEFAULT_THUMB_WIDTH;
            // Convert image to thumb
            $img = Image::make($full_path);
            $img->resize($width, $height, function ($constraint) {
                //                $constraint->aspectRatio();
            });
            $img->save($thumb_path);
        } catch (\Exception $e) {
            log_error($e);
        }
    }

    /**
     * @param $text
     * @param $name
     * @return string|void
     */
    public function generateQrcode($text, $name)
    {
        try {
            $qr_dir_path = storage_path('app/public/' . $this->model::QR_PATH);
            if (!File::isDirectory($qr_dir_path)) {
                File::makeDirectory($qr_dir_path, $mode = 0777, true, true);
            }
            $qr_path = $qr_dir_path . '/' . $name;
            QrCode::size(GlobalConstant::DEFAULT_QR_CODE_SIZE)->generate($text, $qr_path);

            return $name;
        } catch (\Exception $e) {
            log_error($e);
            return '';
        }
    }

    /**
     * @param \Exception $e
     * @return mixed
     * @throws \Exception
     */
    public function logFlashThrow(\Exception $e)
    {
        log_error($e);
        something_wrong_flash();
        throw $e;
    }
}
