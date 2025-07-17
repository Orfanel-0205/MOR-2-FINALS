<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use App\Models\ElectionModel;

class Vote extends BaseController
{
    public function index()
    {
        $electionModel = new ElectionModel();
        $elections = $electionModel->findAll();

        return view('vote/elections', ['elections' => $elections]);
    }

    public function candidates($electionId)
    {
        $model = new CandidateModel();
        $candidates = $model->where('election_id', $electionId)->findAll();

        return view('vote/candidates_list', [
            'electionId' => $electionId,
            'candidates' => $candidates
        ]);
    }

    public function cast($candidateId)
    {
        // Dummy implementation (replace with VoteModel logic)
        // $voteModel = new VoteModel();
        // $voteModel->save(['candidate_id' => $candidateId, ...]);

        return redirect()->to('/vote/result/1');
    }

    public function result($electionId)
    {
        $model = new CandidateModel();
        $candidates = $model->where('election_id', $electionId)
                            ->orderBy('votes', 'DESC')
                            ->findAll();

        return view('vote/result', ['candidates' => $candidates]);
    }
}
