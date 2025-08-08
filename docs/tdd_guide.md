# Guia para Implementar TDD (Test-Driven Development)

Este guia descreve como implementar o desenvolvimento orientado a testes (TDD) no seu projeto, garantindo qualidade e confiabilidade no código.

---

## **O Ciclo do TDD**

O TDD segue três etapas principais:

1. **Red**: Escreva um teste que falhe (porque a funcionalidade ainda não foi implementada).
2. **Green**: Implemente o código necessário para passar no teste.
3. **Refactor**: Refatore o código para melhorar sua qualidade, mantendo os testes verdes.

---

## **Passo a Passo para Implementar TDD**

### **1. Planejamento**
- **Defina os requisitos**: Determine o comportamento esperado da funcionalidade.
- **Divida em partes menores**: Crie testes para cada comportamento específico.

---

### **2. Escreva o Primeiro Teste (Red)**
1. Crie um arquivo de teste no diretório `tests/Feature` ou `tests/Unit`.
2. Escreva um teste que descreva o comportamento esperado.
3. Execute o teste e verifique se ele falha.

Exemplo:
```php
public function test_user_can_be_created()
{
    $response = $this->post('/users', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('users', ['email' => 'john@example.com']);
}
```

---

### **3. Implemente o Código (Green)**
1. Escreva o código mínimo necessário para passar no teste.
2. Execute o teste novamente e verifique se ele passa.

Exemplo:
- Adicione a lógica no controlador para criar um usuário:
```php
public function store(StoreUserRequest $request)
{
    $user = User::create($request->validated());
    return response()->json($user, 201);
}
```

---

### **4. Refatore o Código**
1. Melhore o código, mantendo os testes verdes.
2. Remova duplicações e aplique princípios como DRY e SOLID.

Exemplo:
- Mova a lógica de criação para um serviço:
```php
public function createUser(array $data)
{
    return User::create($data);
}
```

---

### **5. Repita o Ciclo**
- Continue escrevendo testes para novos comportamentos e repita o ciclo **Red-Green-Refactor**.

---

## **Dicas para TDD**

1. **Escreva testes pequenos**: Teste um comportamento por vez.
2. **Mantenha os testes rápidos**: Use o banco de dados em memória (`RefreshDatabase`).
3. **Cubra casos de erro**: Teste entradas inválidas e cenários inesperados.
4. **Automatize os testes**: Execute os testes automaticamente antes de cada commit.

---

## **Ferramentas no Laravel**

- **Pest**: Framework de testes simples e legível.
- **PHPUnit**: Ferramenta padrão para testes no Laravel.

Execute os testes com:
```bash
./vendor/bin/pest
```

---

## **Exemplo Completo de TDD**

### **1. Escreva o Teste**
Crie um teste em `tests/Feature/UserTest.php`:
```php
public function test_user_can_be_listed()
{
    User::factory()->count(3)->create();

    $response = $this->get('/users');

    $response->assertStatus(200);
    $response->assertJsonCount(3);
}
```

### **2. Implemente o Código**
Adicione a lógica no controlador:
```php
public function index()
{
    $users = User::all();
    return response()->json($users);
}
```

### **3. Refatore**
Mova a lógica para um serviço:
```php
public function getAllUsers()
{
    return User::all();
}
```

---

Siga este guia para implementar TDD no seu projeto e garantir um código de alta qualidade e fácil manutenção. Se precisar de ajuda, consulte a equipe ou a documentação do Laravel.
