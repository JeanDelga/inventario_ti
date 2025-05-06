<div id="etiqueta-content" style="border: 1px solid #000; width: 350px; height: 150px; padding: 10px; display: flex; align-items: center; justify-content: space-between;">
    <img src="{{ asset('images/logo_brval.png') }}" alt="Logo" style="width: 100px;">
    <div>{!! $qrcode !!}</div>
    <div style="writing-mode: vertical-rl; transform: rotate(180deg); font-weight: bold;">
        {{ $device->code }}
    </div>
</div>

<div style="text-align: center; margin-top: 10px;">
    <button onclick="printEtiqueta()" style="background-color: #3b82f6; color: white; padding: 6px 12px; border: none; border-radius: 4px; cursor: pointer;">
        Imprimir Etiqueta
    </button>
</div>

<script>
    function printEtiqueta() {
        const etiqueta = document.getElementById('etiqueta-content').outerHTML;
        const janela = window.open('', '_blank', 'width=600,height=400');
        janela.document.write('<html><head><title>Imprimir Etiqueta</title></head><body>' + etiqueta + '</body></html>');
        janela.document.close();
        janela.focus();
        janela.print();
        janela.close();
    }
</script>
