    <?php

    namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Notation;
    use Illuminate\Http\Request;

    class NotationController extends Controller
    {
        public function saveNotes(Request $request)
        {
            $notes = $request->input('notes', []);

            foreach ($notes as $stagiaire_id => $evaluations) {
                foreach ($evaluations as $key => $note) {
                    // Extract evaluation_id from the key
                    if (preg_match('/^evaluation_(\d+)$/', $key, $matches)) {
                        $evaluation_id = $matches[1];
                        
                        // Convert note to integer
                        $note = intval($note);

                        Notation::updateOrCreate(
                            ['stagiaire_id' => $stagiaire_id, 'evaluation_id' => $evaluation_id],
                            ['note' => $note]
                        );
                    }
                }
            }

            return redirect()->back()->with('success', 'Notes sauvegardées avec succès.');
        }

    }