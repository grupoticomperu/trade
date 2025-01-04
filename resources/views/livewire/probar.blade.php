<div>
    
    <div>
        <button wire:click="triggerAlert">Mostrar SweetAlert</button>
    
        <script>
            window.addEventListener('alert', event => {
                Swal.fire({
                    icon: event.detail.type,
                    title: 'Notificación',
                    text: event.detail.message,
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    </div>
    


</div>
