<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Groupe;
use App\Models\Module;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function show(Groupe $groupe, Module $module)
    {
        // Récupérer toutes les évaluations pour ce groupe et ce module
        $evaluations = Evaluation::where('groupe_id', $groupe->id)
            ->where('module_id', $module->id)
            ->get();

        return view('module.show', compact('groupe', 'module', 'evaluations'));
    }
    
    public function create_evaluation($groupe_id, $module_id)
    {
        $groupe = Groupe::findOrFail($groupe_id);
        $module = Module::findOrFail($module_id);
        return view('createEvaluation', compact('groupe', 'module'));
    }
    public function store_evaluation(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:CC,EFM',
            'date' => 'required|date',
            'bareme' => 'required|in:20,40',
            'duree' => 'required|min:1',
            'groupe_id' => 'required|exists:groupes,id',
            'module_id' => 'required|exists:modules,id',
            'numero_ctrl' => 'sometimes|required_if:type,CC|nullable'
        ]);

        Evaluation::create($validatedData);
        return redirect()->route('module.show', ['groupe' => $validatedData['groupe_id'], 'module' => $validatedData['module_id'],'']);
    }
}
