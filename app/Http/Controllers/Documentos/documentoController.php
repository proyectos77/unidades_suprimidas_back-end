<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Http\Resources\Documento\informacionDocumentoService;
use App\Http\Responses\Responses;
use App\Services\Documentos_services\registroDocumentosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class documentoController extends Controller
{
    private $informacionDocumento;
    private $registroDocumento;

    public function __construct(
        informacionDocumentoService $informacionDocumento,
        registroDocumentosService $registroDocumento
    ) {
        $this->informacionDocumento = $informacionDocumento;
        $this->registroDocumento = $registroDocumento;
    }

    public function store(Request $request)
    {
        try {
            return $this->registroDocumento->gestionRegistro($request, $op = 1);
        } catch (\Symfony\Component\HttpKernel\Exception\HttpException $e) {
            return Responses::error(422, 'Error de validación', $e->getMessage(), '');
        }
    }

    public function show(string $id)
    {
        return $this->informacionDocumento->verDocumento($id);
    }

    public function verDocumento($ruta)
    {
        $disk = config('filesystems.default');

        if (!Storage::disk($disk)->exists($ruta)) {
            return response()->json([
                'error' => 'Archivo no encontrado'
            ], 404);
        }

        // 🔥 RUTA REAL (SIN depender de Storage::path)
        $fullPath = '/bodega/unidades-suprimidas/' . $ruta;

        if (!file_exists($fullPath)) {
            return response()->json([
                'error' => 'Archivo no existe físicamente'
            ], 404);
        }

        // 🔥 MIME con PHP
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $fullPath);
        finfo_close($finfo);

        return response()->file($fullPath, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline',
        ]);
    }
}
