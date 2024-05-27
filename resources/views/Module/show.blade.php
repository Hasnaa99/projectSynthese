<style>
    p {
        font-size: 0.9rem;
    }

    h1 {
        color: rgb(38, 78, 14);
    }
    .input_notes{
        width: 40%;
    }
</style>

<x-master title="Module Details">
    <div class="container vh-200">
        <form method="POST" action="{{ route('save_notes') }}">
            @csrf
        <div class="header d-flex justify-content-between mt-3">
            <img src="{{ asset('images/Logo_ofppt.png') }}" width="8%" alt="Logo OFPPT">
            <div class="mt-2">
                <strong style="font-size: 0.9rem">Direction Régionale</strong>
                <p class=" text-center"><strong style="font-size: 0.9rem">Marrakech-Safi</strong></p>
            </div>
        </div>

        <h1 style="font-size: 1.9rem" class="my-2 mb-5 text-center">Procès Verbal de Fin de Module</h1>

        <div>
            <p><strong>Etablissement :</strong> INSTITUT SPECIALISE DE TECHNOLOGIE APPLIQUEE NTIC SAFI</p>
        </div>
        <div class="info-section d-flex justify-content-between">
            <div class="left-info">
                <p><strong>Filière :</strong> {{ $groupe->specialite }}</p>
                <p><strong>Groupe de formation :</strong> {{ $groupe->codeG }} ({{ $groupe->niveauF }} année)</p>
                <p><strong>Intitulé du module :</strong> {{ $module->intitule }} ({{ $module->codeM }})</p>
            </div>
            <div class="right-info">
                <p><strong>Année de formation :</strong> {{ $groupe->annee_scolaire }}</p>
                <p><strong>Niveau :</strong> {{ $groupe->niveau }}</p>
                <p><strong>Inscrits :</strong> {{ $groupe->stagiaires->count() }}</p>
            </div>
        </div>
        <hr />
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        <h1 style="font-size: 1.9rem" class="text-center my-4">Saisir les notes des stagiaires de groupe
            {{ $groupe->codeG }}</h1>
        <a class="btn btn-success mb-4"
            href="{{ route('create_evaluation', ['groupe_id' => $groupe, 'module_id' => $module]) }}">Ajouter évaluation</a>
        <table class="table table-bordered">
            <tr class="text-center bg-light">
                <th>CEF</th>
                <th>Nom</th>
                <th>Prénom</th>
                @foreach ($evaluations as $evaluation)
                    <th>{{ $evaluation->type }} {{ $evaluation->numero_ctrl }}</th>
                @endforeach
            </tr>
            @foreach ($groupe->stagiaires as $stagiaire)
                <tr class="text-center">
                    <td>{{ $stagiaire->cef }}</td>
                    <td>{{ $stagiaire->nom }}</td>
                    <td>{{ $stagiaire->prenom }}</td>
                    @foreach ($evaluations as $evaluation)
                        <td style="width:12%">
                            <input type="text" name="notes[{{ $stagiaire->id }}][evaluation_{{ $evaluation->id }}]" class="evaluationInput input_notes" data-row="{{ $loop->parent->index }}" data-column="{{ $loop->index }}"/>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
        <div class="d-flex justify-content-end mt-4">
            <a class="btn btn-danger mx-2" href="{{ url()->previous() }}">Annuler</a>
            <button type="submit" class="btn btn-primary">Sauvegarder</button>
        </div>
    </form>
    </div>
</x-master>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.evaluationInput');
        inputs.forEach(input => {
            input.addEventListener('keydown', function(event) {
                const rowIndex = parseInt(input.dataset.row);
                const colIndex = parseInt(input.dataset.column);
                if (event.key === 'ArrowUp' || event.keyCode === 38) {
                    event.preventDefault();
                    const prevRowInput = document.querySelector(`.evaluationInput[data-row="${rowIndex - 1}"][data-column="${colIndex}"]`);
                    if (prevRowInput) {
                        prevRowInput.focus();
                    }
                } else if (event.key === 'ArrowDown' || event.keyCode === 40) {
                    event.preventDefault();
                    const nextRowInput = document.querySelector(`.evaluationInput[data-row="${rowIndex + 1}"][data-column="${colIndex}"]`);
                    if (nextRowInput) {
                        nextRowInput.focus();
                    }
                }
            });
        });
    });
</script>
