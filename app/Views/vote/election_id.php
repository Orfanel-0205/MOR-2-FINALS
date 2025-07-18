<?php foreach ($candidates as $candidate): ?>
  <div class="candidate-card">
    <!-- ... display name, image, etc. ... -->

    <form 
      method="post" 
      action="<?= site_url('vote/cast/' . $election_id) ?>"
    >
      <?= csrf_field() ?>
      <input 
        type="hidden" 
        name="candidate_id" 
        value="<?= esc($candidate['id']) ?>"
      >
      <button type="submit">
        Vote for <?= esc($candidate['name']) ?>
      </button>
    </form>
  </div>
<?php endforeach; ?>
