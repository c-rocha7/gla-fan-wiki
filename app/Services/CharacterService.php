<?php

namespace App\Services;

use App\Repositories\CharacterRepository;

class CharacterService
{
    private $characterRepository;

    public function __construct(CharacterRepository $characterRepository)
    {
        $this->characterRepository = $characterRepository;
    }

    public function getAllCharacters()
    {
        return $this->characterRepository->getAllCharacters();
    }

    public function createCharacter(array $data)
    {
        return $this->characterRepository->create($data);
    }

    public function findCharacterById($id)
    {
        return $this->characterRepository->findById($id);
    }

    public function updateCharacter($id, array $data)
    {
        return $this->characterRepository->update($id, $data);
    }

    public function deleteCharacter($id)
    {
        return $this->characterRepository->delete($id);
    }
}
