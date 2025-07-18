<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use App\Models\ElectionModel;
use App\Models\VoteModel;

class Vote extends BaseController
{
    /**
     * Show all open elections.
     */
    public function index()
    {
        $electionModel = new ElectionModel();
        $data['elections'] = $electionModel
            ->where('status', 'open')
            ->findAll();

        return view('vote/index', $data);
    }

    /**
     * List candidates for a specific election.
     */
    public function candidates(int $election_id)
    {
        $candidateModel = new CandidateModel();
        $data['candidates']   = $candidateModel
            ->where('election_id', $election_id)
            ->findAll();
        $data['election_id']  = $election_id;

        return view('vote/candidates', $data);
    }

    /**
     * Cast a vote for a candidate and immediately show results.
     */
    public function cast(int $election_id)
    {
        // Validate input
        if (! $this->validate(['candidate_id' => 'required|integer'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Please select a candidate before voting.');
        }

        $user_id      = session('user_id');
        $candidate_id = (int) $this->request->getPost('candidate_id');
        $voteModel    = new VoteModel();

        // Prevent double voting per election
        if ($voteModel->where('election_id', $election_id)
                      ->where('user_id', $user_id)
                      ->first()) {
            return redirect()->to(site_url("vote/result/{$election_id}"))
                        ->with('error', 'You have already cast your vote.');
        }

        // Insert vote
        $voteModel->insert([
            'election_id'  => $election_id,
            'candidate_id' => $candidate_id,
            'user_id'      => $user_id,
        ]);

        // After saving, redirect to results with success message
        return redirect()->to(site_url("vote/result/{$election_id}"))
            ->with('success', 'Your vote has been recorded.');
    }

    /**
     * Show the results of an election.
     */
    public function result(int $election_id)
    {
        $candidateModel = new CandidateModel();
        $voteModel      = new VoteModel();

        $candidates = $candidateModel
            ->where('election_id', $election_id)
            ->findAll();

        foreach ($candidates as &$candidate) {
            $candidate['votes'] = $voteModel
                ->where('election_id', $election_id)
                ->where('candidate_id', $candidate['id'])
                ->countAllResults();
        }

        $data = [
            'candidates'  => $candidates,
            'election_id' => $election_id,
            'error'       => session()->getFlashdata('error'),
            'success'     => session()->getFlashdata('success'),
        ];

        return view('vote/result', $data);
    }

    /**
     * Redirect /vote/show/{id} to results.
     */
    public function show(int $id)
    {
        return redirect()->to(site_url("vote/result/{$id}"));
    }
}
