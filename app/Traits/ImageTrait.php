<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

trait ImageTrait
{
    /**
     * @param  Request  $request
     * @return $this|false|string
     */
    public function getImageAttribute($value)
    {
        if ($value) {
            return getimg($value);
        } elseif (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        } else {
            return asset('storage/images/default.jpg');
        }
    }

    public function setImageAttribute($value, $directory = 'images')
    {
        if (is_file($value)) {
            $this->attributes['image'] = uploader($value, $directory);
        } else {
            $this->attributes['image'] = $value;
        }
    }

    public function uploadImage($folder, $image)
    {
        $image->store('/', $folder);
        $filename = $image->hashName();
        $path = 'images/'.$filename;

        return $path;
    }

    public static function SaveFile($file, $folder)
    {
        if (isset($file)) {
            $name = time().'_'.rand(1, 999999999).'.'.$file->getClientOriginalExtension();

            // $path = realpath('public/uploads') ? realpath('public/uploads') : realpath('uploads');
            $path = public_path('uploads/'.$folder);

            if (! file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $file->move($path, $name);
            $fileName = $name;

            return $fileName;
        }

        return '';
    }

    protected function saveAttachments($model, array $fields, $folder)
    {
      foreach ($fields as $field) {
        $file = request()->file($field);
        // إذا تم رفع الملف الآن (في نفس الطلب)
        if ($file) {
            if (!empty($model->$field)) {
                $model->deleteImg($model->$field); 
            }
            $fileName = $this->SaveFile($file, $folder);
            $model->update([$field => $fileName]);
        }

        // أو إذا الملف محفوظ مؤقتًا في الجلسة بعد فشل التحقق
        elseif (session()->has($field)) {
            $sessionFile = session($field);
            $tempPath = storage_path('app/public/' . $sessionFile['path']);

            if (file_exists($tempPath)) {
                 $uploadedFile = new UploadedFile(
                    $tempPath,
                    $sessionFile['original_name'], // الاسم الحقيقي للملف
                    null,
                    null,
                    true
                );

                $fileName = $this->SaveFile($uploadedFile, $folder);
                $model->update([$field => $fileName]);

                // احذف الملف المؤقت من التخزين المؤقت
                Storage::disk('public')->delete(is_array($sessionFile) ? $sessionFile['path'] : $sessionFile);
                session()->forget($field);
            }
        }
      }
    }
}
