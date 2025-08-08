<?php

namespace App\Http\Controllers;

use App\Http\Requests\Character\StoreCharacterRequest;
use App\Http\Requests\Character\UpdateCharacterRequest;
use App\Services\CharacterService;

class CharacterController extends Controller
{
    private $characterService;

    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    public function index()
    {
        $characters = $this->characterService->getAllCharacters();

        return response()->json($characters);
    }

    public function store(StoreCharacterRequest $request)
    {
        $character = $this->characterService->createCharacter($request->validated());

        return response()->json($character, 201);
    }

    public function show(string $id)
    {
        $character = $this->characterService->findCharacterById($id);

        return response()->json($character);
    }

    public function update(UpdateCharacterRequest $request, string $id)
    {
        $character = $this->characterService->updateCharacter($id, $request->validated());

        return response()->json($character);
    }

    public function destroy(string $id)
    {
        $this->characterService->deleteCharacter($id);

        return response()->noContent();
    }
}
