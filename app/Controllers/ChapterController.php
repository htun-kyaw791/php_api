<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\ChapterModel;
use App\Helpers\ResponseHelper;
use App\Helpers\FileHelper;

class ChapterController extends Controller
{
    private $chapterModel;

    public function __construct()
    {
        $this->chapterModel = new ChapterModel();
    }
    public function createChapter()
    {
        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['name']) || empty($requestData['course_id']) || empty($requestData['link'])) {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }

        $existingName = $this->chapterModel->findByName($requestData['name']);
        if ($existingName) {
            $response = ResponseHelper::error('Name Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }

        $chapterData = [
            'name' => $requestData['name'],
            'course_id' => $requestData['course_id'],
            'link' => $requestData['link']
        ];
        $result = $this->chapterModel->create($chapterData);
        $response = ResponseHelper::success($result, 'Data created successfully', 201);
        return $this->jsonResponse($response, 201);
    }

    public function updateChapter($request)
    {
        // not allow teachers to update data
        if($request['user']['role'] =='teacher' && $request['user']['id'] != $request['params'][0]  )
        {
            $response = ResponseHelper::error('Permission Denied', 403);
            return $this->jsonResponse($response, 403);
        }

        $Chapter = $this->chapterModel->findById($request['params'][0]);
        if (!$Chapter) 
        {
            $response = ResponseHelper::error('Chapter not found', 403);
            return $this->jsonResponse($response, 403);
        }

        $requestData = json_decode(file_get_contents('php://input'), true);
        if (empty($requestData['name']) && empty($requestData['course_id']) ) 
        {
            $response = ResponseHelper::error('Missing required fields', 400);
            return $this->jsonResponse($response, 400);
        }
        $existingName = $this->chapterModel->findByName($requestData['name']);
        if ($existingName) {
            $response = ResponseHelper::error('Name Already Exist', 400);
            return $this->jsonResponse($response, 400);
        }
        else{
            $chapterData = [
                'name' => $requestData['name'],
                'course_id' => $requestData['course_id'],
                'link' => $requestData['link']

            ];
        }
        $result = $this->chapterModel->update($request['params'][0],$chapterData);

        if ($result) {
            $response = ResponseHelper::success($result, 'Data updated successfully');
        } else {
            $response = ResponseHelper::error('Failed to update data', 500);
        }
        
        return $this->jsonResponse($response);
    }


    public function getChapter()
    {
        $chapters = $this->chapterModel->fetchAll();
        $response = ResponseHelper::success($chapters, 'Data fetched successfully');
        return $this->jsonResponse($response);
    }
    public function getChapterById($request)
    {
        $chapter = $this->chapterModel->findById($request['params'][0]);
        if ($chapter) {
            $response = ResponseHelper::success($chapter, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Chapter not found', 403);
        }

        return $this->jsonResponse($response);
    }
    public function getTeacherByID($request)
    {
        $chapter = $this->chapterModel->findByTeacherId($request['params'][0]);
        if ($chapter) {
            $response = ResponseHelper::success($chapter, 'Data fetched successfully');
        } else {
            $response = ResponseHelper::error('Chapter not found', 403);
        }

        return $this->jsonResponse($response);
    }
    public function deleteChapter($request)
    {
        $result = $this->chapterModel->delete($request['params'][0]);
        if ($result) {
            $response = ResponseHelper::success(null, 'Data deleted successfully', 204);
        } else {
            $response = ResponseHelper::error('Failed to delete data', 500);
        }

        return $this->jsonResponse($response);
    }
}
    