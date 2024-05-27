<style>
    .form-label {
        color: #26580E;
        font-weight: 500;
    }

    .btn {
        background-color: #4a7c59;
        color: #fff;
    }

    .btn:hover {
        background-color: #6e977a;
    }

    .container {
        max-width: 600px;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
    }

    .titre {
        color: #26580E;
        font-size:2rem;
    }

    .form-control,
    .form-select {
        border-radius: 5px;
        border: 1px solid #dcdcdc;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: none;
        border-color: #4a7c59;
    }
</style>

<x-master title="Ajouter Évaluation">
    <div class="container vh-100">
        <h1 class="text-center my-4 titre" style="color: #214411;">Ajouter une évaluation</h1>
        <form action="{{route('store_evaluation')}}" method="POST" class="p-4 w-50 mx-auto" style="border: 1px solid #dcdcdc; border-radius: 8px;">
            @csrf
            <input type="hidden" name="groupe_id" value="{{ $groupe->id }}">
            <input type="hidden" name="module_id" value="{{ $module->id }}">
            <div class="mb-3">
                <label for="type" class="form-label" >Type</label>
                <select name="type" id="type" class="form-select" required>
                    <option value="">Sélectionner le type</option>
                    <option value="CC">Contrôle Continu (CC)</option>
                    <option value="EFM">Examen Fin de Module(EFM)</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="numero_ctrl" class="form-label">Numéro de contrôle</label>
                <select name="numero_ctrl" id="numero_ctrl" class="form-select">
                    <option value="">Sélectionner le numéro de contrôle</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label" >Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="bareme" class="form-label" >Barème</label>
                <select name="bareme" id="bareme" class="form-select" required>
                    <option value="">Sélectionner le barème</option>
                    <option value="20">20</option>
                    <option value="40">40</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="duree" class="form-label" >Durée</label>
                <input type="number" name="duree" id="duree" class="form-control" placeholder="Entrer la durée" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn" style="background-color: #4a7c59; color: #fff;">Ajouter Évaluation</button>
            </div>
        </form>
    </div>
</x-master>
