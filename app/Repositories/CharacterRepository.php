<?php

namespace App\Repositories;

use App\Models\Character;

class CharacterRepository
{
    public function getAllCharacters()
    {
        return Character::all();
    }

    public function create(array $data)
    {
        return Character::create($data);
    }

    public function findById($id)
    {
        return Character::find($id);
    }

    public function update($id, array $data)
    {
        $character = $this->findById($id);
        $character->update($data);

        return $character;
    }

    public function delete($id)
    {
        $character = $this->findById($id);
        $character->delete();
    }
}
