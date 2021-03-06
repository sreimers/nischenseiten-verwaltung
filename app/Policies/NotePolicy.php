<?php

namespace App\Policies;

use App\User;
use App\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{

    use HandlesAuthorization;

    /**
     * Determine whether the user can view the note.
     *
     * @param App\User $user
     * @param App\Note $note
     *
     * @return bool
     */
    public function view(User $user, Note $note)
    {
        return true;
    }

    /**
     * Determine whether the user can create notes.
     *
     * @param App\User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param App\User $user
     * @param App\Note $note
     *
     * @return bool
     */
    public function update(User $user, Note $note)
    {
        if ($user->role->level > 90) {
            return true;
        }
        if ($user->id === $note->project->user_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param App\User $user
     * @param App\Note $note
     *
     * @return bool
     */
    public function delete(User $user, Note $note)
    {
        if ($user->role->level > 90) {
            return true;
        }
        if ($user->id === $note->project->user_id) {
            return true;
        }

        return false;
    }
}
