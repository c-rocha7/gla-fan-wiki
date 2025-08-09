<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FileUploadController extends Controller
{
    /**
     * Upload um arquivo para o MinIO.
     */
    public function upload(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'file'   => 'required|file|max:10240', // máximo 10MB
            'folder' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Dados inválidos',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            $file   = $request->file('file');
            $folder = $request->input('folder', 'uploads');

            // Gerar nome único para o arquivo
            $fileName = time().'_'.$file->getClientOriginalName();
            $filePath = $folder.'/'.$fileName;

            // Upload para o MinIO usando o disk 'minio'
            $uploaded = Storage::disk('minio')->put($filePath, file_get_contents($file));

            if ($uploaded) {
                return response()->json([
                    'success' => true,
                    'message' => 'Arquivo enviado com sucesso',
                    'data'    => [
                        'file_name' => $fileName,
                        'file_path' => $filePath,
                        'file_size' => $file->getSize(),
                        'file_type' => $file->getMimeType(),
                    ],
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Falha ao enviar arquivo',
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Listar arquivos do MinIO.
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $folder = $request->input('folder', 'uploads');
            $files  = Storage::disk('minio')->files($folder);

            $fileList = [];
            foreach ($files as $file) {
                $fileList[] = [
                    'name'          => basename($file),
                    'path'          => $file,
                    'size'          => Storage::disk('minio')->size($file),
                    'last_modified' => Storage::disk('minio')->lastModified($file),
                ];
            }

            return response()->json([
                'success' => true,
                'files'   => $fileList,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao listar arquivos: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Download de arquivo do MinIO.
     */
    public function download(Request $request, string $filePath)
    {
        try {
            if (!Storage::disk('minio')->exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Arquivo não encontrado',
                ], 404);
            }

            $fileContent = Storage::disk('minio')->get($filePath);
            $fileName    = basename($filePath);

            return response($fileContent)
                ->header('Content-Disposition', 'attachment; filename="'.$fileName.'"');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao baixar arquivo: '.$e->getMessage(),
            ], 500);
        }
    }

    /**
     * Deletar arquivo do MinIO.
     */
    public function delete(Request $request, string $filePath): JsonResponse
    {
        try {
            if (!Storage::disk('minio')->exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Arquivo não encontrado',
                ], 404);
            }

            $deleted = Storage::disk('minio')->delete($filePath);

            if ($deleted) {
                return response()->json([
                    'success' => true,
                    'message' => 'Arquivo deletado com sucesso',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Falha ao deletar arquivo',
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao deletar arquivo: '.$e->getMessage(),
            ], 500);
        }
    }
}
