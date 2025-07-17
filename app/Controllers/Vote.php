<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use App\Models\ElectionModel;
use App\Models\VoteModel;

class Vote extends BaseController
{
    public function index()
    {
        $electionModel = new ElectionModel();
        $data['elections'] = $electionModel->where('status', 'open')->findAll();

        return view('vote/index', $data);
    }

    public function candidates($election_id)
    {
        $candidateModel = new CandidateModel();

        $data['candidates'] = $candidateModel->where('election_id', $election_id)->findAll();
        $data['election_id'] = $election_id;

        return view('vote/candidates', $data);
    }

    // ✅ Add this method to handle vote submission
    public function cast($election_id)
    {
        $candidate_id = $this->request->getPost('candidate_id');

        if (! $candidate_id) {
            return redirect()->back()->with('error', 'No candidate selected.');
        }

        $voteModel = new VoteModel();

        $voteModel->save([
            'election_id' => $election_id,
            'candidate_id' => $candidate_id,
            'user_id' => session('user_id') // assumes user ID is stored in session after login
        ]);

        return redirect()->to(base_url('vote/result/' . $election_id));
    }
}
