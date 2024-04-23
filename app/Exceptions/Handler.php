<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Inertia\Inertia;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Prepare exception for rendering.
     *
     * @param  \Throwable  $e
     * @return \Throwable
     */
    public function render($request, Throwable $e)
    {
        $response = parent::render($request, $e);

        if (in_array($response->status(), [401, 403, 404, 419, 429, 500, 503])) {
            $responseObject = [
                'status' => $response->status(),
                'message' => $this->getStatusMessage($response->status()),
            ];

            return Inertia::render('Errors/Index', $responseObject)
                ->toResponse($request)
                ->setStatusCode($response->status());
        }

        return $response;
    }

    private function getStatusMessage($statusCode)
    {
        $responseMessage = '';

        switch ($statusCode) {
            case 401:
                return 'Anda tidak diijinkan mengakses halaman ini.';
                break;
            case 403:
                return 'Anda tidak diijinkan mengakses halaman ini.';
                break;
            case 404:
                return 'Halaman yang anda cari tidak ditemukan.';
                break;
            case 419:
                return 'Halaman Form Input Kadaluarsa.';
                break;
            case 429:
                return 'Terlalu Banyak Permintaan pada Halaman ini.';
                break;
            case 500:
                return 'Terjadi Error di Server.';
                break;
            case 503:
                return 'Terjadi kesalahan pada Server.';
                break;
        }

        return $responseMessage;
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
