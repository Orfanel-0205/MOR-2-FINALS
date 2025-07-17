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

    public function cast($election_id)
    {
        $candidate_id = $this->request->getPost('candidate_id');

        $voteModel = new VoteModel();
        $voteModel->save([
            'election_id' => $election_id,
            'candidate_id' => $candidate_id,
            'user_id' => session('user_id') // Make sure user_id is set in session
        ]);

        return redirect()->to(base_url('vote/' . $election_id));
    }

    public function result($election_id)
    {
        $candidateModel = new CandidateModel();
        $voteModel = new VoteModel();

        $candidates = $candidateModel->where('election_id', $election_id)->findAll();

        foreach ($candidates as &$candidate) {
            $candidate['votes'] = $voteModel
                ->where('candidate_id', $candidate['id'])
                ->countAllResults();
        }

        $data['candidates'] = $candidates;
        $data['election_id'] = $election_id;

        return view('vote/result', $data);
    }

    public function show($id)
    {
        return redirect()->to(base_url('vote/result/' . $id));
    }
}
