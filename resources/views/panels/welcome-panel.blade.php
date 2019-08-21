<div class="card">
    <div class="card-header @role('admin', true) bg-secondary text-white @endrole">
        <div class="lead text-center">
            <strong>Autoridad de Tránsito Municipal</strong>
        </div>
    </div>
    <div class="card-body text-center">
        <div class="text-center">Bienvenido {{ Auth::user()->name }}</div>
    </div>
</div>
