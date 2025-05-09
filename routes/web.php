<?php

use Illuminate\Support\Facades\Route;
use App\Models\Device;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/devices/{device}/etiqueta-pdf', function (Device $device) {
    $info = "
        EQUIPAMENTO: {$device->code}
        TIPO: {$device->device_type}
        LOCAL: {$device->department?->name}
        USUÁRIO: {$device->assignedUser?->name}
        IP: {$device->ip_address}
    ";

    $qrcodeSvg = QrCode::format('png')->size(120)->generate($info);
    $qrcode = 'data:image/png;base64,' . base64_encode($qrcodeSvg);

    $pdf = Pdf::loadView('pdfs.etiqueta', compact('device', 'qrcode'));
    return $pdf->stream("etiqueta_{$device->code}.pdf");
})->name('devices.etiqueta.pdf');
