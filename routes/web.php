<?php

use Illuminate\Support\Facades\Route;
use App\Models\Device;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/devices/{device}/etiqueta-pdf', function (Device $device) {
    $url = "http://100.65.1.158:8000/equipamento/{$device->code}";
    $qrcodeSvg = QrCode::format('svg')->size(120)->generate($url);
    $qrcode = 'data:image/svg+xml;base64,' . base64_encode($qrcodeSvg);

    $pdf = Pdf::loadView('pdfs.etiqueta', compact('device', 'qrcode'));
    return $pdf->stream("etiqueta_{$device->code}.pdf");
})->name('devices.etiqueta.pdf');


Route::get('/equipamento/{code}', function (string $code) {
    $device = Device::where('code', $code)->firstOrFail();
    return view('equipamento', compact('device'));
})->name('equipamento.publico');


Route::get('/relatorios/equipamentos', function () {
    $query = Device::query();

    if ($empresa = request('empresa')) {
        $query->where('company', $empresa);
    }

    if ($tipo = request('tipo')) {
        $query->where('device_type', $tipo);
    }

    if ($inicio = request('inicio')) {
        $query->whereDate('purchase_date', '>=', $inicio);
    }

    if ($fim = request('fim')) {
        $query->whereDate('purchase_date', '<=', $fim);
    }

    $devices = $query->get();

    $pdf = Pdf::loadView('pdfs.relatorios.equipamentos', compact('devices'));
    return $pdf->stream('relatorio_equipamentos.pdf');
})->name('relatorios.equipamentos');

