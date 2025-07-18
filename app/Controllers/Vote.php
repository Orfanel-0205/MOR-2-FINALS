<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CandidateModel;
use App\Models\ElectionModel;
use App\Models\VoteModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Vote extends BaseController
{
    protected $electionModel;
    protected $candidateModel;
    protected $voteModel;

    public function __construct()
    {
        $this->electionModel = new ElectionModel();
        $this->candidateModel = new CandidateModel();
        $this->voteModel = new VoteModel();
    }

    public function candidates(int $election_id)
    {
        $election = $this->electionModel->find($election_id);
        if (!$election) {
            throw new PageNotFoundException('Election not found.');
        }

        $candidates = $this->candidateModel->where('election_id', $election_id)->findAll();

        return view('vote/candidates', [
            'election'   => $election, // Make sure this is passed
            'candidates' => $candidates,
            'title'      => $election['title'] // Optional: separate title variable
        ]);
    }

    public function cast(int $election_id)
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->with('error', 'Invalid request method.');
        }

        $candidate_id = $this->request->getPost('candidate_id');

        if (!$candidate_id) {
            return redirect()->back()->with('error', 'Candidate not selected.');
        }

        // Check if user already voted in this election
        $existingVote = $this->voteModel
            ->where('election_id', $election_id)
            ->where('user_id', session('user_id'))
            ->first();

        if ($existingVote) {
            // Update existing vote if changing candidate selection
            $this->voteModel->update($existingVote['id'], [
                'candidate_id' => $candidate_id,
                'voted_at' => date('Y-m-d H:i:s')
            ]);
            
            return redirect()->to("vote/result/{$election_id}")
                ->with('success', 'Your vote has been updated.');
        }

        // Insert new vote if first time voting
        $this->voteModel->insert([
            'election_id'  => $election_id,
            'candidate_id' => $candidate_id,
            'user_id'      => session('user_id'),
            'voted_at'     => date('Y-m-d H:i:s')
        ]);

        return redirect()->to("vote/result/{$election_id}")
            ->with('success', 'Vote successfully cast.');
    }

    public function result(int $election_id)
    {
        $candidates = $this->candidateModel->where('election_id', $election_id)->findAll();

        foreach ($candidates as &$candidate) {
            $candidate['votes'] = $this->voteModel
                ->where('election_id', $election_id)
                ->where('candidate_id', $candidate['id'])
                ->countAllResults();
        }

        return view('vote/result', [
            'candidates'  => $candidates,
            'election_id' => $election_id,
            'error'       => session()->getFlashdata('error'),
            'success'     => session()->getFlashdata('success'),
        ]);
    }

    public function show(int $id)
    {
        return redirect()->to("vote/result/{$id}");
    }
}
